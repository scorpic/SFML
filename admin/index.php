<?php

define('CMS', true);
define('PA', '../admin/');
require PA . 'engine/classes/mainclass.php';
require PA . '../engine/other/count.class.php';
$other->count = new Count;
$mainclass->isAdmin();
$mainclass->setSettings();
$array_tablets = array(
    'Добавить тест' => array(
        'link' => 'test.php?sec=add',
        'color_tablet' => '0'
    ),
    'Изменить тест' => array(
        'link' => 'test.php?sec=edit',
        'color_tablet' => '1'
    ),
    'Предметы и разделы' => array(
        'link' => 'subject.php',
        'color_tablet' => '2',
        'priv' => '1'
    ),
    'Восстановить тест' => array(
        'link' => 'test.php?sec=delete',
        'color_tablet' => '2',
        'priv' => '1'
    ),
    'Список админов' => array(
        'link' => 'user.php',
        'color_tablet' => '0',
        'priv' => '1'
    ),
    'Ответы к тестам' => array(
        'link' => 'answer.php',
        'color_tablet' => '3',
        'priv' => '1'
    ),
    'Статистика сайта' => array(
        'link' => 'stat.php',
        'color_tablet' => '1'
    )
);
foreach ($array_tablets as $k => $v) {
    if (isset($v['priv'])) {
        if ($mainclass->user['priv'] == $v['priv'])
            $tablets.=$mainclass->Tablets($k, $v['link'], $v['color_tablet']);
    }
    else
        $tablets.=$mainclass->Tablets($k, $v['link'], $v['color_tablet']);
}
if ($mainclass->user['priv'] == '1') {
    $testMode = '<div class="settings_table"><div class="title">Test mode:</div><div class="text">' . $mainclass->SetTestMode() . '</div></div>';
}
$tmp->setVar('id', $mainclass->user['id']);
$tmp->setVar('HelloUser', $mainclass->HelloUser($mainclass->user['name']));
$tmp->setVar('Tablets', $tablets);
$tmp->setVar('TestMode', $testMode);
$tmp->setVar('CountTest', $other->count->countTestWrite());
$tmp->setVar('CountAdmin', $other->count->countAdmin());
$tmp->setVar('title', 'Админ-панель');
$tmp->setCSS(array('main'));
$tmp->parse('main');
?>
