<?php
include "Classes/autoload.php";
$csv = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/lab5/DB/catalog.csv");
$csv = iconv('Windows-1251', 'UTF-8', $csv);
$delimiter = ",";
if($csv) {
    $arProducts = [];
    $rows = explode("\n", $csv);
    $arHeaders = explode($delimiter, $rows[0]);
    unset($rows[0]);
    foreach($rows as $row) {
        $cols = explode($delimiter, $row);
        foreach($arHeaders as $keyHeader => $nameHeader) {
            $id = $cols[array_search("ID", $arHeaders)];
            if($id) {
                switch($nameHeader) {
                    case "NAME":
                    case "PRICE":
                    case "ID" :
                    case "SECTION_NAME" :
                    case "PICTURE" :
                    {
                        $arProducts[$id][$nameHeader] =
                            preg_replace(["|^\"|", "|\"$|", "|^ |", "| $|"], "", $cols[$keyHeader]);
                        break;
                    }
                    default:
                    {
                        $arProducts[$id]["PROPERTIES"][$nameHeader][] =
                            preg_replace(["|^\"|", "|\"$|", "|^ |", "| $|"], "", $cols[$keyHeader]);
                    }
                }
            }
        }
    }
    foreach($arProducts as $product) {
        $arProps = $product["PROPERTIES"];
        unset($product["PROPERTIES"]);
        $res = $mysqli->query("SELECT ID FROM section WHERE NAME = '$product[SECTION_NAME]'");
        if($res && $dbSecrion = $res->fetch_assoc()) {
            $idSection = $dbSecrion["ID"];
        } else {
            $res = $mysqli->query("INSERT INTO section(NAME) VALUE('$product[SECTION_NAME]')");
            $idSection = $mysqli->insert_id;
        }
        
        $res = $mysqli->query("SELECT ID FROM product WHERE NAME = '$product[NAME]'");
        if($res && $dbProduct = $res->fetch_assoc()) {
            $idProduct = $dbProduct["ID"];
        } else {
            $res = $mysqli->query("INSERT INTO product(NAME,PRICE,PICTURE,SECTION_ID) value('$product[NAME]','$product[PRICE]','$product[PICTURE]',$idSection)");
            $idProduct = $mysqli->insert_id;
        }
        
    }
}