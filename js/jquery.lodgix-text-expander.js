(function($) {

$.widget("ui.LodgixTextExpander", {

	options: {
		heightPx: 114,
		more: '+',
		less: '-'
	},

	_create: function() {
		var text = this.element;
		text.css('font-size', text.css('font-size'));
		text.css('line-height', 1.2);
		var wrapper = $('<div class="lodgixTextExpanderWrapper" style="position:relative"/>');
		this.element.replaceWith(wrapper);
		this.element = wrapper;
		wrapper.append(text);
		this._text = text;
		if (wrapper.innerHeight() > this.options.heightPx) {
			var lineHeight = parseInt(text.css('line-height'));
			this._height = parseInt(parseInt(this.options.heightPx / lineHeight) * lineHeight);
			wrapper.append($('<div class="lodgixTextExpanderShadow" style="position:absolute;bottom:0;right:0"/>'));
			this._expander = $('<div class="lodgixTextExpander" style="position:absolute;bottom:0;right:0"/>');
			wrapper.append(this._expander);
		}
	},

	destroy: function() {
		this.element = this._text;
		this._text = null;
		this._expander = null;
	},

	_init: function() {
		if (this._expander) {
			this._collapse();
		}
	},

	_collapse: function() {
		var w = this;
		w._text.css('height', w._height + 'px');
		w._text.css('overflow', 'hidden');
		w._expander.html(w.options.more);
		w._expander.click(function() {
			w._expand();
		});
	},

	_expand: function() {
		var w = this;
		w._text.css('height', 'auto');
		w._text.css('overflow', 'auto');
		w._expander.html(w.options.less);
		w._expander.click(function() {
			w._collapse();
		});
	}

});

})(jQueryLodgix);
