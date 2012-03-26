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
			var $headerLabel = $($('label', $itemFormDiv)[0]); 
			$headerLabel.text(headerLabel + ' ' + count);
			$headerLabel.addClass('headerLabel');
			

			TransformEmbeddedEntry($itemFormDiv);
			// create a new list element and add it to our list
			$itemFormDiv.appendTo($list);
			$itemFormDiv.addClass('nestedItem');
			$removeLink = $('<a href="#">Entfernen</a>');
			$removeLink.click(function() {
				$list.remove($itemFormDiv);
			});
			$removeLink.appendTo($itemFormDiv);
			return false;
		});
	}

	function TransformEmbeddedEntry($embeddedEntry) {
		if (_this.transform($embeddedEntry)) {
			return $embeddedEntry;
		}

		return $embeddedEntry;
	}
}