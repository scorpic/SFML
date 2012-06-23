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
<script type="text/javascript">
var lang = new Array();
</script>
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
                <div class="headi" style="margin-left: 10px;">{User} {Delete}</div>
                <div class="hint" style="padding-left: 10px">Администратор добавил следующие тесты</div>
                <ul class="test" style="width: 630px; padding: 0 10px 0 10px;" >
                    {ListTests}
                </ul>
            </div>
            <div class="adminSubBar">
                <div class="headi">Последний визит:</div>
                <div class="settings_table" style="font-size: 20px; color: #666;">{lastvisit}</div>
                <div class="headi">Зарегистрирован:</div>
                <div class="settings_table" style="font-size: 20px; color: #666;"><div class="title">{registered}</div></div>
                <div class="headi">Изменение профиля</div>
                <div class="settings_table"><div class="title"><a href="user.php?sec=edit&id={id}">Редактировать</a></div></div>
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
