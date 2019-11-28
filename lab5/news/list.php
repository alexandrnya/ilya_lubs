<?php
include "../Classes/autoload.php";

use DB\News;
use DB\Users;
use HTML\Template;

$objNews = new News();

if(!empty($_REQUEST["DELETE"])) {
    foreach($_REQUEST["DELETE"] as $key => $value) {
        $objNews->deleteNews($key);
    }
}
/*if($_REQUEST["action"] === "delete" && $ID = (int)$_REQUEST["id"]) {
    $objNews->deleteNews($ID);
}*/

$template = new Template(); ?>
<?=$template->htmlHeader("Список новостей");?>
<?=$template->htmlLeftBlock();?>
    <div id="body">

        <? $arNews = $objNews->getNewsList(); ?>
        <form method="post">
            <? foreach($arNews as $news) : ?>
                <div class="news_item">
                    <a href="detail.php?ID=<?=$news["NEWS_ID"]?>">
                        <h1><?=$news["NEWS_NAME"]?></h1>
                        <div class="wrapper">
                            <div class="img_block">
                                <img src="<?=$news["NEWS_VIEW_PICTURE"]?>" width="300px" alt=""></div>
                            <div class="text"><?=$news["NEWS_VIEW_TEXT"]?></div>
                            <div style="clear: both;"></div>
                        </div>
                    </a>
                    <div class="sign">
                        <? if($news["USERS_ID"] == Users::getCurrentUser()): ?>
                            <div class="delete">
                                <input type="submit" name="DELETE[<?=$news["NEWS_ID"]?>]" style="float: left; margin-top: 7px;" value="Удалить новость">
                                <!--<a href="list.php?action=delete&id=<?=$news["NEWS_ID"]?>" style="float: left;"></a>-->
                            </div>
                        <? endif; ?>
                        <div class="autor"><?=$news["USERS_LOGIN"]?></div>
                        <div class="createt_at"><?=$news["NEWS_CREATED_AT"]?></div>
                    </div>
                </div>
            <? endforeach; ?>
        </form>
    </div>
<?=$template->htmlFooter();?>