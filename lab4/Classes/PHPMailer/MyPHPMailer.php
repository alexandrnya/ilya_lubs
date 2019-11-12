<?php

namespace PHPMailer;

use PHPMailer\PHPMailer\PHPMailer;

require_once(__DIR__ . '/lib/PHPMailer.php');
require_once(__DIR__ . '/lib/Exception.php');
require_once(__DIR__ . '/lib/OAuth.php');
require_once(__DIR__ . '/lib/SMTP.php');
require_once(__DIR__ . '/lib/POP3.php');


class MyPHPMailer extends PHPMailer
{
    var $priority = 3;
    var $CharSet = 'UTF-8';
    var $to_email;
    var $From = null;
    var $FromName = null;
    var $Sender = null;

    function __construct()
    {
        $this->CharSet = 'UTF-8';

// Настройки SMTP
        $this->isSMTP();
        $this->SMTPAuth = true;
        $this->SMTPDebug = 0;

        $this->Port = 465;
        $this->Host = 'ssl://smtp.mail.ru';
        $this->Username = 'Ilya_labs';
        $this->Password = 'NJM)km&9E7!.![s';


    }
}