<?php
include "../Classes/autoload.php";

use DB\Comments;
use DB\News;
use DB\Users;
use HTML\Template;

$ID = (int)$_REQUEST["ID"];
$objNews = new News();
$objComments = new Comments();
if( !($ID && $arNews = $objNews->getNewsDetailByID($ID))) {
    // todo 404 error
    die;
}

if($_REQUEST["ADD_COMMENT"]) {
    $objComments->addComment(array("COMMENT" => $_REQUEST["COMMENT"], "NEWS_ID" => $ID));
}
else if( !empty($_REQUEST["DELETE_COMMENT"])) {
    foreach($_REQUEST["DELETE_COMMENT"] as $key => $value) {
        $res = $objComments->deleteComment($key);
    }
}

$arComments = $objComments->getCommentsByNews($ID);

$template = new Template(); ?>
<?=$template->htmlHeader($arNews["NEWS_NAME"]);?>
<?=$template->htmlLeftBlock();?>
    <div id="body">
        <div class="news_item">
            <h1><?=$arNews["NEWS_NAME"]?></h1>
            <div class="wrapper">
                <div class="img_block">
                    <img src="<?=$arNews["NEWS_DETAIL_PICTURE"]?>" width="100%"></div>
                <div class="text"><?=$arNews["NEWS_DETAIL_TEXT"]?></div>
                <div style="clear: both;"></div>
            </div>
            <div class="sign">
                <? if($arNews["USERS_ID"] == Users::getCurrentUser()): ?>
                    <div class="delete">
                        <a href="list.php?action=delete&id=<?=$arNews["NEWS_ID"]?>" style="float: left;">Удалить
                            новость</a>
                    </div>
                <? endif; ?>
                <div class="autor"><?=$arNews["USERS_LOGIN"]?></div>
                <div class="createt_at"><?=$arNews["NEWS_CREATED_AT"]?></div>
            </div>

            <form method="post">
                <div class="cpmment_add">
                    <label>
                        <textarea name="COMMENT" style="min-height: 100px"></textarea>
                    </label>
                    <input type="submit" name="ADD_COMMENT" value="Добавить коментарий">
                </div>
                <table class="comments_table">
                    <? foreach($arComments as $comment) : ?>
                        <tr class="comment_body">
                            <td class="comment_user">
                                <div class="autor"><?=$comment["USERS_LOGIN"]?></div>
                                <div class="createt_at"><?=$comment["COMMENTS_CREATED_AT"]?></div>
                            </td>
                            <td class="comment_text"><?=$comment["COMMENTS_COMMENT"]?></td>
                        </tr>
                        <? if($comment["USERS_ID"] == Users::getCurrentUser()) : ?>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="DELETE_COMMENT[<?=$comment["COMMENTS_ID"]?>]"
                                           value="Удалить ваш комментарий">
                                </td>
                            </tr>
                        <? endif; ?>
                    <? endforeach; ?>
                </table>
            </form>

        </div>
    </div>
<?=$template->htmlFooter();?>