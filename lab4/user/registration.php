<? include "../Classes/autoload.php";

use DB\Users;
use HTML\Template;

$errors = [];
if (!empty($_SESSION["USER_ID"])) {
    header("Location: /" . PATH_TO_LAB . "/user/cabinet.php");
    die;
} else {
    if ($_POST["REGISTER"]) {
        $user = new Users();
        $_SESSION["USER_ID"] = $user->AddUser($_POST);
        $errors = $user->GetMessages();
        if (empty($errors) && !empty($_SESSION["USER_ID"])) {
            header("Location: /" . PATH_TO_LAB . "/user/cabinet.php");
            die;
        }
    }
}

$template = new Template(); ?>
<?= $template->htmlHeader("Регистрация"); ?>
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
    <label><div class="label_for_text">Логин</div>
        <input type="text" name="LOGIN" value="<?= $_POST["LOGIN"] ?: "" ?>" required></label>
    <label><div class="label_for_text">E-Mail</div>
        <input type="email" name="EMAIL" value="<?= $_POST["EMAIL"] ?: "" ?>" required></label>
    <label><div class="label_for_text">Пароль</div>
        <input type="password" name="PASSWORD" value="<?= $_POST["PASSWORD"] ?: "" ?>" required></label>
    <label><div class="label_for_text">Повтор пароля</div>
        <input type="password" name="CONFIRM_PASSWORD" value=""></label>
    <label><div class="label_for_text">Имя</div>
        <input type="text" name="FIRST_NAME" value="<?= $_POST["FIRST_NAME"] ?: "" ?>"></label>
    <label><div class="label_for_text">Фамилия</div>
        <input type="text" name="LAST_NAME" value="<?= $_POST["LAST_NAME"] ?: "" ?>"></label>
    <label><input type="submit" name="REGISTER" value="Создать"></label>
</form>

</div>
<?= $template->htmlFooter(); ?>
