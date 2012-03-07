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

function GetAvailableHeight() {
    var menuHeight = GetElementHeight($('#menudiv'));
	var footerHeight = GetElementHeight($('#footerdiv'));
    return $(window).height() - menuHeight - footerHeight - 128;
}

function GetAvailableWidth() {
    return $(window).width();
}


/**
 * Initializes the content area
 */
function InitializeContentArea() {
	var $content = $('.content');
	var height =  GetAvailableHeight() - GetVerticalMargin;
	$content.css('min-height', height);
}