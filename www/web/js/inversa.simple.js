// JavaScript Document

OnStartup = InitializeContent;
OnLoaded = PositionAndSize;

var PageOnStartup = null;

function InitializeContent() {
	$('#mainMenu').addClass('defaultmenu');
	$.each($('a.backlink'), function(i, backlink) {
		$(backlink).click(function() {
			parent.history.back();
			return false;
		});
	});

	if (PageOnStartup) {
		PageOnStartup();
	}
}

function PositionAndSize() {
	SizeMainContentDiv();
	PositionFixDivs();
	BindImagesWithDetails();
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

function BindImagesWithDetails() {
	$('a[rel*=lightbox]').lightBox({
		overlayBgColor : '#444444',
		overlayOpacity : 0.4,
		imageBlank : '/css/lightbox/images/blank.gif',
		imageLoading : '/css/lightbox/images/loading.gif',
		imageBtnClose : '/css/lightbox/images/close.png',
		imageBtnPrev : '/css/lightbox/images/prev.png',
		imageBtnNext : '/css/lightbox/images/next.png',
		txtOf : 'von',
		txtImage : 'Bild'
	});
}

function CreateGallery(galleryRel) {
	$('a[rel*=' + galleryRel + ']').lightBox({
		overlayBgColor : '#444444',
		overlayOpacity : 0.4,
		imageBlank : '/css/lightbox/images/blank.gif',
		imageLoading : '/css/lightbox/images/loading.gif',
		imageBtnClose : '/css/lightbox/images/close.png',
		imageBtnPrev : '/css/lightbox/images/prev.png',
		imageBtnNext : '/css/lightbox/images/next.png',
		txtOf : 'von',
		txtImage : 'Bild'
	});
}