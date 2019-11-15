<?php
require "../../lib/PHPMailer/autoload.php";

use PHPMailer\PHPMailer\PHPMailer as PHPMailerEx;

class MyPHPMailer extends PHPMailerEx
{
    function __construct()
    {
        $this->isMail();
        $this->IsHTML(true);
        $this->CharSet = "UTF-8";
        $this->SMTPDebug = 3;

        $this->From = "ilya@labs.ru";
        $this->FromName = "=?$this->CharSet?B?" . "Илюша" . "?=";
	}

    function addSubject($subject)
    {
        $this->Subject = "=?$this->CharSet?B?" . $subject . "?=";
    }
}

?>