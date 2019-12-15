<?php


namespace HTML\Catalog\Product;


use DB\Catalog\Product;

class Detail
{
    public static function ProductDetail($id) {
        $arProduct = Product::GetPruductByID($id);
        if($arProduct) {

        } else {
            // todo redirect 404
        }
    }
}