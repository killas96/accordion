<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_js.php");

$arParams["DATA"]["JS_DATA"] = json_decode($_REQUEST['params'],true);

if(!isset($arParams["DATA_COUNT"]) || empty($arParams["DATA_COUNT"]))
	$arParams["DATA_COUNT"] = 5;

$PATH_COMPONENT = $arParams["DATA"]["JS_DATA"]["THIS_PATH"];

__IncludeLang($_SERVER["DOCUMENT_ROOT"].$PATH_COMPONENT.'/lang/'.LANGUAGE_ID.'/settings.php');

$obJSPopup = new CJSPopup('',
	array(
		'TITLE' => GetMessage('DATA_POPUP_TITLE'),
		'SUFFIX' => 'data_form',
		'ARGS' => ''
	)
);

$arData = array();
if ($_REQUEST['FORM_DATA']) {
	#CUtil::JSPostUnescape();
	//$arData = json_decode($_REQUEST['FORM_DATA'], true);
	//print_r($_REQUEST['FORM_DATA']);
	$arData = json_decode(base64_decode($_REQUEST['FORM_DATA']),true);
}

$formId = (string)rand(0, 1000000);
?>
<script type="text/javascript" src="<?=$PATH_COMPONENT?>/settings/settings_load.js?v=<?=time()?>"></script>
<script type="text/javascript">
	BX.loadCSS("<?=$PATH_COMPONENT?>/settings/settings.css?v=<?=time()?>");
	var arData = '{}';
	window._global_BX_UTF = <?echo defined('BX_UTF') && BX_UTF == true ? 'true' : 'false'?>;
</script>
<form name="bx_popup_form_data_form_<?=$formId?>" id="bx_popup_form_data_form_<?=$formId?>">
	<?
		//print_r($arData);
		$obJSPopup->ShowTitlebar();
		$obJSPopup->StartDescription('bx-edit-menu');
	?>
		<p><b><?echo GetMessage('DATA_POPUP_TITLE')?></b></p>
		<p class="note"><?echo GetMessage('DATA_POPUP_DESC')?></p>
	<?
		$obJSPopup->StartContent();
		CModule::IncludeModule("fileman");
	?>
	<div class="wrapperBlock" id="wrapperBlock_<?=$formId?>">
		<div class="toCopyBlock" style="display:none;"> 
			<div>x</div>
			<label for="data_s_<?=$formId?>_"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_SORT"]?></b>
				<input type="text" name="data_s[]" id="data_s_<?=$formId?>_" placeholder="<?=$arParams["DATA"]["JS_DATA"]["TEXT_SORT"]?>" form="bx_popup_form_data_form_<?=$formId?>" value="500"/>
			</label>
			<label for="data_h_<?=$formId?>_"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_HEAD"]?></b>
				<input type="text" name="data_h[]" placeholder="<?=$arParams["DATA"]["JS_DATA"]["TEXT_HEAD"]?>" form="bx_popup_form_data_form_<?=$formId?>"/>
			</label>
			<label for="data_d_<?=$formId?>_"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_DESC"]?></b>
				<textarea name="data_d[]" placeholder="<?=$arParams["DATA"]["JS_DATA"]["TEXT_DESC"]?>" form="bx_popup_form_data_form_<?=$formId?>"></textarea>
			</label>
		</div>
		<?
			foreach($arData as $k=>$data) {
		?>
			<div class="toCopyBlock">
				<div onclick="return jsFormBlock.__dataDel(this.parentNode);">x</div>
				<label for="data_s_<?=$formId?>_<?=$k?>"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_SORT"]?></b>
					<input type="text" name="data_s[]" id="data_s_<?=$formId?>_<?=$k?>" placeholder="<?=$arParams["DATA"]["JS_DATA"]["TEXT_SORT"]?>" form="bx_popup_form_data_form_<?=$formId?>" value="<?=$data['s'] ? $data['s'] : 500?>"/>
				</label>
				<label for="data_h_<?=$formId?>_<?=$k?>"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_HEAD"]?></b>
					<input type="text" name="data_h[]" id="data_h_<?=$formId?>_<?=$k?>" placeholder="<?=$arParams["DATA"]["JS_DATA"]["TEXT_HEAD"]?>" form="bx_popup_form_data_form_<?=$formId?>" value="<?=$data['h']?>"/>
				</label>
				<label for="data_d_<?=$formId?>_<?=$k?>"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_DESC"]?></b>
					<?
					/// https://hello-site.ru/share/bitriksovskij-vizivig-clightht/
					$LHE = new CLightHTMLEditor;
					$LHE->Show(array(
						'id' => "flm_" . $formId . "_" . $k,
						'width' => "100%",
						'height' => "224px",
						'inputName' => "data_d[]",
						'inputId' => "data_d_" . $formId . "_" . $k,
						'content' => htmlspecialchars_decode($data['d']),
						'bUseFileDialogs' => true,
						'bFloatingToolbar' => false,
						'bArisingToolbar' => false,
						'toolbarConfig' => array(/* кнопки редактирования */
							'Bold', 'Italic', 'Underline', 'RemoveFormat', 'Html',
							'CreateLink', 'DeleteLink', 'Image', 'Video',
							'BackColor', 'ForeColor',
							'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
							'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
							'StyleList', 'HeaderList',
							//'FontList', 'FontSizeList',
							'Source', 
						),
					)); 					
					?>
				</label>
				<hr>
			</div>
		<?
			}
			
			for($i = 0; $i < $arParams["DATA_COUNT"]; $i++){
				$k = $k + 1;
		?>		
		<div class="toCopyBlock">
			<div onclick="return jsFormBlock.__dataDel(this.parentNode);">x</div>
			<label for="data_s_<?=$formId?>_<?=$k?>"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_SORT"]?></b>
				<input type="text" name="data_s[]" placeholder="<?=$arParams["DATA"]["JS_DATA"]["TEXT_SORT"]?>" form="bx_popup_form_data_form_<?=$formId?>" value="500"/>
			</label>
			<label for="data_h_<?=$formId?>_<?=$k?>"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_HEAD"]?></b>
				<input type="text" name="data_h[]" placeholder="<?=$arParams["DATA"]["JS_DATA"]["TEXT_HEAD"]?>" form="bx_popup_form_data_form_<?=$formId?>"/>
			</label>
			<label for="data_d_<?=$formId?>_<?=$k?>"><b><?=$arParams["DATA"]["JS_DATA"]["TEXT_DESC"]?></b>
				<?
				$LHE = new CLightHTMLEditor;
					$LHE->Show(array(
						'id' => "flm_" . $formId . "_" . $k,
						'width' => "100%",
						'height' => "224px",
						'inputName' => "data_d[]",
						'inputId' => "data_d_" . $formId . "_" . $k,
						'content' => "",
						'bUseFileDialogs' => true,
						'bFloatingToolbar' => false,
						'bArisingToolbar' => false,
						'toolbarConfig' => array(/* кнопки редактирования */
							'Bold', 'Italic', 'Underline', 'RemoveFormat', 'Html',
							'CreateLink', 'DeleteLink', 'Image', 'Video',
							'BackColor', 'ForeColor',
							'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
							'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
							'StyleList', 'HeaderList',
							//'FontList', 'FontSizeList',
							'Source', 
						),
					)); 				
				?>
			</label>
			<hr>
		</div>
		<?
			}			
		?>
	</div>
	<div class="wrapperBlock" style="display:none;">
		<span onclick="return jsFormBlock.__dataAdd('wrapperBlock_<?=$formId?>');" id="data_form_add"><?=$arParams["DATA"]["JS_DATA"]["TEXT_ADD"]?></span>
	</div>

<script type="text/javascript">
	jsFormBlock.init({
		formId: '<?=$formId?>'
	});
</script>
<?
$obJSPopup->StartButtons();
?>
<input type="submit" value="<?echo GetMessage('DATA_POPUP_SAVE')?>" onclick="return jsFormBlock.__saveChanges();" class="adm-btn-save"/>
<?
$obJSPopup->ShowStandardButtons(array('cancel'));
$obJSPopup->EndButtons();
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin_js.php");?>