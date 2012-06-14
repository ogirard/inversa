/**
 * JavaScript code behind for index.html
 */
var allPages = ['home', 'ensembleinversa', 'panflute', 'flute', 'violin', 'organ'];
var defaultColors = {
    'panflute': '#dd0000',
    'flute': '#d31459',
    'violin': '#662e91',
    'organ': '#fe9500'
};

var OnStartup;

var OnLoaded;

$(document).ready(function () {
    // when the DOM is ready...
    InitializeContentArea();
	InitializeMenus();
	$(window).resize(function() {
      InitializeContentArea();
    });
	
	if(OnStartup) {
	  OnStartup();
	}
});

$(window).load(function() {
	PositionActiveMenu();
	
	if(OnLoaded) {
		OnLoaded();
	}
});

function GetAvailableHeight() {
    var menuHeight = GetElementHeight($('#menudiv'));
	var footerHeight = GetElementHeight($('#footerdiv'));
    return $(window).height() - menuHeight - footerHeight - 5;
}

function GetAvailableWidth() {
    return $(window).width();
}


/**
 * Initializes the content area
 */
function InitializeContentArea() {
	var $content = $('.content');
	var height =  GetAvailableHeight() - GetVerticalMargin($content);
	$content.css('min-height', height);
}