<?php
define('CMS', true);
define('PATH', '../admin/');
require PATH.'engine/classes/mainclass.php';
$mainclass->isAdmin();
$mainclass->AssetsUser(array('1'));

$array_section = array(
    'main' => 'index',
);
$mainclass->LoadCategory('subject'); 
$mainclass->LoadMessage();
$tmp->setCSS(array('main'));
$tmp->Parse('subject/'.$mainclass->tmpName);

require A.'engine/classes/subject.class.php';
if (isset($_GET['m'])) {
    require A.'engine/classes/message.class.php';
    $content=$m->GetError($_GET['m']);
}
if(isset($_GET['act'])) {
    switch ($_GET['act']) {
    case 'add_cat':
        $title='Добавление категорий';
        $content.=$s->AddCat();
        break;
    case 'edit_cat':
        $title='Добавление категорий';
        $content.=$s->EditCat($_GET['id']);
        break;
    }
}
else {
    switch ($_GET['cat']) {
    case 'sub':
        $title='Cписок категорий';
        $s->ListCategory($_GET['id']);
        break;

    case 'add_cat':
        $title='Добавление категорий';
        $content.=$s->AddCategory(null);
        break;
    case 'edit_cat':
        $title='Добавление категорий';
        $content.=$s->AddCategory($_GET['id']);
        break;
    default:
        $title='Список предметов';
        $s->ListSubject();
        break;
    }
}
if (isset($s->arrayText['menu'])) {
    $menu = '<tr>';
    foreach ($s->arrayText['menu'] as $k => $v) {
        $menu .= '<span style="color: #323232; font-size: 14px; margin-left: 10px"><a href="'.$v.'" style="color: #69C">'.$k.'</a></span>';
    }
    $menu .= '</tr>';
}
$content.='<div class="headi" style="margin: 10px 10px 0 10px; height: 10px;">'.$s->arrayText['title'].'</div>
   <table width="100%" border="0">
     '.$menu.'
     '.$s->arrayText['content'].'
   </table>';

$tmp->setCSS(array('main','li'));
$tmp->setVar('content',$content);
$tmp->setVar('title',$title);
$tmp->Parse('test');
?>