<?php
include "../Classes/autoload.php";

use DB\News;
use DB\Users;
use HTML\Template;
use Helpers\Helper;

if(!Users::checkLogin()) {
    header("Location: /" . PATH_TO_LAB . "/user/login.php");
    die;
}

if($_POST["ADD_NEWS"]) {
    $uploaddir = $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_TO_LAB . '/uploads/news/';
    $uploadView =  $_FILES['DETAIL_PICTURE']['name'] ? ($uploaddir . "view/". Helper::translit(basename($_FILES['VIEW_PICTURE']['name']))) : "";
    $uploadDetail =  $_FILES['DETAIL_PICTURE']['name'] ? ($uploaddir . "detail/". Helper::translit(basename($_FILES['DETAIL_PICTURE']['name']))) : "";
    $uploated = true;

    if($_FILES['VIEW_PICTURE']['tmp_name'] || $_FILES['DETAIL_PICTURE']['tmp_name']) {
        move_uploaded_file($_FILES['VIEW_PICTURE']['tmp_name'], $uploadView);
        move_uploaded_file($_FILES['DETAIL_PICTURE']['tmp_name'], $uploadDetail);
    }
    $newsObj = new News();

    $arNews = array(
        "NAME" => $_POST["NAME"],
        "VIEW_TEXT" => $_POST["VIEW_TEXT"],
        "VIEW_PICTURE" => str_replace($_SERVER["DOCUMENT_ROOT"],  "", $uploadView),
        "DETAIL_TEXT" => $_POST["DETAIL_TEXT"],
        "DETAIL_PICTURE" => str_replace($_SERVER["DOCUMENT_ROOT"],  "", $uploadDetail),
    );
    $newsObj->addNews($arNews);
}

$template = new Template(); ?>
<?= $template->htmlHeader("Добавить новость"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <form enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
        <div id="editor_view_news_block">
            <h2>View блок</h2>
            <label><div class="label_for_text">Название новости</div>
                <input type="text" name="NAME" value="<?= $_POST["NAME"] ?: "" ?>" required></label>
            <label><div class="label_for_text">Описание для анонса</div>
                <textarea name="VIEW_TEXT"><?= $_POST["VIEW_TEXT"] ?: "" ?></textarea></label>
            <label><div class="label_for_text">Картинка для анонса</div>
                <input name="VIEW_PICTURE" type="file">
            </label>
        </div>
        <div id="editor_detail_news_block">
            <h2>Detail блок</h2>
            <label><div class="label_for_text">Детальное описание</div>
                <textarea name="DETAIL_TEXT"><?= $_POST["DETAIL_TEXT"] ?: "" ?></textarea></label>
            <label><div class="label_for_text">Детальная картинка</div>
                <input name="DETAIL_PICTURE" type="file">
            </label>
        </div>
        <label><input type="submit" name="ADD_NEWS" value="Добавить новость"></label>
        </form>
    </div>
<?= $template->htmlFooter(); ?>