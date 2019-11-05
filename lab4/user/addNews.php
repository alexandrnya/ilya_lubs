<?php
include "../Classes/autoload.php";

use DB\News;
use DB\Users;
use HTML\Template;

if(!Users::checkLogin()) {
    header("Location: /" . PATH_TO_LAB . "/user/login.php");
    die;
}

if($_POST["ADD_NEWS"]) {
    $uploaddir = "/" . PATH_TO_LAB . '/uploads/news/view/';
    $uploadfile = $uploaddir . basename($_FILES['VIEW_PICTURE']['name']);

    if (move_uploaded_file($_FILES['VIEW_PICTURE']['tmp_name'], $uploadfile)) {

    }
    $newsObj = new News();
    $newsObj->addNews($_POST);
}

$template = new Template(); ?>
<?= $template->htmlHeader("Добавить новость"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <form enctype="multipart/form-data" method="post"></form>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <div id="editor_view_news_block">
            <h2>View блок</h2>
            <label><div class="label_for_text">Название новости</div>
                <input type="text" name="NAME" value="<?= $_POST["NAME"] ?: "" ?>" required></label>
            <label><div class="label_for_text">Описание для анонса</div>
                <textarea name="VIEW"><?= $_POST["VIEW"] ?: "" ?></textarea></label>
            <label><div class="label_for_text">Картинка для анонса</div>
                <input name="VIEW_PICTURE" type="file">
            </label>
        </div>
        <div id="editor_detail_news_block">
            <h2>Detail блок</h2>
            <label><div class="label_for_text">Детальное описание</div>
                <textarea name="VIEW"><?= $_POST["VIEW"] ?: "" ?></textarea></label>
            <label><div class="label_for_text">Детальная картинка</div>
                <input name="DETAIL_PICTURE" type="file">
            </label>
        </div>
        <label><input type="submit" name="ADD_NEWS" value="Добавить новость"></label>
    </div>
<?= $template->htmlFooter(); ?>