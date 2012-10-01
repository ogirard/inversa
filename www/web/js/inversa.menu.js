// JavaScript Document
function InitializeMenus() {
	if(activeMenu) {
	  $('#' + activeMenu).addClass('activemenu');
	}
	
	$('a.menu').click(function() {
		$('a.menu').removeClass('activemenu');
		$(this).addClass('activemenu');
	});
	
	RegisterMenu('inversa');
	RegisterMenu('agenda');
	RegisterMenu('media');
}

function PositionActiveMenu() {
	$.each(['inversa', 'agenda', 'media'], function(i, id) {
	  var $menulink = $('#' + id);
	  var $menu = $('#' + id + 'menu');
	  $menu.hide();
      if(IsActiveMenu($menu, $menulink)) {
		  ShowMenu($menu, $menulink);
	  }
	});
}

function RePositionActiveMenuIfNeeded() {
	$.each(['inversa', 'agenda', 'media'], function(i, id) {
	  var $menulink = $('#' + id);
	  var $menu = $('#' + id + 'menu');
      if(IsActiveMenu($menu, $menulink)) {
        ShowMenu($menu, $menulink);      	  
	  }
	});
}

function RegisterMenu(id) {
	var isMouseOver = false;
	var isMouseOverMenu = false;	

	var $menulink = $('#' + id);
	var $menu = $('#' + id + 'menu');
		
	$menulink.hover(function() {
		isMouseOver = true;
		ShowMenu($menu, $(this));
	}, function() {
		HideMenu($menu, $menulink, function() { return !isMouseOver && !isMouseOverMenu; });		
		isMouseOver = false;
	});
	
	$menu.hover(function() {
		isMouseOverMenu = true;
	}, function() {
		
		HideMenu($menu, $menulink, function() { return !isMouseOver && !isMouseOverMenu; });		
		isMouseOverMenu = false;
	});	
}

function HideMenu($menu, $menulink, check) {
  if(IsActiveMenu($menu, $menulink)) {
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

function IsActiveMenu($menu, $menulink) {
	if(!$menu || !$menulink) {
		return false;
	}
	
	if($menulink.hasClass('activemenu')) {
		return true;
	}
	
	var hasActiveElement = false;
	$.each($('a.menu', $menu), function(i, entry) {
		if($(entry).hasClass('activemenu')) {
			hasActiveElement = true;
			return;
		}
	});
	
	return hasActiveElement;
}