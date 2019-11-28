<?php

session_start();
date_default_timezone_set('asia/krasnoyarsk');
define("DB_HOST", "mysql");
define("DB_USER", "root");
define("DB_PASSWORD", "secret");
define("DB_NAME", "lab4");

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
