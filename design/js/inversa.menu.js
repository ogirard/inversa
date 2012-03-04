// JavaScript Document
function InitializeMenus() {
	
	$('a.menu').click(function() {
		$('a.menu').removeClass('activemenu');
		$(this).addClass('activemenu');
	});
	
	RegisterMenu('inversa');
	RegisterMenu('agenda');
	RegisterMenu('media');
}

function RegisterMenu(id) {
	var isMouseOver = false;
	var isMouseOverMenu = false;	

	var $menulink = $('#' + id);
	var $menu = $('#' + id + 'menu');
    $menu.hide();
	
	$menulink.hover(function() {
		isMouseOver = true;
		ShowMenu($menu, $(this));
	}, function() {
		HideMenu($menu, function() { return !isMouseOver && !isMouseOverMenu });		
		isMouseOver = false;
	});
	
	$menu.hover(function() {
		isMouseOverMenu = true;
	}, function() {
		
		HideMenu($menu, function() { return !isMouseOver && !isMouseOverMenu });		
		isMouseOverMenu = false;
	});
	
	if(IsActiveMenu($menu)) {
      ShowMenu($menu, $menulink);
	}
}

function HideMenu($menu, check) {
  if(IsActiveMenu($menu)) {
	  return;
  }
  
  setTimeout( function()
  {
    if(check()) {
	  $menu.slideUp(200);
    }
  }, 250);
}


function ShowMenu($menu, $owner) {	
	$menu.css('left', $owner.offset().left + 'px');
	$menu.css('top', ($owner.offset().top + $owner.height() + 5) + 'px');
	$menu.slideDown(200);
}

function IsActiveMenu($menu) {
	var hasActiveElement = false;
	$.each($('a.menu', $menu), function(i, entry) {
		if($(entry).hasClass('activemenu')) {
			hasActiveElement = true;
			return;
		}
	});
	
	return hasActiveElement;
}