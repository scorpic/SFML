<?php
require 'header.php';
require 'classes/subject.class.php';
switch ($_GET['sec']) {
    case 'subject':
        $c=$s->SubjectId($_GET['id']);
        $subject['title']='<li><a href="./">Список предметов</a> <span class="divider">/</span>
  </li><li class="active">'.$c['title'].'</li>';
        $title='Все тесты по предмету '.$c['title'];
        $c=$c['text'];
        break;
    case 'list':
        $subject['title']='<li class="active">Последние 50</li>';
        $title='Последние 50';
        $c=$s->SubjectList();
        break;
    default:
        break;
}
    /* Посчитаем все тесты */
    $count_tests=$db->query('SELECT id,subject FROM nametest WHERE `status`=2 AND `delete` != "2" ORDER BY subject');
    $arr_count=array();
    while($count_t=$db->fetch_array($count_tests)) {
            $arr_count[$count_t['subject']]['count']++;
    }
    /* Выбираем все предметы и подсталяем значение */
    $query=$db->query('SELECT id,title FROM subject ORDER BY title');
    while($sub=$db->fetch_array($query)) {
        $e.='<li class="header"><a href="subject.php?sec=subject&id='.$sub['id'].'"><h3>'.$sub['title'].' ('.(isset($arr_count[$sub['id']]['count']) ? $arr_count[$sub['id']]['count'] : '0').')</h3></a></li>';
    }
$tmp->setVar('title',$title);
$tmp->setVar('content',$c);
$tmp->setVar('ListSubject',$e);
$tmp->setVar('subject',$subject['title']);
$tmp->parse('subject');
?>