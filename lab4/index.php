<?php
include "Classes/autoload.php";

use DB\Users;
use HTML\Template;

$template = new Template(); ?>
<?= $template->htmlHeader("Лабараторная №4"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <h2>Самое Главное</h2>
        <p>Наше предприятие работает в сфере услуг АйТи Аутсорсинг <strong>(it outsourcing)</strong> уже более 10 лет.
        </p>
        <p>По простому, АйТи Аутсорсинг <strong>(it outsourcing)</strong> - обслуживание компьютеров привлеченными
            силами, внешними ресурсами.
        </p>
        <p>Решения, которые мы предлагаем проверенны годами их использования.</p>
        <p>Специалисты имеют за плечами огромный опыт работы.</p>
        <p>Мы предоставляем клиентам высочайший уровень сервиса.</p>
        <p>Мы Профессионалы, Инженеры. Мы делаем нашу работу качественно.</p>
        <p>Наше главное отличие от конкурентов - мы постоянно развиваемся. У нас есть опыт обслуживание больших
            предприятий.
        </p>
        <p>Наш опыт позволяет нам предугадывать возможные недостатки и устранять их, до того, как они станут причиной
            остановки бизнес процесса.
        </p>
        <p>Работа на предупреждение - наша главная задача.</p>

        <a href="img/987a63_16f40e9780f049e0a1030468f313981b_mv2.webp"
           data-lightbox="index-set" data-title=""><img
                    src="img/987a63_16f40e9780f049e0a1030468f313981b_mv2.webp"
                    alt=""/></a>
    </div>
<?= $template->htmlFooter(); ?>