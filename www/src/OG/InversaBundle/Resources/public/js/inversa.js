$(document).ready(function() {
	SetMinHeight();
	UnpackEmails();
	InitButtons();
	InitKendo();
});

function SetMinHeight() {
	var diffHeight = $(".container").height() - $(".inversacontent").height();
	var height = $(document).height() - diffHeight - 5 - 35; // -35: debug
																// panel, remove
																// for prod!
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