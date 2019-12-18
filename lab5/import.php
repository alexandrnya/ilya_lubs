<?php
include "Classes/autoload.php";

$csv = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/lab5/DB/catalog.csv");
$csv = iconv('Windows-1251', 'UTF-8', $csv);
$delimiter = ";";

if($csv) {
    $arProducts = [];
    $rows = explode("\n", $csv);
    $arHeaders = explode($delimiter, trim($rows[0]));
    
    unset($rows[0]);
    foreach($rows as $row) {
        $arProduct = [];
        $cols = explode($delimiter, trim($row));
        if($cols[array_search("NAME", $arHeaders)]) {
            foreach($arHeaders as $keyHeader => $nameHeader) {            
                switch($nameHeader) {
                    case "NAME":
                    case "PRICE":
                    case "SECTION_NAME" :
                    case "PICTURE" :
                    {
                        $arProduct[$nameHeader] =
                            // Удалим пробелы и ковычки если они есть
                            preg_replace(["|^\"|", "|\"$|", "|^ |", "| $|"], "", $cols[$keyHeader]);
                        break;
                    }
                    default:
                    {
                        $arProduct["PROPERTIES"][$keyHeader] =
                            // Удалим пробелы и ковычки если они есть
                            preg_replace(["|^\"|", "|\"$|", "|^ |", "| $|"], "", $cols[$keyHeader]);
                    }
                }
            }
        }
        if(!empty($arProduct)) {
            $arProducts[] = $arProduct;
        }
    }
    
    foreach($arProducts as $product) {
        foreach($product["PROPERTIES"] as $keyProp => $valueProp) {
            $arProps[$keyProp] = explode(",", $valueProp);
        }
        unset($product["PROPERTIES"]);
        $res = $mysqli->query("SELECT ID FROM section WHERE NAME = '$product[SECTION_NAME]'");
        if($res && $dbSecrion = $res->fetch_assoc()) {
            $idSection = $dbSecrion["ID"];
        }
        else {
            $res = $mysqli->query("INSERT INTO section(NAME) VALUE('$product[SECTION_NAME]')");
            $idSection = $mysqli->insert_id;
        }

        $res = $mysqli->query("SELECT ID FROM product WHERE NAME = '$product[NAME]'");
        if($res && $dbProduct = $res->fetch_assoc()) {
            $idProduct = $dbProduct["ID"];
            $res = $mysqli->query("UPDATE product SET PRICE = '$product[PRICE]', PICTURE = '$product[PICTURE]', SECTION_ID = $idSection WHERE ID = $idProduct");
        }
        else {
            $res = $mysqli->query("INSERT INTO product(NAME,PRICE,PICTURE,SECTION_ID) value('$product[NAME]','$product[PRICE]','$product[PICTURE]',$idSection)");
            $idProduct = $mysqli->insert_id;
        }
        
        foreach($arProps as $keyProp => $arValuesProp) {
            $nameProp = $arHeaders[$keyProp];
            $res = $mysqli->query("SELECT ID FROM product_property WHERE NAME = '$nameProp'");
            if($res && $dbProperty = $res->fetch_assoc()) {
                $idProperty = $dbProperty["ID"];
            }
            else {
                $res = $mysqli->query("INSERT INTO product_property(NAME) value('$nameProp')");
                $idProperty = $mysqli->insert_id;
            }
            $mysqli->query("DELETE FROM product_property_value WHERE PRODUCT_ID = $idProduct AND PRODUCT_PROPERTY_ID = $idProperty");
            foreach($arValuesProp as $valueProp) {                
                $res = $mysqli->query("INSERT INTO product_property_value(PRODUCT_ID, PRODUCT_PROPERTY_ID, VALUE) VALUE($idProduct, $idProperty, '$valueProp')");
                $idValue = $mysqli->insert_id;
            }
        }
    }
    echo "Success!";
}