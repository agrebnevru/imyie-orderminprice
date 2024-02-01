<?php

if (IsModuleInstalled('imyie.orderminprice')) {
	UnRegisterModuleDependences("sale", "OnSaleComponentOrderOneStepProcess", "imyie.orderminprice", "Imyie\\OrderMinPrice\\Main", "OnSaleComponentOrderOneStepProcess");
	
	$eventManager = \Bitrix\Main\EventManager::getInstance();
	$eventManager->registerEventHandler('sale', "OnSaleOrderBeforeSaved", 'imyie.orderminprice', '\Imyie\OrderMinPrice\Main', 'handlerOnSaleOrderBeforeSaved');
}
