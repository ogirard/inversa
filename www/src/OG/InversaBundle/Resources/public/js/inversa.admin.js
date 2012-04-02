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
	InitFlexiGrid();

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
	$('input.datetimefield').kendoDatePicker();
}

function InitFlexiGrid() {
	$('.records_list').flexigrid({
		height : 400,
		resizable : false,
		singleSelect : true,
		showToggleBtn : false,
		colModel : GetColumns(),
		onChangeSort : function(name, order) {
			SortGrid(".records_list", order);
		}
	});
}

var GetColumns = function() {
	var colModel = [];
	$.each($('.records_list thead tr th'), function(i, th) {
		var $th = $(th);
		colModel[i] = {
			display : $th.text(),
			name : GetName($th.text()),
			sortable : !IsNullOrEmpty($th.text()),
			width : $th.attr('width')
		};
		$th.remove();
	});

	return colModel;
};

function GetName(text) {
	return text.replace(' ', '_');
}

function IsNullOrEmpty(text) {
	return !text || text.trim() == '';
}

function SortGrid(table, order) {
	// Remove all characters in c from s.
	var stripChar = function(s, c) {
		var r = "";
		for ( var i = 0; i < s.length; i++) {
			r += c.indexOf(s.charAt(i)) >= 0 ? "" : s.charAt(i);
		}
		return r;
	};

	// Test for characters accepted in numeric values.
	var isNumeric = function(s) {
		var valid = "0123456789.,- ";
		var result = true;
		var c;
		for ( var i = 0; i < s.length && result; i++) {
			c = s.charAt(i);
			if (valid.indexOf(c) <= -1) {
				result = false;
			}
		}
		return result;
	};

	// Sort table rows.
	var asc = order == "asc";
	var rows = $(table).find("tbody > tr").get();
	var column = $(table).parent(".bDiv").siblings(".hDiv").find("table tr th")
			.index($("th.sorted", ".flexigrid:has(" + table + ")"));
	rows.sort(function(a, b) {
		var keyA = $(asc ? a : b).children("td").eq(column).text()
				.toUpperCase();
		var keyB = $(asc ? b : a).children("td").eq(column).text()
				.toUpperCase();
		if ((isNumeric(keyA) || keyA.length < 1)
				&& (isNumeric(keyB) || keyB.length < 1)) {
			keyA = stripChar(keyA, ", ");
			keyB = stripChar(keyB, ", ");
			if (keyA.length < 1)
				keyA = 0;
			if (keyB.length < 1)
				keyB = 0;
			keyA = new Number(parseFloat(keyA));
			keyB = new Number(parseFloat(keyB));
		}
		return keyA > keyB ? 1 : keyA < keyB ? -1 : 0;
	});
	// Rebuild the table body.
	$.each(rows, function(index, row) {
		$(table).children("tbody").append(row);
	});
	// Fix styles
	// Clear the striping.
	$(table).find("tr").removeClass("erow");
	// Add striping to odd numbered rows.
	$(table).find("tr:odd").addClass("erow");
	// Clear sorted class from table cells.
	$(table).find("td.sorted").removeClass("sorted");
	$(table).find("tr").each(function() {
		// Add sorted class to sorted column cells.
		$(this).find("td:nth(" + column + ")").addClass("sorted");
	});
}