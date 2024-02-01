<?php
namespace Imyie\OrderMinPrice;

use \Bitrix\Main\Config\Option;

class Main
{
	
	public static function OnSaleComponentOrderOneStepProcess(&$arResult) {
		
		$on = Option::get('imyie.orderminprice', 'on', 'N');
		if ($on != 'Y') 
			return true;
		
		$minPrice = Option::get('imyie.orderminprice', 'min_price', 0);
		$errorMessage = Option::get('imyie.orderminprice', 'error_message', '');
		
		if (empty($minPrice) || empty($errorMessage))
			return true;
		
		if ($arResult['ORDER_DATA']['ORDER_PRICE'] < $minPrice) {
			$arResult["ERROR"] = array();
			$arResult["ERROR"][] = $errorMessage;
		}
		
	}
	
}
