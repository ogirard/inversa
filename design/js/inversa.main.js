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
    var menuHeight = GetElementHeight($('.menu'));
	var footerHeight = GetElementHeight($('.footer'));
    return $(document).height() - menuHeight - footerHeight - 5;
}

function GetAvailableWidth() {
    return $(document).width();
}


/**
 * Initializes the content area
 */
function InitializeContentArea() {
	var width = GetAvailableWidth();
    $('.content').width();
	var height =  GetAvailableHeight();
	$('.content').css('min-height', height);
}