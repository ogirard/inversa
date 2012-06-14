// JavaScript Document

OnStartup = InitializeContent;
OnLoaded = PositionAndSize;

function InitializeContent() {
  $('#mainMenu').addClass('defaultmenu');
  $('#memberwww').hide();
  $('#memberaddress').hide();
}

function PositionAndSize() {
	SizeMainContentDiv();
	PositionFixDivs();
}

function SizeMainContentDiv() {
    var $maincontent = $('#maincontent');
    var $instrumentimage = $('#instrumentimage');
	var availableHeight = GetAvailableHeight() - GetVerticalMargin($maincontent) - GetElementHeight($instrumentimage);
	$maincontent.css('min-height', availableHeight + 'px');
}

function PositionFixDivs() {
	var $memberimage = $('#memberimage');	
	var $maincontent = $('#maincontent');
	var $defaultcontent = $('.defaultcontent');
	var left = $memberimage.offset().left - $defaultcontent.offset().left;
	var bottom = $memberimage.offset().top + $memberimage.height() - $defaultcontent.offset().top + 27;
	var contentleft = $maincontent.offset().left - $defaultcontent.offset().left + 27;
	
	$('#memberwww').css('left', left + 'px');
	$('#memberwww').css('top', bottom + 'px');	
    $('#memberaddress').css('left', contentleft + 'px');
	$('#memberaddress').css('top', bottom + 'px');
    $('.footertext').css('left', $maincontent.offset().left + 'px');

    $('#memberwww').show(0);
    $('#memberaddress').show(0);
}