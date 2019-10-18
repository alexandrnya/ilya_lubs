<?php


class Users
{
    function __construct() {
        include "config.php";
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
}