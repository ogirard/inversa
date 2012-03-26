function DynamicEdit(initCount, addLinkId, listId, headerLabel) {
	var count = initCount;
	var $addLink = $(addLinkId);
	var $list = $(listId);
	var _this = this;

	this.transform = function($embeddedEntry) {
		return false;
	};

	this.Initialize = function() {
		PrepareEmbeddedForm();
		MoveAddLink();
		RegisterDynAdd();
	};

	function PrepareEmbeddedForm() {
		$list.css('margin-left', '40px');

		for ( var i = 0; i < initCount; i++) {
			$div = $(listId + "_" + i).parent();
			FormatNestedDiv($div, i + 1);
		}
	}

	function MoveAddLink() {
		$addLink.insertBefore($list);
	}

	function RegisterDynAdd() {
		$addLink.click(function(event) {
			event.preventDefault();

			// grab the prototype template
			var newWidget = $list.attr('data-prototype');

			// replace the "$$name$$" with unique id
			$itemFormDiv = $(newWidget.replace(/\$\$name\$\$/g, count));
			count++;

			FormatNestedDiv($itemFormDiv, count);
			TransformEmbeddedEntry($itemFormDiv);
			// create a new list element and add it to our list
			$itemFormDiv.appendTo($list);

			return false;
		});
	}

	function TransformEmbeddedEntry($embeddedEntry) {
		if (_this.transform($embeddedEntry)) {
			return $embeddedEntry;
		}

		return $embeddedEntry;
	}

	function FormatNestedDiv($div, nr) {
		var $headerLabel = $($('label', $div)[0]);
		$headerLabel.text(headerLabel + ' ' + nr);
		$headerLabel.addClass('headerLabel');
		$div.addClass('nestedItem');
		$removeLink = $('<a href="#">Entfernen</a>');
		$removeLink.click(function() {
			$div.remove();
			count--;
			UpdateLabels();
		});
		$removeLink.appendTo($div);
	}

	function UpdateLabels() {
		$.each($('.nestedItem', $list), function(index, div) {
			$div = $(div);
			var $headerLabel = $($('label', $div)[0]);
			$headerLabel.text(headerLabel + ' ' + (index + 1));
		});
	}
}