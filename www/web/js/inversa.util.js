// JavaScript Document
/**
 * Gets the complete height of the given jQuery element (= height() + vpadding +
 * vmargin)
 */

function GetElementHeight($element) {
	return $element.height() + GetVerticalSpacing($element);
}

function GetVerticalSpacing($element) {
	var spacing = GetVerticalMargin($element);
	spacing += GetVerticalPadding($element);
	return spacing;
}

function GetVerticalPadding($element) {
	var vpadding = ParsePixels($element.css('padding-top'));
	vpadding += ParsePixels($element.css('padding-bottom'));
	return vpadding;
}

function GetVerticalMargin($element) {
	var vmargin = ParsePixels($element.css('margin-top'));
	vmargin += ParsePixels($element.css('margin-bottom'));
	return vmargin;
}

function GetHorizontalMargin($element) {
	var hmargin = ParsePixels($element.css('margin-left'));
	hmargin += ParsePixels($element.css('margin-right'));
	return hmargin;
}

function ParsePixels(pixelString) {
	if (!pixelString) {
		return 0;
	}

	return parseInt(pixelString.replace("px", ""));
}

function GetRandom(from, to) {
	return Math.floor(Math.random() * (to - from) + from);
}

function InvokeLater(actions) {
	setTimeout(function() {
		$.each(actions, function(index, action) {
			action();
		});
	}, 50);
}

$.fn.exists = function() {
	return this.length !== 0;
};

function GetHost() {
	return window.location.protocol + '//' + window.location.host + "/";
}

function GetFileName(filePath) {
	if (!filePath) {
		return '';
	}

	var parts = filePath.split('/');
	return parts[parts.length - 1];
}

$.fx.prototype.cur = function() {
	if (this.elem[this.prop] != null
			&& (!this.elem.style || this.elem.style[this.prop] == null)) {
		return this.elem[this.prop];
	}
	var r = parseFloat(jQuery.css(this.elem, this.prop));
	return typeof r == 'undefined' ? 0 : r;
};

function getViewport() {
  var e = window, a = 'inner';
  if ( !('innerWidth' in window )) {
    a = 'client';
    e = document.documentElement || document.body;
  }
  
  return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

(function($) {
    $.fn.hasScrollBar = function() {
        return this.get(0).scrollHeight > this.height();
    };
})(jQuery);