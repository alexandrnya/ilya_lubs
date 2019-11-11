<?php
include "../Classes/autoload.php";

use DB\Themes;
use DB\Users;
use HTML\Template;

$objUser = new Users();
if (!(Users::checkLogin() && $arUser = $objUser->getArCurrentUser())) {
    header("Location: /" . PATH_TO_LAB . "/user/login.php");
    die;
}

$objTheme = new Themes();
$arThemes = $objTheme->getAllThemes();

if ($_POST["SAVE"]) {
    $user = new Users();
    $user->updateUser($_POST);
    $errors = $user->GetMessages();
    if (empty($errors) && !empty($_SESSION["USER_ID"])) {
        header("Location: /" . PATH_TO_LAB . "/user/cabinet.php");
        die;
    }
}

$template = new Template(); ?>
<?= $template->htmlHeader("Изменить пользователя"); ?>
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
                <div class="label_for_text">Логин</div>
                <input type="text" name="LOGIN" value="<?= $arUser["USERS_LOGIN"] ?: "" ?>" required></label>
            <label>
                <div class="label_for_text">E-Mail</div>
                <input type="email" name="EMAIL" value="<?= $arUser["USERS_EMAIL"] ?: "" ?>" required></label>
            <label>
                <div class="label_for_text">Пароль</div>
                <input type="password" name="PASSWORD" required></label>
            <label>
                <div class="label_for_text">Повтор пароля</div>
                <input type="password" name="CONFIRM_PASSWORD" value=""></label>
            <label>
                <div class="label_for_text">Имя</div>
                <input type="text" name="FIRST_NAME" value="<?= $arUser["USERS_FIRST_NAME"] ?: "" ?>"></label>
            <label>
                <div class="label_for_text">Фамилия</div>
                <input type="text" name="LAST_NAME" value="<?= $arUser["USERS_LAST_NAME"] ?: "" ?>"></label>
            <label>
                <div class="label_for_text">Тема оформления</div>
                <select name="THEME">
                    <?
                    array_unshift($arThemes, array("THEMES_ID" => 0, "THEMES_NAME" => "Выберите тему"));
                    foreach ($arThemes as $arTheme): ?>
                        <option value="<?= $arTheme["THEMES_ID"] ?>" <?= ($arUser["THEMES_ID"] == $arTheme["THEMES_ID"]) ? "selected" : "" ?>><?= $arTheme["THEMES_NAME"] ?></option>
                    <? endforeach; ?>
                </select>
            </label>
            <label><input type="submit" name="SAVE" value="Сохранить"></label>
        </form>
    </div>
<?= $template->htmlFooter(); ?>