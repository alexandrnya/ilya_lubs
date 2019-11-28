<?php


namespace HTML\Catalog\Section;


class PList
{
    static
    function publicList(int $idParent)
    {
        $arSections = \DB\Catalog\Section::GetChildSections($idParent);?>
        <div class="section_list">
            <?
            foreach($arSections as $arSection): ?>
                <div class="section_item">
                    <a href="<?=$_SERVER["SCRIPT_NAME"]?>?id=<?=$arSection["ID"]?>"><?=$arSection["NAME"]?></a>
                </div>
            <? endforeach; ?>
        </div>
        <?
    }
}