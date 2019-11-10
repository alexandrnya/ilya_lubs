<?php
include "../Classes/autoload.php";

use DB\News;
use DB\Users;
use HTML\Template;

$ID = (int)$_REQUEST["ID"];
$objNews = new News();
if (!($ID && $arNews = $objNews->getNewsDetailByID($ID))) {
    // todo 404 error
}

$template = new Template(); ?>
<?= $template->htmlHeader($arNews["NEWS_NAME"]); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <div class="news_item">
            <h1><?= $arNews["NEWS_NAME"] ?></h1>
            <div class="wrapper">
                <div class="img_block">
                    <img src="<?= $arNews["NEWS_DETAIL_PICTURE"] ?>" width="100%"></div>
                <div class="text"><?= $arNews["NEWS_DETAIL_TEXT"] ?></div>
                <div style="clear: both;"></div>
            </div>
            <div class="sign">
                <? if ($arNews["USERS_ID"] == Users::getCurrentUser()): ?>
                    <div class="delete">
                        <a href="list.php?action=delete&id=<?=$arNews["NEWS_ID"]?>" style="float: left;">Удалить новость</a>
                    </div>
                <? endif; ?>
                <div class="autor"><?= $arNews["USERS_LOGIN"] ?></div>
                <div class="createt_at"><?= $arNews["NEWS_CREATED_AT"] ?></div>
            </div>
        </div>
    </div>
<?= $template->htmlFooter(); ?>