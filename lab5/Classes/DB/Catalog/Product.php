<?php


namespace DB\Catalog;


class Product
{
    public static function GetProductsBySectionID(int $idSection = null)
    {
        global $mysqli;

        $where = "";
        if($idSection !== null) {
            $where = "SECTION_ID = $idSection AND ";
        }
        $where .= "ACTIVE != 0";

            $arItem = [];
            // todo хотелка. В родительских категориях отображались товары всех дочерних категорий
            $query = "SELECT p.* FROM product p WHERE $where";
            $res = $mysqli->query($query);
            while($item = $res->fetch_assoc()) {
                $arItem[] = $item;
            }
            return $arItem;
    }

    public static function GetPruductByID(int $id = null) {
        global $mysqli;
        static $arItem;
        if(empty($arItem)) {
            if ($id !== null) {
                $query = "SELECT * FROM product WHERE ID = $id AND ACTIVE != 0";
                $dbRes = $mysqli->query($query);
                if ($arRes = $dbRes->fetch_assoc()) {
                    $arItem = $arRes;
                }
            }
        }
        return $arItem;
    }

    public static function GetProperties() {

    }
}