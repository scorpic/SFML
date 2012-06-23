<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="shortcut icon" href="../../../favicon.ico" />
<title>{title}</title>
<noscript><meta http-equiv="refresh" content="0; URL=/badbrowser.php" /></noscript>
<meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
<meta http-equiv="Pragma" content="no-cache" />
<link href="../template/css/style.css" rel="stylesheet" type="text/css" />
{CSS}
{JS}
</head>
<body>
    <div id="error_message"></div>
    <div class="wrapper">
    <div class="wr"><a href="index.php"><img src="../template/images/loog.png" /></a></div>
    <div class="wrapper_without_img">
    <table width="100%">
    <tr>
      <td><div class="header">
<div class="menu">
<ul class="list"><li><a href="index.php">Главная</a></li><li><a href="../">Перейти к сайту</a></li></ul>
</div>
</div></td>
    </tr>
   <tr><td style="background-color: #fff; border-radius: 5px; padding: 10px;">
            <div class="adminMainBar">
                <div class="headi" style="margin-left: 10px;">{HelloUser} <div style="float: right; margin-right: 20px;"><a href="login.php?act=logout">(выйти)</a></div></div>
                {Tablets}
            </div>
            <div class="adminSubBar">
                
                <div class="headi">Основные настройки</div>
                <div class="settings_table"><div class="title">Профиль:</div><div class="text"><a href="user.php?sec=profile&id={id}">Редактировать</a></div></div>
                {TestMode}
                <div class="headi">Статистика</div>
                <div class="settings_table"><div class="title">Всего тестов:</div><div class="text">{CountTest}</div></div>
                <div class="settings_table"><div class="title">Администраторов:</div><div class="text">{CountAdmin}</div></div>
            </div>
            </td>
    </tr>      
<tr>
    <td><div class="footer"><span class="foo left"><a href="../copyright.php">Правила перепечатки</a></span><span class="foo right">© sfml.tom.ru 2011</span></div></td>
    </tr>
  </table>
</div>
</div>

</body>
</html>
