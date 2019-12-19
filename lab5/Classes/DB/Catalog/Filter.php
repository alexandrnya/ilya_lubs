<?php


namespace DB\Catalog;


class Filter
{
    public static function getFilter(int $idSection = null)
    {
        global $mysqli;
        $arFilter = [];
        $arValues = [];
        if($idSection !== null) {
            $queryProp = "
SELECT DISTINCT pp.ID, pp.NAME
	FROM product_property pp
    LEFT JOIN product_property_value v ON v.PRODUCT_PROPERTY_ID = pp.ID
    LEFT JOIN product p ON v.PRODUCT_ID = p.ID
    LEFT JOIN section s ON s.ID = p.SECTION_ID
    WHERE s.ID = $idSection";
            $resProp = $mysqli->query($queryProp);
            if($resProp) {
                $queryVal = "
SELECT DISTINCT v.VALUE , v.PRODUCT_PROPERTY_ID
	FROM product_property pp
    LEFT JOIN product_property_value v ON v.PRODUCT_PROPERTY_ID = pp.ID
    LEFT JOIN product p ON v.PRODUCT_ID = p.ID
    LEFT JOIN section s ON s.ID = p.SECTION_ID
    WHERE s.ID = $idSection";
                $resVal = $mysqli->query($queryVal);
                while($itemVal = $resVal->fetch_assoc()) {
                    $arValues[] = $itemVal;
                }
                while($itemProp = $resProp->fetch_assoc()) {
                    $arValuesProp = [];
                    foreach($arValues as $arValue) {
                        if($arValue["PRODUCT_PROPERTY_ID"] == $itemProp["ID"])
                        $arValuesProp[] = $arValue;
                    }
                    $itemProp["VALUES"] = $arValuesProp;
                    $arFilter[] = $itemProp;
                }
            }
        }
        return $arFilter;
    }
}