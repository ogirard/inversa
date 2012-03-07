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
	$titleimage.css('z-index', 5555);
	var availableHeight = GetAvailableHeight();
    availableHeight -= GetVerticalSpacing($titleimage);
    availableHeight -= GetVerticalSpacing($instrumentimage);
	$maincontent.css('min-height', availableHeight + 'px');
}

function PositionFixDivs() {
	var $memberimage = $('#memberimage');
	var $defaultcontent = $('.defaultcontent');
	var $maincontent = $('.maincontent');
	var left = $memberimage.offset().left - $defaultcontent.offset().left;
	var bottom = $memberimage.offset().top + $memberimage.height() - $defaultcontent.offset().top + 27;
	var contentleft = $maincontent.offset().left - $defaultcontent.offset().left + 27;
	
	$('#memberwww').css('left', left + 'px');
	$('#memberwww').css('top', bottom + 'px');	
    $('#memberaddress').css('left', contentleft + 'px');
	$('#memberaddress').css('top', bottom + 'px');
}