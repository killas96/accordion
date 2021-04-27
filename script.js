function dataRebuild(parentBlockId, toValue){
	var i, data = {}, input = document.querySelectorAll('#' + parentBlockId + ' input'),
		textarea = document.querySelectorAll('#' +parentBlockId + ' textarea');
	for (i = 0; i < input.length; ++i) {
		data[i] = {'h':input[i].value,'d':textarea[i].value};
	}
	input.value = JSON.stringify(data);
	input.value = 'test';
	console.log(input.value);
}
function creatEl(parentBlock, textHead, textDesc, input=false, dataInput='', dataTextarea='') {
	var data_block = document.createElement("div");
	data_block.setAttribute('class', 'dataBlockBX');
	parentBlock.appendChild(data_block);
	if(document.querySelectorAll('#data_block_BX .dataBlockBX').length>1) {
		var data_image = document.createElement("div");
		data_image.innerHTML = 'x';
		data_block.appendChild(data_image);
		data_image.onclick = function(image){
			image.target.parentNode.remove();		
		};
	}
	var data_input = document.createElement("input");
	data_input.setAttribute('type', 'text');
	data_input.setAttribute('placeholder', textHead);
	if(dataInput){
		data_input.value = dataInput;
	}
	data_block.appendChild(data_input); 
	data_input.onkeyup = function(){
		dataRebuild(parentBlock.id, input);
	};
	var data_textarea = document.createElement("textarea");
	data_textarea.setAttribute('placeholder', textDesc);
	if(dataTextarea){
		data_textarea.innerHTML = dataTextarea;
	}
	data_block.appendChild(data_textarea); 
	data_textarea.onkeyup = function(){
		dataRebuild(parentBlock.id, input);
	};
}

function OnThisConstruct(arParams) {

	if(document.getElementById('data_css') == null){
		var css = document.createElement('link');
		css.rel = 'stylesheet';
		css.href = arParams.data.THIS_PATH+'/style.css?v=1.4'; 
		css.type = 'text/css';
		css.setAttribute('id', 'data_css');
		document.getElementsByTagName('head')[0].appendChild(css);
	}
	if(document.getElementById('data_block_BX') != null){
		document.getElementById('data_block_BX').remove();		
	}
	console.log(arParams);
	var iInputID   = arParams.oInput.id;
	var default_value = arParams.oInput.value;
	var parent = arParams.oInput.parentElement;
	var data_block = document.createElement("div");
	data_block.setAttribute('id', 'data_block_BX');
	parent.appendChild(data_block);
	
	//console.log('ok');
	//console.log(arParams.oInput.parentElement);
	//console.log(arParams.data); 
	
	if(default_value.length>0) {		
		console.log('ok2');
		console.log(default_value);
	} else {
		creatEl(data_block, arParams.data.TEXT_HEAD, arParams.data.TEXT_DESC, arParams.oInput);		
	}
	var data_button_add = document.createElement("button");
	data_button_add.setAttribute('id', 'data_button_add_BX');
	data_button_add.innerText = arParams.data.TEXT_ADD;
	parent.appendChild(data_button_add);
	data_button_add.onclick = function(){
		creatEl(data_block, arParams.data.TEXT_HEAD, arParams.data.TEXT_DESC, arParams.oInput);		
	};
	//data_button_add.addEventListener("click", creatEl(data_block, arParams.data.TEXT_HEAD, arParams.data.TEXT_DESC));
   /*
   arParams.oCont.appendChild(BX.create('input', {
      props : {
         'cols' : 50,
         'class' : 'custom_desc_input'
      },
      text: 'input'
   }));
   
   this.arParams.oCont.appendChild(BX.create('textarea', {
      props : {
         'cols' : 50,
         'rows' : 5,
         'class' : 'custom_desc_textarea'
      },
      html: 'textarea'
   }));
   */
}