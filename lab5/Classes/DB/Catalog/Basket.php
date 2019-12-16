<?php


namespace DB\Catalog;


class Basket
{
    public static function add($arBasket) {
        global $mysqli;
        $res1 = $mysqli->query("SELECT QUANTITY FROM basket WHERE USER_ID = $arBasket[USER_ID] AND PRODUCT_ID = $arBasket[PRODUCT_ID]");
        if($res1 && $item = $res1->fetch_assoc()) {
            $quantity = $item["QUANTITY"] + $arBasket["QUANTITY"];
            $res = $mysqli->query("UPDATE basket SET QUANTITY = $quantity WHERE USER_ID = $arBasket[USER_ID] AND PRODUCT_ID = $arBasket[PRODUCT_ID]");
        } else {
            $res = $mysqli->query("INSERT INTO basket(USER_ID, PRODUCT_ID, QUANTITY) value($arBasket[USER_ID], $arBasket[PRODUCT_ID], $arBasket[QUANTITY])");
        }
        return $res;
    }

    public static function getCount($idUser) {
        global $mysqli;
        $count = 0;
        $res = $mysqli->query("SELECT QUANTITY FROM basket WHERE USER_ID = $idUser");
        if($res) {
            while($item = $res->fetch_assoc()) {
                $count += $item["QUANTITY"];
            }
            return $count;
        }
    }
    
    public static function getBasketItemsByUserID($idUser) {
        global $mysqli;
        $arBasket = [];
        $res = $mysqli->query("SELECT b.ID, b.QUANTITY, p.NAME, p.PRICE FROM basket b left join product p ON p.ID = b.PRODUCT_ID WHERE b.USER_ID = $idUser ORDER BY p.NAME");
        if($res) {
            while($item = $res->fetch_assoc()) {
                $arBasket[] = $item;
            }
        }
        return $arBasket;
    }

    public static function deleteByID(int $id = null)
    {
        global $mysqli;
        if($id !==null && $id >= 0) {
            $res = $mysqli->query("DELETE FROM basket WHERE ID = $id");
            return $res;
        }
        return false;
    }
}