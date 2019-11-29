<?php

namespace HTML\Catalog\Product;

use DB\Catalog\Product;

class PList
{
    static
    function publicList(int $idSection)
    {
        $arSections = \DB\Catalog\Product::GetProducts($idSection);?>
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