// JavaScript Document
/**
 * Gets the complete height of the given jQuery element (= height() + vpadding + vmargin)
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
    return parseInt(pixelString.replace("px", ""));
}

function GetRandom(from, to) {
	return Math.floor(Math.random() * (to - from) + from);
}