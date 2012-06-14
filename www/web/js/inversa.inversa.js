// JavaScript Document

OnStartup = InitializeContent;
var colors = [ '#662d91', '#d31459', '#dd0000', '#0070bc' ];

function InitializeContent() {
	InvokeLater([ SizeMainContentDiv, PositionFooter, SetBackgroundColor ]);
}

function SizeMainContentDiv() {
	var $maincontent = $('#maincontent');
	var availableHeight = GetAvailableHeight()
			- GetVerticalMargin($maincontent);
	$maincontent.css('min-height', availableHeight + 'px');
}

function PositionFooter() {
	var $maincontent = $('#maincontent');
	$('.footertext').css('left', $maincontent.offset().left + 'px');
}

function SetBackgroundColor() {
	var colorIndex = GetRandom(0, 4);
	var $maincontent = $('#maincontent');
	$maincontent.css('background-color', colors[colorIndex]);
}
