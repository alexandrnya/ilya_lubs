<?php


namespace DB\Catalog;


class Order
{

    public static function addOrder(array $arOrder, int $idUser)
    {
        global $mysqli;
        $query = "insert into orders(EMAIL, PHONE, CITY, USER_ID) values('$arOrder[EMAIL]', '$arOrder[PHONE]', '$arOrder[CITY]', $idUser)";
        $res = $mysqli->query($query);
        if($res && $idOrder = $mysqli->insert_id) {
            foreach($arOrder["ITEM"] as $idProduct => $values) {
                $quantity = (int)$values["QUANTITY"];
                if($quantity > 0) {
                    $mysqli->query("insert into product_order(PRODUCT_ID, ORDER_ID, QUANTITY) values($idProduct, $idOrder, $quantity)");
                }
            }
        } else {
            return false;
        }
        return true;
    }
}