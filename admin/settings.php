<?php
define('CMS', true);
define('PA', '../admin/');
require PA.'engine/classes/mainclass.php';
$other->count=new Count;
$mainclass->isAdmin();
$mainclass->setSettings();
$tablets = 'Для продолжения работы в админ-панели вам требуется ввести свой e-mail адрес.</br> Он потребуется нам для рассылки информации, а также для связи с Вами.';
if ($mainclass->user['priv']== '1') {
    $testMode='<div class="settings_table"><div class="title">Test mode:</div><div class="text">'.$mainclass->SetTestMode().'</div></div>';    
}
$tmp->setVar('id',$mainclass->user['id']);
$tmp->setVar('HelloUser',$mainclass->HelloUser($mainclass->user['name']));
$tmp->setVar('Tablets',$tablets);
$tmp->setVar('TestMode',$testMode);
$tmp->setVar('CountTest',$other->count->countTestWrite());
$tmp->setVar('CountAdmin',$other->count->countAdmin());
$tmp->setVar('title','Админ-панель');
$tmp->setCSS(array('main'));
$tmp->parse('main');
?>
