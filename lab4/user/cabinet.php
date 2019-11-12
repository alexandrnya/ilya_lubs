<?php
include "../Classes/autoload.php";

use DB\Users;
use HTML\Template;

if (!Users::checkLogin()) {
    header("Location: /" . PATH_TO_LAB . "/user/login.php");
    die;
}

$template = new Template(); ?>
<?= $template->htmlHeader("Личный кабинет"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">

        <a href="/<?= PATH_TO_LAB ?>/news/addNews.php">Добавить новость</a> <br/>
        <a href="/<?= PATH_TO_LAB ?>/user/edit.php">Изменить аккаунт</a> <br/>
        <a href="/<?= PATH_TO_LAB ?>/user/send_message.php">Отправить сообщение</a>

    </div>
<?= $template->htmlFooter(); ?>