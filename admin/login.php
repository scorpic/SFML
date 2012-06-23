<?php
    define('CMS', true);
    define('PA', '../admin/');
require PA.'engine/classes/mainclass.php';
if ($_GET['act']=='logout') {
    $mainclass->LogOut();
}


if($_GET['act']=='login') {
    $mainclass->Login($_GET['to']);
    $from=$sec->filter($_GET['to']);
}
if(isset($_GET['from'])) {
    $from=urlencode($_GET['from']);
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
        <title>Вход</title>
        <link href="template/css/login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="table">
            <div class="header">Вход в админ панель</div>
            <div class="back"><a href="../index.php">Назад на сайт</a></div>
                <div class="main">
                
                <form action="../admin/login.php?act=login&to=<?php echo $from; ?>" method="post">
                <div> &nbsp;Логин:       <input type="text" class="inp" name="login" maxlenght="25" > </div>
                <div>Пароль:      <input type="password" class="inp" name="pass" maxlenght="25" ></div> </div>
            <div class="footer"><button type="submit">Войти</button></div>
            </form>
        </div>
    </body>
</html>
