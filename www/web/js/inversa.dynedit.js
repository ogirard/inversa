function DynamicEdit(initCount, addLinkId, listId, headerLabel) {
	var $addLink = $(addLinkId);
	var $list = $(listId);
	var $uniqueItemClass = listId.substring(1) + "_nestedItem";
	var _this = this;
	var $counterItem = $("<div style='margin: 4px' />");

	this.transform = function($embeddedEntry) {
		return false;
	};

	this.Initialize = function() {
		PrepareEmbeddedForm();
		MoveAddLink();
		RegisterDynAdd();
		UpdateLabels();
	};

	function PrepareEmbeddedForm() {
		$list.css('margin-left', '40px');

		for ( var i = 0; i < initCount; i++) {
			$div = $(listId + "_" + i).parent();
			FormatNestedDiv($div, i + 1);
		}
	}

	function MoveAddLink() {
		$counterItem.insertBefore($list);
		$("<br />").insertBefore($list);
		$addLink.addClass('inversa-formlink inversa-add-link');
		$addDiv = $('<div style="margin-left:40px; display: block;"></div>');
		$addLink.appendTo($addDiv);
		$addDiv.insertAfter($list);
	}

	function RegisterDynAdd() {
		$addLink.click(function(event) {
			event.preventDefault();

			// grab the prototype template
			var newWidget = $list.attr('data-prototype');
			var nextId = $("." + $uniqueItemClass).length + 1;

			// replace the "$$name$$" with unique id
			$itemFormDiv = $(newWidget.replace(/\$\$name\$\$/g, nextId));
			$itemFormDiv.appendTo($list);
			FormatNestedDiv($itemFormDiv.first(), nextId);
			TransformEmbeddedEntry($itemFormDiv);
			UpdateLabels();

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
		$headerLabel.hide();
		$headerDiv = $('<div class="headerLabel"><img style="display:block-inline;" src="/css/images/arrow_gray.png" /> <span class="headerLabel">'
				+ headerLabel + ' ' + nr + '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br />');
		$headerDiv.insertBefore($headerLabel);
		$div.addClass($uniqueItemClass);

		// remove webpath / add current file link
		ReplaceWebPathByLink();

		// add remove li
		$removeLink = $('<a href="#" class="inversa-formlink" style="margin: 4px; text-transform: none;"><img src="/css/images/remove.png" /> Entfernen</a>');
		$removeLink.click(function(event) {
			event.preventDefault();
			RemoveNestedDiv($div);
			return false;
		});

		$removeLink.appendTo($headerDiv.first());

		// apply field transformations after load/reload/insert
		ApplyKendoFields($div);
	}

	function RemoveNestedDiv($div) {
		if (confirm('Soll "' + $('span.headerLabel', $div).text()
				+ '" gelöscht werden?')) {

			$div.nextAll('br').first().remove();
			$div.remove();

			UpdateLabels();
		}
	}

	function UpdateLabels() {
		$.each($("." + $uniqueItemClass, $list), function(index, div) {
			$div = $(div);
			var $headerLabel = $($('span.headerLabel', $div)[0]);
			$headerLabel.html(headerLabel + ' ' + (index + 1));
		});

		$counterItem.text("(" + $("." + $uniqueItemClass).length + ")");
	}
}

function InitDynamicEdit(initCount, addLinkId, listId, headerLabel) {
	(new DynamicEdit(initCount, addLinkId, listId, headerLabel)).Initialize();
}