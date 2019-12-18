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
        $where .= "ACTIVE != 0";

        $filterCount = 0;
        if(!empty($arFilter)) {
            $where .= " AND (";
            foreach($arFilter as $idProperty => $value) {
                if($value) {
                    $where .= "( pp.id = $idProperty and ( ppv.value = '$value' or ppv.value is null ) ) or";
                } else {
                    $where .= "( pp.id = $idProperty and ( ppv.value is not null ) ) or";
                }
                $filterCount ++;
            } if($filterCount > 0) {
                $where = substr($where, 0, -3);
            }
            $where .= ")";
        }
        if($filterCount <= 0) {
            return self::GetProductsBySectionID($idSection);
        }

        $arItem = [];
        $query = "
select	p.ID,
		p.NAME,
        p.PICTURE,
		count(distinct pp.id) as PP_COUNT,
        group_concat(pp_for_concat.name ORDER BY pp_for_concat.name ASC SEPARATOR ', ') as NOT_MATCHED -- Параметры, по которым не было значений в product_property_value - но считаем, что NULL не должен мешать получению выборки, но сообщить об этом нужно.
from	product p
			cross join product_property pp
				left join product_property_value ppv on (
					ppv.product_id = p.id
                    and ppv.product_property_id = pp.id
                )
                left join product_property pp_for_concat on (
					pp_for_concat.id = pp.id
                    and ppv.id is null
                )
where	($where)
group by
		p.ID,
        p.NAME,
        p.PICTURE
having
		PP_COUNT = $filterCount -- Количество секций проверок в Условии А";
        $res = $mysqli->query($query);
        while($item = $res->fetch_assoc()) {
            $arItem[] = $item;
        }
        return $arItem;
    }
}