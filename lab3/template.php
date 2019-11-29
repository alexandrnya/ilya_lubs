<?php
date_default_timezone_set('asia/krasnoyarsk');

function htmlInfo()
{
    ?>
    <div id="info">
        <span>Host: <?=gethostname()?></span><br />
        <span>IP: <?=$_SERVER["REMOTE_ADDR"]?></span><br />
        <span>Текущее время: <?=date("H:i:s");?></span>
    </div>
    <?
}

function createMenu()
{
    ?>
    <div id="wide_menu">
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="about.php">О Компании</a>
                <ul class="submenu">
                    <li> <a href="galery.php">Галерея</a></li>
                    <li> <a href="google">второе сабменю</a></li>
                </ul>
            </li>
            <li><a href="help247.php">Удаленная поддержка "24/7"</a></li>
            <li><a href="https://www.google.com" onclick="getAlert()">google.com (Подтверждение)</a></li>
        </ul>
    </div>
    <?
}

    function htmlHeader($title) {
    ?>
    <!--Собсна хедер-->
    <!DOCTYPE HTML>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" id="theme" href="<?=$_COOKIE["theme"]?:"styles/themes/red.css"?>">

        <link rel="stylesheet" href="../lib/lightbox/css/lightbox.min.css">

        <script src="script.js"></script>
        <title><?=$title?></title>
    </head>
    <body>
    <div id="main_container">
        <div id="header">
            <?htmlInfo()?>
            <?createMenu()?>
        </div>
    <?
    }

    function htmlFooter() {
    ?>
        <div style="clear: both"></div>
        <div id="footer">
            +79994564589 2000 - 2019 гг. г. Красноярск, ул. Красноярская 777, оф 666
        </div>
    </div>
    <?htmlPopup()?>

    <script src="../lib/lightbox/js/lightbox-plus-jquery.min.js"></script>

    </body>
    </html>
    <?
    }

function htmlPopup() {
    ?>
    <div id="popup" class="popup" style="display: none">
        <div class="popup-content">
            <span class="closebtn" onclick="closePopup()">&times;</span>
            Введите имя
            <input type="text" name="name" placeholder="Илюша" value="<?=$_COOKIE["name"]?:""?>">
            <button onclick="saveName()">Сохранить</button>
        </div>
    </div>
    <?
}

function htmlLeftBlock() {
    ?>
    <div id="left_block">
        <div id="switch_theme">
            <div id="salute" onclick="createPopup()"><strong>Привет</strong></div>
            <br />
            <br />
            <div onclick="changeTheme()">Переключатель тем</div>
        </div>
        <ul>
            <li>
                <a href="rs.php">Обслуживание рабочих станций</a>
            </li>
            <li>
                <a href="servers.php"  class="hint" data-title="Ненумерованный список">Обслуживание серверов</a>
            </li>
            <li>
                <a href="virus.php" class="hint" data-title="Таблицы">Вирусы: профилактика и лечение</a>
            </li>
            <li>
                <a href="remont.php">Ремонт компьютеров</a>
            </li>
            <li>
                <a href="helpdesk.php" class="hint" data-title="Разные списки и схлапывающиеся блоки">Удаленная техподдержка</a>
            </li>
        </ul>
    </div>
    <?
}
