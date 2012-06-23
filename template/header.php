<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title><?php if(!isset($title)) { echo 'Произошла ошибка';} else echo $title?></title>
<noscript><meta http-equiv="refresh" content="0; URL=/badbrowser.php" /></noscript>
<meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
<meta http-equiv="Pragma" content="no-cache" />
<link href="./<?php echo $admin; ?>template/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
var lang = new Array();
</script>
<?php echo $css;
echo $t->js;?>
</head>
<body>
    <div id="error_message"></div>
    <div class="wrapper">
    <a href="index.php" class='wr'><img src="./<?php echo $admin; ?>template/images/loog.png" /></a>
    <div class="wrapper_without_img">
  <table width="100%">
    <tr>
      <td><div class="header">
<div class="menu">
<ul class="list"><li><a href="index.php">Главная</a></li></ul>
</div>
</div></td>
    </tr>