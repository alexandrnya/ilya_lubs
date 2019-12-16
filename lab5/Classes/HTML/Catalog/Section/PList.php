<?php


namespace HTML\Catalog\Section;


use DB\Catalog\Section;
use Helpers\Helper;

class PList
{
    static function publicList($idParent)
    {
        $arSections = Section::GetChildSections($idParent);?>
        <div class="section_list">
            <?
            foreach($arSections as $arSection): ?>
                <a class="section_item" href="<?=$_SERVER["SCRIPT_NAME"]?>?SECTION_ID=<?=$arSection["ID"]?>">
                    <img class="img_section_list" src="<?=Helper::GetImg($arSection["PICTURE"])?>" alt="<?=$arSection["NAME"]?>">
                    <span class="section_name"><?=$arSection["NAME"]?></span>
                </a>
            <? endforeach; ?>
        </div>
        <?
    }
}