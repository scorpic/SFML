<?php
require 'header.php';
if(isset($_GET['act']) && $_GET['act']=='test') {
    require './classes/check_test.php';
    exit($c->TestId($_POST['id']));
}
else if(isset($_GET['act']) && $_GET['act']=='count_pass') {
    require './classes/check_test.php';
    exit($c->CountPlus());
}
require './classes/test.php';
$t->Go();
$tmp->setJS(array('jquery','test','lang'));
$tmp->setCSS(array('test'));
$tmp->setVar('title',$t->title);
$tmp->setVar('JS_test',$t->generateJSTest($t->js));
$tmp->setVar('subject',$t->arr['sub_title']);
$tmp->setVar('theme',$t->arr['title']);
$tmp->setVar('count_test',$t->arr['count_pass']);
$tmp->setVar('user',$t->author);
$tmp->setVar('scale',$t->Scale($t->arr['count']));
$tmp->parse('test');
?>
