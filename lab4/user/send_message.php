<?php
include "../Classes/autoload.php";

use DB\Users;
use HTML\Template;
use PHPMailer\MyPHPMailer;

$objUser = new Users();
if (!(Users::checkLogin() && $arUser = $objUser->getArCurrentUser())) {
    header("Location: /" . PATH_TO_LAB . "/user/login.php");
    die;
}

if ($_POST["SEND"]) {

    if (!$addressee = $objUser->getByLogin($_POST["LOGIN"])) {
        $errors[][] = "Пользователя с таким логином не существует";
    } else {
        $mail = new MyPHPMailer;

// От кого
        $mail->setFrom($arUser["USERS_MAIL"], $arUser["FIRST_NAME"] . " " . $arUser["LAST_NAME"]);

// Кому
        $mail->addAddress($addressee["USERS_MAIL"], $addressee["FIRST_NAME"] . " " . $addressee["LAST_NAME"]);

// Тема письма
        $mail->Subject = $_POST["SUBJECT"];

// Тело письма
        $mail->msgHTML($_POST["MESSAGE"]);

        $mail->send();
    }
}

$template = new Template(); ?>
<?= $template->htmlHeader("Отправить сообщение другому пользователю на почту"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">

        <form method="post">
            <div id="errors">
                <? if ($errors) : ?>
                    <? foreach ($errors as $error): ?>
                        <? foreach ($error as $message): ?>
                            <div><?= $message ?></div>
                        <? endforeach; ?>
                    <? endforeach; ?>
                <? endif; ?>
            </div>
            <label>
                <div class="label_for_text">Логин получателя</div>
                <input type="text" name="LOGIN" required></label>

            <label>
                <div class="label_for_text">Тема письма</div>
                <input type="text" name="SUBJECT" required></label>

            <label>
                <div class="label_for_text">Текст сообщения</div>
                <textarea name="MESSAGE"></textarea></label>
            <label><input type="submit" name="SEND" value="Сохранить"></label>
        </form>
    </div>
<?= $template->htmlFooter(); ?>