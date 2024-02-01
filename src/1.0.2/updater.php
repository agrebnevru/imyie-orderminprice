<?php

if (IsModuleInstalled('imyie.orderminprice')) {
	$eventManager = \Bitrix\Main\EventManager::getInstance();
	$eventManager->unRegisterEventHandler('sale', "OnSaleOrderBeforeSaved", 'imyie.orderminprice', '\Imyie\OrderMinPrice\Main', 'handlerOnSaleOrderBeforeSaved');
	$eventManager->registerEventHandler('sale', "OnSaleOrderBeforeSaved", 'imyie.orderminprice', '\Imyie\OrderMinPrice\Main', 'handlerOnSaleOrderBeforeSaved');
}
