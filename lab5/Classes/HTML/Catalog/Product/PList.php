<?php

namespace HTML\Catalog\Product;

use DB\Catalog\Product;
use Helpers\Helper;

class PList
{
    static function publicList($idSection, $arFilter)
    {
        $arProducts = Product::GetProductsByFilter($idSection, $arFilter); ?>
        <div class="product_list">
            <? if(empty($arProducts)): ?>
                Не найдено ни одного товара
            <? else: ?>
                <? foreach($arProducts as $arProduct): ?>
                    <div class="product_item">
                        <a class="img_product_list" href="<?=Helper::GetImg($arProduct["PICTURE"])?>"
                           data-lightbox="gallery-set" data-title="<?=$arProduct['NAME']?>"><img
                                    src="<?=Helper::GetImg($arProduct["PICTURE"])?>" alt="<?=$arProduct['NAME']?>"/>
                        </a>
                        <a class="product_href" href="detail.php?id=<?=$arProduct["ID"]?>">
                            <?=$arProduct["NAME"]?>
                        </a>
                    </div>
                <? endforeach; ?>
            <?endif; ?>
        </div>
        <?
    }
}