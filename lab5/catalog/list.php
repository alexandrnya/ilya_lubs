<?php
include "../Classes/autoload.php";

use DB\Catalog\Section;
use HTML\Catalog\Section\PList as SectionCList;
use HTML\Catalog\Product\PList as ProductCList;
use HTML\Template;
use DB\Catalog\Product;

$template = new Template();
$template->addStyle("../lib/lightbox/css/lightbox.min.css");
$template->addScript("../lib/lightbox/js/lightbox-plus-jquery.min.js");

$idSection = $_REQUEST["SECTION_ID"];
$arFilter = $_REQUEST["FILTER"] ?: [];
if ($idSection > 0) {
    $arSection = Section::GetCurrentSection($idSection);
}
?>
<?= $template->htmlHeader($arSection["NAME"] ?: "Каталог"); ?>
<? $template->addHTMLCatalogFilter($idSection, $arFilter); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <? SectionCList::publicList($idSection) ?>
        <? ProductCList::publicList($idSection, $arFilter) ?>
    </div>
<?= $template->htmlFooter(); ?>