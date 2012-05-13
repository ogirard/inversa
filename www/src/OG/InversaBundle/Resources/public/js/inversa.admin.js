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
	ApplyKendoPageInit();
	ReplaceWebPathByLink();

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

	ApplyKendoFields();
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
}

function ApplyKendoPageInit() {
	// grid
	if ($('#listtoolbartemplate').length > 0) {
		$('.records_list').kendoGrid({
			height : 600,
			groupable : true,
			sortable : true,
			pageable : true,
			scrollable : false,
			filterable : true,
			toolbar : kendo.template($('#listtoolbartemplate').html())
		});
	}
	
	// remove filter for actions column
	$('a', $('th[data-field="actions"]')).hide();
}

function ApplyKendoFields($scope) {
	if (!$scope) {
		$scope = $('body');
	}

	// file upload
	$scope.find('input:file').kendoUpload({
		multiple : false
	});

	// date time field
	$scope.find('input.datetimefield').kendoDatePicker();
	$scope.find('input.datetimefield').addClass('inversa-datefield');

	// text field
	$.each($scope.find('input:text'), function(i, input) {
		if (!$(input).parent().hasClass('k-picker-wrap')) {
			$(input).addClass('k-textbox inversa-textbox');
		}
	});

	// multi-line text field
	$scope.find('textarea').addClass('k-textbox inversa-textarea');

	// check box
	$scope.find('input[type="checkbox"]').addClass(
			'k-checkbox inversa-checkbox');

	// select
	$scope.find('select').kendoComboBox({
		filter : "contains",
		suggest : true
	});

	// password
	$scope.find('input[type="password"]').addClass(
			'k-textbox inversa-passwordbox');
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

function ReplaceWebPathByLink() {
	// var $webPathInput = $(listId + '_' + (nr - 1) + '_webpath');

	$.each($('input.webpathinput'),function(i, input) {
			var $webPathInput = $(input);
			if ($webPathInput.attr('isHandled') != 'true') {

				$webPathInput.attr('isHandled', 'true');

				var webPath = $webPathInput.val();
				$webPathInput.parent().hide(0);

				var fileHyperlink = '<span class="noFileSelected">Keine Datei vorhanden</span>';

				if (!IsNullOrEmpty(webPath)) {
					fileHyperlink = '<a id="path' 
						    + i
							+ '" href="'
							+ GetHost()
							+ webPath
							+ '" target="_blank" class="inversa-formlink">'
							+ GetFileName(webPath) + '</a>';
				}

				var $currentFile = $('<div><label for="path' + i
						+ '">Aktuelle Datei</label>'
						+ fileHyperlink + '</div>');
				$currentFile.insertAfter($webPathInput.parent());
			}
		});
}
