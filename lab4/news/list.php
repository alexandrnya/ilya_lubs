<?php
include "Classes/autoload.php";

use DB\News;
use HTML\Template;

$template = new Template(); ?>
<?= $template->htmlHeader("Список новостей"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <? $objNews = new News();
        $arNews = $objNews->getNewsList();
        foreach ($arNews as $news) :?>

        <? endforeach; ?>
    </div>
<?= $template->htmlFooter(); ?>