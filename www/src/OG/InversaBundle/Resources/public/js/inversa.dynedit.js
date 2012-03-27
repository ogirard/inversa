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
			$itemFormDiv.appendTo($list);
			FormatNestedDiv($itemFormDiv, count);
			TransformEmbeddedEntry($itemFormDiv);
			// create a new list element and add it to our list
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
		$removeLink.click(function(event) {
			event.preventDefault();
			RemoveNestedDiv($div);
			return false;
		});
		$removeLink.appendTo($div);

		// remove webpath
		var $webPathInput = $(listId + '_' + (nr - 1) + '_webpath');
		var webPath = $webPathInput.val();
		$webPathInput.parent().hide(0);
	}

	function RemoveNestedDiv($div) {
		if (confirm('Soll "' + $('.headerLabel', $div).text()
				+ '" gelöscht werden?')) {
			$div.remove();
			count--;
			UpdateLabels();
		}
	}

	function UpdateLabels() {
		var maxCount = 0;
		$.each($('.nestedItem', $list), function(index, div) {
			$div = $(div);
			var $headerLabel = $($('label', $div)[0]);
			$headerLabel.text(headerLabel + ' ' + (index + 1));
		});
		count = maxCount;
	}
}