<?php
include "../Classes/autoload.php";

use DB\Catalog\Product;
use DB\Users;
use Helpers\Helper;
use HTML\Template;

$template = new Template(); ?>
<? $template->addStyle("../lib/lightbox/css/lightbox.min.css");
$template->addScript("../lib/lightbox/js/lightbox-plus-jquery.min.js"); ?>
<? if($arProduct = Product::GetPruductByID($_REQUEST["id"])): ?>
<?$arProductProperty = Product::GetProperties($_REQUEST["id"])?>
    <?=$template->htmlHeader($arProduct["NAME"]);?>
    <?=$template->htmlLeftBlock();?>
    <div id="body">
        <style>
            .property_block table tr td,
            .property_block table tr th {
                border: 1px solid;
                padding: 8px !important;
            }
            
            .property_block table {
                width: 100%;
                border-radius: 2px;
                border-collapse: collapse;
            }
        </style>
        <div class="header_product">
            <h1><?=$arProduct["NAME"]?></h1>
            <a class="img_product_detail" href="<?=Helper::GetImg($arProduct["PICTURE"])?>"
               data-lightbox="gallery-set" data-title="<?=$arProduct['NAME']?>"><img
                        src="<?=Helper::GetImg($arProduct["PICTURE"])?>" alt="<?=$arProduct['NAME']?>"/>
            </a>
            <div class="sale_block">
                <div class="price_block">
                    <span><?=(float)$arProduct["PRICE"]?> руб.</span>
                </div>
                <div class="buy_btn" onclick='addIntoBasket({
                        PRODUCT_ID: <?=$arProduct["ID"]?>,
                        USER_ID: <?=Users::getCurrentUserID()?>,
                        QUANTITY: 1,
                        })'>
                    Купить
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="property_block">
                <table>
                    <tr>
                        <th colspan="2"><h3>Свойства</h3></th>
                    </tr>
                    <? foreach($arProductProperty as $prop): ?>
                        <tr>
                            <td>
                                <?=$prop["NAME"]?>
                            </td>
                            <td>
                                <?=$prop["PROPERTY_VALUES"]?>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        function reloadCounterBasket(eres) {
            var basket = document.querySelector(".basket");
            var basketCount = basket.querySelector(".basket_count");
            basketCount.innerHTML = eres;
        }

        async function addIntoBasket(item) {
            $.ajax({
                type: "POST",
                data: item,
                url: "/lab5/ajax/basket.php",
                async: false,
                success: function (res) {
                    eres = JSON.parse(res);
                    reloadCounterBasket(eres);
                }
            });
        }
    </script>
<? else : // todo redirect 404?>
<? endif; ?>
<?=$template->htmlFooter();?>