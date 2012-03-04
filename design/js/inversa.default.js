// JavaScript Document

OnStartup = InitializeContent;

function InitializeContent() {
   SizeMainContentDiv();
   PositionFixDivs();
}

function SizeMainContentDiv() {
	var $titleimage = $('#titleimage');
    var $instrumentimage = $('#instrumentimage');	
    var $maincontent = $('#maincontent');
	var availableHeight = $('#content').height();
    availableHeight -= GetVerticalSpacing($titleimage);
    availableHeight -= GetVerticalSpacing($instrumentimage);
	$maincontent.css('min-height', availableHeight + 'px');
}

function PositionFixDivs() {
	var $memberimage = $('#memberimage');
	var left = ParsePixels($memberimage.css('left'));
	var top = ParsePixels($memberimage.css('top'));
    var $maincontent = $('#maincontent');
	var contentLeft = $maincontent.offset().left;
	$('#memberwww').css('left', left + 'px');
	$('#memberwww').css('top', (top + $memberimage.height() + 27) + 'px');	
    $('#memberaddress').css('left', (contentLeft + 27) + 'px');
	$('#memberaddress').css('top', (top + $memberimage.height() + 27) + 'px');
}