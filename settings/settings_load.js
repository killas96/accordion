var jsFormBlock = {
	formId: 'formId',
	arData: null,
	obForm: null,
	init: function(params) {
		if(typeof (params.formId) !== 'undefined') {
			jsFormBlock.formId = params.formId;
		}
		jsFormBlock.arData = arData;
		jsFormBlock.obForm = document.forms['bx_popup_form_data_form_' + jsFormBlock.formId];
		jsFormBlock.obForm.onsubmit = jsFormBlock.__saveChanges;
	},
	
	__dataAdd: function(a) {
		var toCopyBlock = jsFormBlock.obForm.querySelector('div.toCopyBlock');
		var div = toCopyBlock.cloneNode(true);
		div.querySelector('div').setAttribute('onclick', 'return jsFormBlock.__dataDel(this.parentNode);'); 		
		var test1=BX.append(div, BX(a));
		return false;
	},

	__dataDel: function(b) {
		BX.remove(b);
		return false;
	}, 
	__saveChanges: function() {
		if (!jsFormBlock.formId) 
			return false;
		var i, input = jsFormBlock.obForm.querySelectorAll('[name="data_h[]"]'),
		sort = jsFormBlock.obForm.querySelectorAll('[name="data_s[]"]'),
		textarea = jsFormBlock.obForm.querySelectorAll('[name="data_d[]"]');
		jsFormBlock.arData = [];
		for (i = 0; i < input.length; ++i) {
			if(!sort[i].value)
				sort[i].value = 500;
			if(!input[i].value || !textarea[i].value)
				continue;
			jsFormBlock.arData.push({'h':input[i].value,'s':sort[i].value,'d':textarea[i].value});
		}
		jsFormBlock.arData.sort((a, b) => a.s > b.s ? 1 : -1);
		window.OnDataForm.saveData(window.btoa(unescape(encodeURIComponent(JSON.stringify(jsFormBlock.arData)))));
		return false;
	}
};