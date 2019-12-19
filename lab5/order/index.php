<?php
include "../Classes/autoload.php";

use DB\Catalog\Basket;
use DB\Catalog\Order;
use DB\Catalog\Product;
use DB\Users;
use HTML\Template;

$template = new Template();
$User = new Users();
$arUser = $User->getArCurrentUser(); ?>

<?=$template->htmlHeader("Оформление заказа");?>
<?=$template->htmlLeftBlock();?>

<? if( !$arUser): ?>
    <div id="body">
        Пожалуйста <a href="<?="/".PATH_TO_LAB."/user/login.php"?>">авторизуйтесь</a>
    </div>
<? else : ?>
    <?
    $arBasket = Basket::getBasketItemsByUserID($arUser["USERS_ID"]);
    if(empty($arBasket)): ?>
        <div id="body">
            <?="Ваша корзина пуста"?>
        </div>
    <? else: ?>
        <? if($_REQUEST["APPLY"]) : ?>
            <?
            $arOrder = $_POST;
            if(Order::addOrder($arOrder, $arUser["USERS_ID"])): ?>
            <?Basket::deleteByUserID($arUser["USERS_ID"]);?>
                <div id="body">
                    <?="Заказ успешно оформлен"?>
                </div>
            <?else:?>
                <div id="body">
                    <?="Ошибка оформления заказа"?>
                </div>
            <?endif?>
        <? elseIf($_REQUEST["DEL"]): ?>
            <?Basket::deleteByID($_REQUEST["DEL"]);?>
            <meta http-equiv="refresh" content="0; <?="/" . PATH_TO_LAB . "/order/index.php"?>">
        <? else: ?>
            <div id="body">
                <style>
                    .basket_items td,.basket_items th {
                        border: 1px solid;
                        padding: 10px !important;
                    }
                    .basket_items {
                        width: 100%;                        
                        border-radius: 2px;
                        border-collapse: collapse;
                    }

                    .delete_item {
                        text-decoration: none;
                    }
                    
                    .delete_item::before {
                        content: "X";
                        border: 1px solid;
                        border-radius: 100%;
                        padding: 4px;
                    }
                    .delete_item:hover {
                        color: grey;
                    }
                </style>
                <form method="post">
                    <span>Здравствуйте, <?=(($arUser["USERS_FIRST_NAME"] || $arUser["USERS_LAST_NAME"])
                            ? ($arUser["USERS_FIRST_NAME"]." ".$arUser["USERS_LAST_NAME"])
                            : $arUser["USERS_LOGIN"])?>
                    </span><br><br>
                    <table class="basket_items">
                        <tr>
                            <th colspan="3">Поля заказа</th>
                            <th>Всего:</th>
                            <th></th>
                        </tr>
                        <? foreach($arBasket as $basketItem): ?>
                            <tr>
                                <td><?=$basketItem["NAME"]?></td>
                                <td><input type="text" name="ITEM[<?=$basketItem["ID"]?>][QUANTITY]" size="2" value="<?=(int)$basketItem["QUANTITY"]?>" maxlength="2"> шт.</td>
                                <td><?=(float)$basketItem["PRICE"]?> руб.</td>
                                <td><?=(float)$basketItem["PRICE"] * (float)$basketItem["QUANTITY"]?> руб.</td>
                                <td><a class="delete_item" href="<?="/" . PATH_TO_LAB . "/order/index.php?DEL=" . $basketItem["ID"]?>"></a></td>
                            </tr>
                        <? endForeach; ?>
                    </table>
                    <br>
                    <span>Для того, чтобы купить заполните форму ниже</span>
                    <br><br>
                    <div id="errors">

                    </div>
                    <label>
                        <div class="label_for_text">Email</div>
                        <input type="text" name="EMAIL" required
                               value="<?=$_REQUEST["EMAIL"] ?: ($arUser["USERS_EMAIL"] ?: "")?>">
                    </label>
                    <label>
                        <div class="label_for_text">Номер телефона</div>
                        <input type="text" name="PHONE" required
                               value="<?=$_REQUEST["PHONE"] ?: ($arUser["USERS_PHONE"] ?: "")?>">
                    </label>
                    <label>
                        <div class="label_for_text">Город</div>
                        <input type="text" name="CITY" required
                               value="<?=$_REQUEST["CITY"] ?: ""?>">
                    </label>
                    <label>
                        <input type="submit" name="APPLY" value="Оформить">
                    </label>
                </form>
            </div>
        <? endif; ?>
    <? endif; ?>
<? endif; ?>
<?=$template->htmlFooter();?>