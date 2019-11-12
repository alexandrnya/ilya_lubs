<?php
include "Classes/autoload.php";

use DB\Users;
use HTML\Template;

$template = new Template(); ?>
<?= $template->htmlHeader("Лабараторная №4"); ?>
<?= $template->htmlLeftBlock(); ?>
    <div id="body">
        <?="hello"?>
    </div>
<?= $template->htmlFooter(); ?>