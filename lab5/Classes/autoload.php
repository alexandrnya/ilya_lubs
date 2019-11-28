<?
define("PATH_TO_LAB", "lab4");
include_once $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_TO_LAB . "/config.php";

spl_autoload_register(function ($class_name) {
    include_once $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_TO_LAB . '/Classes/' . str_replace("\\", "/", $class_name) . '.php';
});