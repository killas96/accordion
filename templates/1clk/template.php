<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

#echo '<pre>';print_r($arParams);echo '</pre>';
#echo '<pre>';print_r($arResult);echo '</pre>';
	
if(!empty($arResult["ITEMS"])){
?>
	<div class="panel-block" id="accordion_">
		<?
			foreach($arResult['ITEMS'] as $key=>$item) {
		?>
		<div class="panel-element">
			<div class="panel-header">
				<div class="panel-title" style="background-color:<?=$arResult["HEADER"]["BG_COLOR"]?>;">
					<a role="button" data-parent="#accordion_" aria-controls="collapse<?=$key?>" style="color:<?=$arResult["HEADER"]["FONT_COLOR"]?>;font-size:<?=$arResult["HEADER"]["FONT_SIZE"]?>;" class="collapsed" onclick="accordionToogle(this);">
						<?=$item['HEADER']?>
					</a>
				</div>
			</div>
			<div id="collapse<?=$key?>" class="panel-collapse collapse" role="tabpanel">
				<div class="panel-description" style="background-color:<?=$arResult["DESCRIPTION"]["BG_COLOR"]?>;" style="color:<?=$arResult["DESCRIPTION"]["FONT_COLOR"]?>;font-size:<?=$arResult["DESCRIPTION"]["FONT_SIZE"]?>;">
					<?=$item['DESCRIPTION']?>
				</div>
			</div>
		</div>
		<?
			}
		?>
	</div>
<?
	}
?>