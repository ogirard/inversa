/**
 * JavaScript code behind for index.html
 */
var allPages = ["ensembleinversa", "panflute", "flute", "violin", "pianoorgan"];
var defaultColors = {
    "panflute": "#d10000",
    "flute": "#004aaf",
    "violin": "#00890a",
    "pianoorgan": "#fe9500"
};
var bottomPadding = 40;

$(document).ready(function () {
    // when the DOM is ready...
    InitializeScrollPane();
});

function GetAvailableHeight() {
    var menuHeight = GetElementHeight($(".menu"));
	var srcollContainerSpacing = GetVerticalSpacing($(".scrollContainer"));
	var srcollSpacing = GetVerticalSpacing($(".scroll"));
	var footerHeight = GetElementHeight($(".footer"));
    return $(document).height() - menuHeight - footerHeight - srcollContainerSpacing - srcollSpacing;
}

function GetAvailableWidth() {
    return $(document).width();
}

/**
 * Initializes the scrolling
 */
function InitializeScrollPane() {
    var $panels = $('.scrollContainer > div');
    var $container = $('.scrollContainer');
	
    // if false, we'll float all the panels left and fix the width 
    // of the container
    var horizontal = true;

    // float the panels left if we're going horizontal
    if (horizontal) {
        $panels.css({
            'float': 'left',
            'position': 'relative' // IE fix to ensure overflow is hidden
        });

        var pageWidth = GetAvailableWidth();
        var pageHeight = GetAvailableHeight();
		
        $.each($panels, function () {
			var $this = $(this);
            $this.css('background-color', defaultColors[$this.attr('id')]);
            $this.css('width', pageWidth + 'px');
            $this.css('min-height', pageHeight - GetVerticalSpacing($this) + 'px');
        });

        $container.css('width', $panels[0].offsetWidth * $panels.length);
    }

    // collect the scroll object, at the same time apply the hidden overflow
    // to remove the default scrollbars that will appear
    var $scroll = $('.scroll').css('overflow', 'hidden');

    // handle nav selection
    // go find the navigation link that has this target and select the nav	
	function trigger(data) {
		$.each(allPages, function () {
			if (this == data.id) {
				$("#" + this + "link").addClass('activemenulink');
			} else {
				$("#" + this + "link").removeClass('activemenulink');
			}
			if(data.id) {
				if(data.id == "ensembleinversa") {
				  window.location.hash = '';
				}
				else {
				  window.location.hash = '#' + data.id;
				}
			}
		});
    }

    if (window.location.hash) {
        trigger({
            id: window.location.hash.substr(1)
        });
    } else {
        $('.navigation a:first').click();
    }

    // offset is used to move to *exactly* the right place, since I'm using
    // padding on my example, I need to subtract the amount of padding to
    // the offset.  Try removing this to get a good idea of the effect
    var offset = parseInt((horizontal ? $container.css('paddingTop') : $container.css('paddingLeft')) || 0) * -1;

    var scrollOptions = {
        target: $scroll,
        // the element that has the overflow
        // can be a selector which will be relative to the target
        items: $panels,

        navigation: '.navigation a',

        // selectors are NOT relative to document, i.e. make sure they're unique
        prev: 'img.left',
        next: 'img.right',

        // allow the scroll effect to run both directions
        axis: 'xy',

        onAfter: trigger,
        // our final callback
        offset: offset,

        // duration of the sliding effect
        duration: 500,

        // easing - can be used with the easing plugin: 
        // http://gsgd.co.uk/sandbox/jquery/easing/
        easing: 'swing'
    };

    // apply serialScroll to the slider - we chose this plugin because it 
    // supports// the indexed next and previous scroll along with hooking 
    // in to our navigation.
    $('#slider').serialScroll(scrollOptions);

    // now apply localScroll to hook any other arbitrary links to trigger 
    // the effect
    $.localScroll(scrollOptions);

    // finally, if the URL has a hash, move the slider in to position, 
    // setting the duration to 1 because I don't want it to scroll in the
    // very first page load.  We don't always need this, but it ensures
    // the positioning is absolutely spot on when the pages loads.
    scrollOptions.duration = 1;
    $.localScroll.hash(scrollOptions);
}