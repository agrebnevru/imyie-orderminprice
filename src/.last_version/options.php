<?if(!$USER->IsAdmin()) return;

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config\Option;

IncludeModuleLangFile(__FILE__);

CModule::IncludeModule('imyie.orderminprice');

$aTabs = array(
	array(
		"DIV" => "imyie_tab1",
		"TAB" => Loc::getMessage("IMYIE.ORDER_MIN_PRICE.SETTINGS"),
		"ICON" => "settings",
		"TITLE" => Loc::getMessage("IMYIE.ORDER_MIN_PRICE.TITLE"),
	),
);
$arAllOptions = array(
	// watermart file
	'main' => array(
		array("on", Loc::getMessage("IMYIE.ORDER_MIN_PRICE.ON"), '', array('checkbox', 'Y')),
		array("min_price", Loc::getMessage("IMYIE.ORDER_MIN_PRICE.MIN_PRICE"), '', array('text', '')),
		array("error_message", Loc::getMessage("IMYIE.MORE_WATERMARK.ERROR_MESSAGE"), '', array('text', '')),
	),
);

if ((isset($_REQUEST["save"]) || isset($_REQUEST["apply"])) && check_bitrix_sessid()) {
	__AdmSettingsSaveOptions('imyie.orderminprice', $arAllOptions['main']);
	LocalRedirect($APPLICATION->GetCurPageParam());
}

$tabControl = new CAdminTabControl("tabControl", $aTabs);

?><form method="post" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>" name="imyie_omp"><?
	echo bitrix_sessid_post();

	$tabControl->Begin();

	$tabControl->BeginNextTab();

	__AdmSettingsDrawList('imyie.orderminprice', $arAllOptions["main"]);

	$tabControl->Buttons(array());
	$tabControl->End();

?></form>
