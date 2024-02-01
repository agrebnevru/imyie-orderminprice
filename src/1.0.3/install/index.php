<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class imyie_orderminprice extends CModule
{
    public $MODULE_ID = "imyie.orderminprice";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_CSS;
    public $MODULE_GROUP_RIGHTS = "Y";

    public function __construct()
    {
        $arModuleVersion = array();
        include(dirname(__FILE__) . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = GetMessage("IMYIE.ORDER_MIN_PRICE.MODULE_INSTALL_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("IMYIE.ORDER_MIN_PRICE.INSTALL_DESCRIPTION");
        $this->PARTNER_NAME = GetMessage("IMYIE.ORDER_MIN_PRICE.INSTALL_COPMPANY_NAME");
        $this->PARTNER_URI = "https://agrebnev.ru/";
    }

    public function InstallDB()
    {
        ModuleManager::registerModule("imyie.orderminprice");

        COption::SetOptionString(
            "imyie.orderminprice",
            "min_price",
            GetMessage('IMYIE.ORDER_MIN_PRICE.INSTALL_MIN_PRICE')
        );

        COption::SetOptionString(
            "imyie.orderminprice",
            "error_message",
            GetMessage('IMYIE.ORDER_MIN_PRICE.INSTALL_ERROR_MESSAGE')
        );

        return true;
    }

    public function InstallFiles()
    {
        return true;
    }

    public function InstallPublic()
    {
        return true;
    }

    public function InstallEvents()
    {
        RegisterModuleDependences(
            "sale",
            "OnSaleComponentOrderOneStepProcess",
            "imyie.orderminprice",
            "Imyie\\OrderMinPrice\\Main",
            "OnSaleComponentOrderOneStepProcess",
            10000
        );
        return true;
    }

    public function UnInstallDB($arParams = array())
    {
        ModuleManager::unRegisterModule("imyie.orderminprice");

        return true;
    }

    public function UnInstallFiles()
    {
        return true;
    }

    public function UnInstallPublic()
    {
        return true;
    }

    public function UnInstallEvents()
    {
        COption::RemoveOption("imyie.orderminprice");

        UnRegisterModuleDependences(
            "sale",
            "OnSaleComponentOrderOneStepProcess",
            "imyie.orderminprice",
            "Imyie\\OrderMinPrice\\Main",
            "OnSaleComponentOrderOneStepProcess"
        );

        return true;
    }

    public function DoInstall()
    {
        global $APPLICATION, $step;

        $this->InstallFiles();
        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallPublic();

        $APPLICATION->IncludeAdminFile(
            GetMessage("SPER_INSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/imyie.orderminprice/install/install.php"
        );
    }

    public function DoUninstall()
    {
        global $APPLICATION, $step;

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();
        $this->UnInstallPublic();

        $APPLICATION->IncludeAdminFile(
            GetMessage("SPER_UNINSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/imyie.orderminprice/install/uninstall.php"
        );
    }
}
