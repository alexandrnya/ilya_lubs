<?php


namespace DB\Catalog;


class Product
{

    public static function GetProducts(int $idSection)
    {
        global $mysqli;
        if($idSection > 0) {
            $arItem = [];
            // todo хотелка. В родительских категориях отображались товары всех дочерних категорий
            $query = "SELECT p.* FROM product p WHERE SECTION_ID = $idSection";
            $res = $mysqli->query($query);
            while($item = $res->fetch_assoc()) {
                $arItem[] = $item;
            }
            return $arItem;
        }
    }
}