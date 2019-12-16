<?php


namespace HTML;

use DB\Catalog\Basket;
use DB\Catalog\Filter;
use DB\Catalog\Section;
use DB\Themes;
use DB\Users;

class Template
{
    // Ссылки относитльно корня.
    private $styles = [];
    private $scripts = [];
    
    private $htmlCatalogFilter = "";

    function __construct()
    {
        $objUser = new Users();
        $theme = $objUser->getTheme();

        $this->styles = array(
            array(
                "id" => "theme",
                "href" => $theme["THEMES_PATH"],
            ),
            array("href" => "styles/styles.css"),
            //array("href" => "../lib/lightbox/css/lightbox.min.css"),
            );

        $this->scripts = array(
            array("src" => "script.js"),
//        array("src" => "../lib/lightbox/js/lightbox-plus-jquery.min.js"),
        );
    }

    function styleLinks()
    {
        $html = "";
        foreach ($this->styles as $style) {
            $html .= "<link rel='stylesheet' id='" . $style["id"] . "' href='/" . PATH_TO_LAB . "/" . $style["href"] . "'>";
        }
        return $html;
    }

    function JSLinks()
    {
        $html = "";
        foreach ($this->scripts as $script) {
            $html .= "<script src='/" . PATH_TO_LAB . "/" . $script["src"] . "'></script>";
        }
        return $html;
    }


    function htmlInfo()
    {
        $html = "
        <div id='info'>
            <span>Host: " . gethostname() . "</span><br/>
            <span>IP: $_SERVER[REMOTE_ADDR] </span><br/>
            <span>Текущее время: " . date('H:i:s') . "</span>
        </div>";
        return $html;
    }

    function createMenu()
    {
        $html = "
        <div id='wide_menu'>
            <ul>
                <li><a href='/" . PATH_TO_LAB . "/index.php'>Главная</a></li>
                <li><a href='/" . PATH_TO_LAB . "/catalog/list.php'>Каталог</a>";
        $html .= $this->htmlCatalogMenu();
        $html .="</li>
                <li><a href='/" . PATH_TO_LAB . "/about.php'>О Компании</a>
                    <ul class='submenu'>
                        <li><a href='/" . PATH_TO_LAB . "/galery.php'>Галерея</a></li>
                        <li><a href='/" . PATH_TO_LAB . "/news/list.php'>Новости</a></li>
                    </ul>
                </li>
                <li><a href='/" . PATH_TO_LAB . "/help247.php'>Удаленная поддержка '24/7'</a></li>
                <li><a href='/" . PATH_TO_LAB . "/user/login.php'>Личный кабинет</a>
                    <ul class='submenu'>"
                .(
                        $_SESSION["USER_ID"]?
                            "<li><a href='/" . PATH_TO_LAB . "/user/logout.php'>Выйти</a></li>":
                            "<li><a href='/" . PATH_TO_LAB . "/user/registration.php'>Регистрация</a></li>"
                ) ."</ul>
                </li>
                <li> ". $this->htmlBasket() . "</li>
            </ul>
        </div>";
        return $html;
    }
    
    function htmlChildCatalogMenu($idParent, $arSections) {
        $html = "";
        if($arSections[$idParent]) {
            $html .= "<ul class='submenu2'>";
            foreach($arSections as $section) {
                if($section["PARENT_ID"] === $idParent) {
                    $html .= "<li><a href='/".PATH_TO_LAB."/catalog/list.php?id=$section[ID]'>$section[NAME]</a>";
                    $html .= $this->htmlChildCatalogMenu($section["ID"], $arSections);
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }

    function htmlCatalogMenu()
    {
        $html = "";
        $arSections = Section::getAllSection();
        if( !empty($arSections)) {
            /*$html .="<style>
                .submenu ul li .submenu2 {
                    visibility: hidden;
                    opacity: 0;
                    position: absolute;
                    left: 1px;
                    z-index: 2;
                    border: none;
                    width: 200px;
                }
                
                .submenu ul li:hover .submenu2 {
                    visibility: visible;
                    opacity: 1;
                }
                </style>";*/
            $html .= "<ul class='submenu'>";
            foreach($arSections as $section) {
                if($section["PARENT_ID"] === null) {
                    $html .= "<li><a href='/".PATH_TO_LAB."/catalog/list.php?SECTION_ID=$section[ID]'>$section[NAME]</a>";
                    // Хотел сделать неограниченное вложенное меню из разделов. Передумал:)
                    //$html .= $this->htmlChildCatalogMenu($section["ID"], $arSections);
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }

    function htmlHeader($title)
    {
//        Собсна хедер
        $html = "
        <!DOCTYPE HTML>
        <html lang='ru'>
        <head>
            <meta charset='UTF-8'>";

        $html .= $this->styleLinks();

        $html .= "
            <title>$title</title>
        </head>
        <body>
        <div id='main_container'>
        <div id='header'>";

        $html .= $this->htmlInfo();

        $html .= $this->createMenu();

        $html .= "</div>";
        return $html;
    }
    
    function htmlBasket() {
        if($idUser = Users::getCurrentUserID()) {
            $quantity = Basket::getCount($idUser);
        } else {
            $quantity = 0;
        }
            $html = "<a class='basket' href='/".PATH_TO_LAB."/order/index.php'>Корзина (<span class='basket_count'>$quantity</span>)</a>";
        return $html;
    }

    function htmlFooter()
    {
        $html = "
        <div style='clear: both'></div>
        <div id='footer'>
            +79994564589 2000 - 2019 гг. г. Красноярск, ул. Красноярская 777, оф 666
        </div>
        </div>";
        $html .= $this->htmlPopup();
        $html .= $this->JSLinks();
        $html .= "
        </body>
        </html>
        ";
        return $html;
    }

    function htmlPopup()
    {
        $html = "
        <div id='popup' class='popup' style='display: none'>
            <div class='popup-content'>
                <span class='closebtn' onclick='closePopup()'>&times;</span>
                Введите имя
                <input type='text' name='name' placeholder='Илюша' value='" . ($_COOKIE['name'] ?: "") . "'>
                <button onclick='saveName()'>Сохранить</button>
            </div>
        </div>";
        return $html;
    }

    function htmlLeftBlock()
    {
        $html = "
        <div id='left_block'>
            <div id='switch_theme'>
                <!--<div id='salute' onclick='createPopup()'><strong>Привет</strong></div>
                <br/>
                <br/>
                <div onclick='changeTheme()'>Переключатель тем</div>-->
            </div>
            <ul>
                <li>
                    <a href='/" . PATH_TO_LAB . "/rs.php'>Обслуживание рабочих станций</a>
                </li>
                <li>
                    <a href='/" . PATH_TO_LAB . "/servers.php' class='hint' data-title='Ненумерованный список'>Обслуживание серверов</a>
                </li>
                <li>
                    <a href='/" . PATH_TO_LAB . "/virus.php' class='hint' data-title='Таблицы'>Вирусы: профилактика и лечение</a>
                </li>
                <li>
                    <a href='/" . PATH_TO_LAB . "/remont.php'>Ремонт компьютеров</a>
                </li>
                <li>
                    <a href='/" . PATH_TO_LAB . "/helpdesk.php' class='hint' data-title='Разные списки и схлапывающиеся блоки'>Удаленная
                        техподдержка</a>
                </li>
            </ul>";
        $html .= $this->htmlCatalogFilter;
        $html .= "</div>";
        return $html;
    }
    function addScript($path) {
        if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/".PATH_TO_LAB. "/" . $path)) {
            $this->scripts[] = array("src" => $path);
        }
    }

    function addStyle($path) {
        if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/".PATH_TO_LAB. "/" . $path)) {
            $this->styles[] = array("href" => $path);
        }
    }
    
    function addHTMLCatalogFilter($idSection, array $arFilterValues = []) {
        $html = "";
        $arFilter = Filter::getFilter($idSection);
        if(!empty($arFilter)) {
            $html .= "<div class='filter'>";
            $html .= "<span class='filter_header'>Фильтр</span>";
            $html .= "<form method='GET'>";
            foreach($arFilter as $filter) {
                $html .= "<label><div class='label_for_text'>$filter[NAME]</div>";
                $html .= "<select name='FILTER[$filter[ID]]'>";
                $html .= "<option value=''>Выберите свойство</option>";
                foreach($filter["VALUES"] as $value) {
                    $html .= "<option value='$value[ID]'".(in_array($value["ID"], $arFilterValues) ? " selected" : "").">$value[VALUE]</option>";
                }
                $html .= "</select>";
                $html .= "</label>";
            }
            $html .= "<input type='hidden' name='SECTION_ID' value='$idSection'>";
            $html .= "<label>
                        <input type='submit' name='APPLY_FILTER' value='Найти'>
                    </label>";
            $html .= "</form>";
            $html .= "</div>";
        }
        $this->htmlCatalogFilter = $html;
    }
}