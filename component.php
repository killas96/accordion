<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult = array();
if ($this->StartResultCache(false, false)) {
	$arResult["HEADER"] = array(
		"FONT_COLOR" => $arParams["DATA_HEAD_FS_COLOR"],
		"BG_COLOR" => $arParams["DATA_HEAD_BLOCK_COLOR"],
		"FONT_SIZE" => (int)$arParams["DATA_HEAD_FS"] . 'px'
	);
	$arResult["DESCRIPTION"] = array(
		"FONT_COLOR" => $arParams["DATA_DESC_FS_COLOR"],
		"BG_COLOR" => $arParams["DATA_DESC_BLOCK_COLOR"],
		"FONT_SIZE" => (int)$arParams["DATA_DESC_FS"] . 'px'
	);
	$arResult["TEMP"] = json_decode(base64_decode($arParams["DATA"]),true);
	$i = 0;
	foreach($arResult["TEMP"] as $ITEM) {
		$arResult["ITEMS"][$i]['HEADER'] = htmlspecialcharsEx($ITEM['h']);
		$arResult["ITEMS"][$i]['DESCRIPTION'] = $ITEM['d'];
		$arResult["ITEMS"][$i]['SORT'] = (int)$ITEM['s'];
		$arResult["ITEMS"][$i]['~HEADER'] = $ITEM['h'];
		$arResult["ITEMS"][$i]['~DESCRIPTION'] = $ITEM['d'];
		$arResult["ITEMS"][$i]['~SORT'] = $ITEM['s'];
		$i++;
	}
	unset($arResult["TEMP"], $i);
	$this->IncludeComponentTemplate();
}
?>