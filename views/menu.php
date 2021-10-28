<?php

namespace PHPMaker2022\pharma;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi_customers", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "CustomersList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_products", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "ProductsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_sales_order", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "SalesOrderList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_sales_order_detail", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "SalesOrderDetailList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_users", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "UsersList", -1, "", true, false, false, "", "", false);
echo $sideMenu->toScript();
