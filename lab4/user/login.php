<?php
include "../Classes/autoload.php";

use DB\Users;
use HTML\Template;
$errors = [];
if (!empty($_SESSION["USER_ID"])) {
    header("Location: /" . PATH_TO_LAB . "/user/cabinet.php");
} else {
    if ($_POST["LOG_IN"]) {
        $user = new Users();
        $userID = $user->LogIn($_POST);
        if (!empty($userID)) {
        $_SESSION["USER_ID"] = $userID;
            header("Location: /" . PATH_TO_LAB . "/user/cabinet.php");
        } else {
            $errors[][] = "Неверный логин или пароль";
        }
    }
}
$template = new Template(); ?>
<?= $template->htmlHeader("Авторизация"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <form method="post">
            <div id="errors">
                <? foreach ($errors as $error): ?>
                    <?foreach ($error as $message):?>
                        <div><?= $message ?></div>
                    <? endforeach; ?>
                <? endforeach; ?>
            </div>
            <label><div class="label_for_text">Логин или Email</div>
                <input type="text" name="LOGIN_OR_EMAIL" value="<?= $_POST["LOGIN_OR_EMAIL"] ?: "" ?>" required></label>
            <label><div class="label_for_text">Пароль</div>
                <input type="password" name="PASSWORD" value="<?= $_POST["PASSWORD"] ?: "" ?>" required></label>
            <label><input type="submit" name="LOG_IN" value="Войти"></label>
        </form>
    </div>
<?= $template->htmlFooter(); ?>