<?php
include "../Classes/autoload.php";

use DB\Users;
use HTML\Template;

if(!Users::checkLogin()) {
    header("Location: /" . PATH_TO_LAB . "/user/login.php");
    die;
}

$template = new Template(); ?>
<?= $template->htmlHeader("Личный кабинет"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">

        <a href=""></a>
    </div>
<?= $template->htmlFooter(); ?>