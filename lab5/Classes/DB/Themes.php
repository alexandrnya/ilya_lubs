<?php


namespace DB;


class Themes
{
    private $DB;

    public function __construct()
    {
        global $mysqli;
        $this->DB = $mysqli;
    }

    public function getAllThemes() {
        $result = [];
        $dbRes = $this->DB->query("SELECT THEMES_ID, THEMES_NAME, THEMES_PATH FROM themes");
        while ($arNews = $dbRes->fetch_assoc()) {
            $result[] = $arNews;
        }
        return $result;
    }
}