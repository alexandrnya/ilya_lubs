<?php

include "Classes/autoload.php";

use HTML\Template;

$template = new Template(); ?>
<?= $template->htmlHeader("Галерея"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <h1>Набор из четырех изображений</h1>
        <div>
            <a class="gallery-item" href="http://lokeshdhakar.com/projects/lightbox2/images/image-3.jpg"
               data-lightbox="gallery-set" data-title=""><img
                        src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-3.jpg" alt=""/>
            </a>
            <a class="gallery-item" href="http://lokeshdhakar.com/projects/lightbox2/images/image-4.jpg"
               data-lightbox="gallery-set" data-title=""><img
                        src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-4.jpg" alt=""/>
            </a>
            <a class="gallery-item" href="http://lokeshdhakar.com/projects/lightbox2/images/image-5.jpg"
               data-lightbox="gallery-set" data-title=""><img
                        src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-5.jpg" alt=""/>
            </a>
            <a class="gallery-item" href="http://lokeshdhakar.com/projects/lightbox2/images/image-6.jpg"
               data-lightbox="gallery-set" data-title=""><img
                        src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-6.jpg" alt=""/>
            </a>
        </div>
    </div>
<?= $template->htmlFooter(); ?>