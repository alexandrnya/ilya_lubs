<?php


namespace DB\Catalog;


class Section
{
    static function GetChildSections(int $idParent = null)
    {
        global $mysqli;
        if($idParent === null) {
            $where = "PARENT_ID IS NULL";
        } else {
            $where = "PARENT_ID = $idParent";
        }
        $where .= " AND ACTIVE != 0";
        $arItem = [];
        $query = "SELECT * FROM section WHERE $where";
        $res = $mysqli->query($query);
        while($item = $res->fetch_assoc()) {
            $arItem[] = $item;
        }
        return $arItem;
    }

    static function GetCurrentSection(int $id)
    {
        global $mysqli;
        $query = "SELECT * FROM section WHERE ID = $id AND ACTIVE != 0";
        $res = $mysqli->query($query);
        if($item = $res->fetch_assoc()) {
            return $item;
        }
        return false;
    }

    public static function getAllSection()
    {
        global $mysqli;
        $arItem = [];
        $query = "SELECT * FROM section WHERE ACTIVE != 0";
        $res = $mysqli->query($query);
        if($res) {
            while($item = $res->fetch_assoc()) {
                $arItem[$item["ID"]] = $item;
            }
        }
        return $arItem;
    }
}