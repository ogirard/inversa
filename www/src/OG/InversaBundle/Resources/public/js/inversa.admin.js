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
	kendo.culture("de-CH");
	$('input.datetimefield').kendoDatePicker();
	$('.records_list').kendoGrid({
		height : 600,
		groupable : true,
		sortable : true,
		pageable: true,
        scrollable: false,
        filterable: true,
		toolbar : kendo.template($('#listtoolbartemplate').html())
	});
}

var GetKendoColumns = function() {
	var colModel = [];
	$.each($('.records_list thead tr th'), function(i, th) {
		var $th = $(th);
		colModel[i] = {
			title : $th.text(),
			width : $th.attr('column-width'),
			field : $th.attr('data-field')
		};
	});

	return colModel;
};

function GetName(text) {
	return text.replace(' ', '_');
}

function IsNullOrEmpty(text) {
	return !text || text.trim() == '';
}

function DeleteElementGuard() {
    return confirm('Soll dieses Element definitiv gelöscht werden?');
}
