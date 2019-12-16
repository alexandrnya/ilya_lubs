<?php

use DB\Catalog\Basket;
use DB\Catalog\Product;
use DB\Users;

include_once "../Classes/autoload.php";
$UserObj =  new Users();

$arBasket = [
    "USER_ID" => $_REQUEST["USER_ID"],
    "PRODUCT_ID" => $_REQUEST["PRODUCT_ID"],
    "QUANTITY" => ($_REQUEST["QUANTITY"] ?: 1)
];
$arProduct = Product::GetPruductByID($arBasket["PRODUCT_ID"]);
$arUser = $UserObj->getArUserByID($arBasket["USER_ID"]);
if($arBasket["USER_ID"] && $arBasket["PRODUCT_ID"]) {
    if(Basket::add($arBasket)) {
        $quantity = Basket::getCount($arBasket["USER_ID"]);
        echo json_encode($quantity);
    } else {
        echo json_encode(false);
    }
} else {
    echo json_encode(false);
}
