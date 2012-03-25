/**
 * JavaScript code behind for index.html
 */
var allPages = [ 'home', 'ensembleinversa', 'panflute', 'flute', 'violin',
		'organ' ];
var defaultColors = {
	'panflute' : '#dd0000',
	'flute' : '#d31459',
	'violin' : '#662e91',
	'organ' : '#fe9500'
};

var OnStartup;

var OnLoaded;

$(document).ready(function() {
	// when the DOM is ready...
	SetMinHeight();
	UnpackEmails();
	InitButtons();
	InitKendo();

	$(window).resize(function() {
		SetMinHeight();
	});

	if (OnStartup) {
		OnStartup();
	}
});

$(window).load(function() {

	if (OnLoaded) {
		OnLoaded();
	}
});

function SetMinHeight() {
	var adminImgHeight = 96;
	var headerHeight = GetElementHeight($('#headerdiv'));
	var footerHeight = GetElementHeight($('#footerdiv'));

	var height = $(window).height() - adminImgHeight - headerHeight
			- footerHeight - 2 - 80; // -80: debug panel, remove for prod!
	
	$(".inversacontent").css("min-height", height + "px");
}

function UnpackEmails() {
	$('a.aaa').each(function() {
		e = this.rel.replace('/', '@');
		this.href = 'mailto:' + e;
		$(this).text(e);
	});
}

function InitButtons() {
	$('a.actionbutton').bind({
		mousedown : function() {
			$(this).addClass('mousedown');
		},
		blur : function() {
			$(this).removeClass('mousedown');
		},
		mouseup : function() {
			$(this).removeClass('mousedown');
		},
		mouseleave : function() {
			$(this).removeClass('mousedown');
		}
	});
}

function InitKendo() {
	$("input.datetimefield").kendoDatePicker();
}