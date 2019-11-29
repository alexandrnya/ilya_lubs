<?php
include "../Classes/autoload.php";

use DB\Catalog\Section;
use HTML\Catalog\Section\PList as SectionCList;
use HTML\Catalog\Product\PList as ProductCList;
use HTML\Template;
use DB\Catalog\Product;

$template = new Template();

$idSection = (int)$_REQUEST["id"];
if($idSection > 0) {
    $arSection = Section::GetCurrentSection($idSection);
}
?>
<?=$template->htmlHeader($arSection["NAME"] ?: "Каталог");?>
<?=$template->htmlLeftBlock();?>
    <div id="body">
        <? SectionCList::publicList($idSection) ?>
        <? if($arSection): ?>
            <? ProductCList::publicList($idSection) ?>
        <? endif; ?>
    </div>
<?=$template->htmlFooter();?>