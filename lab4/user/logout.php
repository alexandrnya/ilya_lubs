<?php
include "../Classes/autoload.php";

unset($_SESSION["USER_ID"]);
header("Location: /" . PATH_TO_LAB . "/user/login.php");
