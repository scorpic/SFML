<?php
require 'header.php';
switch ($_GET['sec']) {
    case 'copyright':
        $tmp->setVar('title','Правила перепечатки');
        $tmp->parse('copyright');
        break;
    case 'addtest':
        $tmp->setVar('title','Советы по добавлению теста на сайт');
        $tmp->parse('help_addtest');
        break;
    default:
        break;
}

?>
