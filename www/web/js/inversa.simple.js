// JavaScript Document

OnStartup = InitializeContent;
OnLoaded = PositionAndSize;

function InitializeContent() {
	$('#mainMenu').addClass('defaultmenu');
}

function PositionAndSize() {
	SizeMainContentDiv();
	PositionFixDivs();
}

function SizeMainContentDiv() {
	var $maincontent = $('#maincontent');
	var availableHeight = GetAvailableHeight()
			- GetVerticalMargin($maincontent);
	$maincontent.css('min-height', availableHeight + 'px');
}

function PositionFixDivs() {
	var $maincontent = $('#maincontent');
	$('.footertext').css('left', $maincontent.offset().left + 'px');
}