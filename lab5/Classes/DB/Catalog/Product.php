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

    public static function GetPruductByID(int $id = null)
    {
        global $mysqli;
        $arItem = false;
        if($id !== null) {
            $query = "SELECT * FROM product WHERE ID = $id AND ACTIVE != 0";
            $dbRes = $mysqli->query($query);
            if($arRes = $dbRes->fetch_assoc()) {
                $arItem = $arRes;
            }
        }
        return $arItem;
    }

    public static function GetProperties(int $idProduct = null) {
        global $mysqli;
        $arProps = [];
        if($idProduct !== null) {
            $query = "
SELECT p.ID, p.NAME, v.PRODUCT_ID, GROUP_CONCAT(DISTINCT v.VALUE ORDER BY v.VALUE ASC SEPARATOR ', ') AS PROPERTY_VALUES
	FROM product_property_value v
    LEFT JOIN product_property p ON v.PRODUCT_PROPERTY_ID = p.ID
    WHERE v.PRODUCT_ID = $idProduct
    GROUP BY v.PRODUCT_PROPERTY_ID";
            $res = $mysqli->query($query);
            if($res) {
                while($item = $res->fetch_assoc()) {
                    $arProps[] = $item;
                }
            }
        }
        return $arProps;
    }

    public static function GetProductsByFilter(int $idSection = null, array $arFilter = null)
    {
        global $mysqli;

        $where = "";
        if($idSection !== null) {
            $where = "SECTION_ID = $idSection AND ";
        }
        foreach($arFilter as $idValue) {
            $idValue = (int)$idValue;
            if($idValue > 0) {
                $where .= "v.ID = $idValue AND ";
            }
        }
        $where .= "ACTIVE != 0";

        $arItem = [];
        $query = "
SELECT DISTINCT p.*
	FROM product p
    LEFT JOIN product_property_value v ON v.PRODUCT_ID = p.ID
    LEFT JOIN product_property pp ON pp.ID = v.PRODUCT_PROPERTY_ID
    WHERE $where";
        $res = $mysqli->query($query);
        while($item = $res->fetch_assoc()) {
            $arItem[] = $item;
        }
        return $arItem;
    }
}