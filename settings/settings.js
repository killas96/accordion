function OnDataEdit(arParams) {
	if (null != window.OnDataForm) {
		try {
			window.OnDataForm.Close();
		} catch (e) {
			
		}
		window.OnDataForm = null;
	}
	window.OnDataForm = new JCEditorOpener(arParams);
}

function JCEditorOpener(arParams) {
	this.jsOptions = arParams.data;
	this.arParams = arParams;

	var obButton = document.createElement('INPUT');
    obButton.type = "button";
    obButton.value = this.jsOptions.TEXT_EDIT;
	this.arParams.oCont.appendChild(obButton);
	
	obButton.onclick = BX.delegate(this.btnClick, this);
	this.saveData = BX.delegate(this.__saveData, this);
}

JCEditorOpener.prototype.Close = function(e) {
	if (false !== e)
		BX.PreventDefault(e);

	if (null != window.jsPopup_data_form) {
		window.jsPopup_data_form.Close();
	}
};

JCEditorOpener.prototype.btnClick = function () {
	this.arElements = this.arParams.getElements();
	if (!this.arElements)
		return false;
	window.jsPopup_data_form = new BX.CDialog({
		'content_url': this.jsOptions.THIS_PATH + '/settings/settings.php' + '?params=' + JSON.stringify(this.arParams.data),
		'content_post': 'FORM_DATA=' + BX.util.urlencode(this.arParams.oInput.value),
		'width':800,
		'height':500,
		'resizable':true
	});	
	window.jsPopup_data_form.Show();
	window.jsPopup_data_form.PARAMS.content_url = '';
	return false;
};

JCEditorOpener.prototype.__saveData = function(strData) {
	this.arParams.oInput.value = strData;
	if (null != this.arParams.oInput.onchange)
		this.arParams.oInput.onchange();	
	this.Close(false);
};