<?php

namespace HTML\Catalog\Product;

use DB\Catalog\Product;

class PList
{
    static
    function publicList($idSection)
    {
        $arProducts = \DB\Catalog\Product::GetProductsBySectionID($idSection);?>
        <div class="product_list">
            <?
            foreach($arProducts as $arProduct): ?>
                <div class="section_item">
                    <a href="detail.php?id=<?=$arProduct["ID"]?>"><?=$arProduct["NAME"]?></a>
                </div>
            <? endforeach; ?>
        </div>
        <?
    }
}