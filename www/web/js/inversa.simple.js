// JavaScript Document

OnStartup = InitializeContent;
OnLoaded = PositionAndSize;

function InitializeContent() {
	$('#mainMenu').addClass('defaultmenu');
	$.each($('a.backlink'), function(i, backlink) {
		$(backlink).click(function() {
			parent.history.back();
			return false;
		});
	});
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
	$.each($('img.with-details'), function(i, img) {
		var $img = $(img);
		$img.click(function() {
			alert($img.attr('detailSrc'));
		});
	});
}