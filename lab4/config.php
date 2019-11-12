<?php

session_start();
date_default_timezone_set('asia/krasnoyarsk');
define("DB_HOST", "localhost");
define("DB_USER", "labs");
define("DB_PASSWORD", "12321");
define("DB_NAME", "lab4");

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);