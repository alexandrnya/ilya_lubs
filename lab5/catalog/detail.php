<?php
include "../Classes/autoload.php";

use DB\Catalog\Product;
use DB\Users;
use Helpers\Helper;
use HTML\Template;

$template = new Template(); ?>
<?$template->addStyle("../lib/lightbox/css/lightbox.min.css");
$template->addScript("../lib/lightbox/js/lightbox-plus-jquery.min.js");?>
<? if ($arProduct = Product::GetPruductByID($_REQUEST["id"])): ?>
    <?= $template->htmlHeader($arProduct["NAME"]); ?>
    <?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <div class="header_product">
            <h1><?= $arProduct["NAME"] ?></h1>
            <img src="<?= Helper::GetImg($arProduct["PICTURE"]) ?>">
            <?= "hello" ?>
        </div>
    </div>
<? else : // todo redirect 404?>
<? endif; ?>
<?= $template->htmlFooter(); ?>