function dynedit(initCount, addLinkId, listId) {
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

	}

	function MoveAddLink() {

	}

	function RegisterDynAdd() {
		$addLink.click(function(event) {
			event.preventDefault();

			// grab the prototype template
			var newWidget = $list.attr('data-prototype');

			// replace the "$$name$$" with unique id
			$itemFormDiv = $(newWidget.replace(/\$\$name\$\$/g, count));
			count++;

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
}