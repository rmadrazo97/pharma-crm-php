<?php
/**
 * PHPMaker 2022 user level settings
 */
namespace PHPMaker2022\pharma;

// User level info
$USER_LEVELS = [["-2","Anonymous"]];
// User level priv info
$USER_LEVEL_PRIVS = [["{85AC1F7A-98A0-49C6-8015-B66CB252E443}customers","-2","0"],
    ["{85AC1F7A-98A0-49C6-8015-B66CB252E443}products","-2","0"],
    ["{85AC1F7A-98A0-49C6-8015-B66CB252E443}sales_order","-2","0"],
    ["{85AC1F7A-98A0-49C6-8015-B66CB252E443}sales_order_detail","-2","0"],
    ["{85AC1F7A-98A0-49C6-8015-B66CB252E443}users","-2","0"]];
// User level table info
$USER_LEVEL_TABLES = [["customers","customers","Clientes",true,"{85AC1F7A-98A0-49C6-8015-B66CB252E443}","CustomersList"],
    ["products","products","Productos",true,"{85AC1F7A-98A0-49C6-8015-B66CB252E443}","ProductsList"],
    ["sales_order","sales_order","Ordenes de compra",true,"{85AC1F7A-98A0-49C6-8015-B66CB252E443}","SalesOrderList"],
    ["sales_order_detail","sales_order_detail","sales order detail",true,"{85AC1F7A-98A0-49C6-8015-B66CB252E443}","SalesOrderDetailList"],
    ["users","users","Usuarios",true,"{85AC1F7A-98A0-49C6-8015-B66CB252E443}","UsersList"]];
