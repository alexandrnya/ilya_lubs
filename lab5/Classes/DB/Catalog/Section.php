<?php


namespace DB\Catalog;


class Section
{
    static function GetChildSections(
        int $idParent = 0)
    {
        global $mysqli;
        $arItem = [];
        $query = "SELECT * FROM section WHERE PARENT_ID = $idParent";
        $res = $mysqli->query($query);
        while($item = $res->fetch_assoc()) {
            $arItem[] = $item;
        }
        return $arItem;
    }

    static function GetCurrentSection(int $id)
    {
        global $mysqli;
        $query = "SELECT * FROM section WHERE ID = $id";
        $res = $mysqli->query($query);
        if($item = $res->fetch_assoc()) {
            return $item;
        }
        return false;
    }
}