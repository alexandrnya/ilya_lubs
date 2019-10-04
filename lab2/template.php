<?php
function createMenu()
{
    ?>
    <div id="wide_menu">
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="about.php">О Компании</a></li>
            <li><a href="help247.php">Удаленная поддержка "24/7"</a></li>
            <li><a href="frameset/index.html">frameset</a></li>
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
        <script src="script.js"></script>
        <title><?=$title?></title>
    </head>
    <body>
    <div id="main_container">
        <div id="header">
            <?createMenu()?>
        </div>
    <?
    }

    function htmlFooter() {
    ?>
        <div style="clear: both"></div>
        <div id="footer">
            Тут будет футер для всех страниц
        </div>
    </div>
    </body>
    </html>
    <?
    }

function htmlLeftBlock() {
    ?>
    <div id="left_block">
        <div id="switch_theme" onclick="changeTheme()"><div>Переключатель тем</div></div>
        <ul>
            <li>
                <a href="rs.php">Обслуживание рабочих станций</a>
            </li>
            <li>
                <a href="servers.php">Обслуживание серверов (Ненумерованный список)</a>
            </li>
            <li>
                <a href="virus.php">Вирусы: профилактика и лечение (Таблицы)</a>
            </li>
            <li>
                <a href="remont.php">Ремонт компьютеров</a>
            </li>
            <li>
                <a href="helpdesk.php">Удаленная техподдержка (Разные списки)</a>
            </li>
        </ul>
    </div>
    <?
}
