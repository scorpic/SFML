<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Добавление вопросов</title>
<link href="../../template/css/style.css" rel="stylesheet" type="text/css" />
<link href="../../admin/template/css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../upload/assets/css/styles.css" />
<script type="text/javascript" src="../../script/jquery.js"></script>
<script type="text/javascript" src="../../script/jquery.filedrop.js"></script>
<script type="text/javascript" src="../../script/fileupload.js"></script>
<script type="text/javascript" src="../../script/addanswersv2.js"></script>
<script type="text/javascript" src="../../script/spisok.js"></script>
</head>
<body>
<div class="wrapper_without_img">
  <table width="100%">
    <tr>
      <td><div class="header"><a href="../"><img src="../../template/images/logo.png" /></a>
<div class="menu">
<ul class="list"><li><a href="../admin">Главная</a></li><li><a href="../">Перейти к сайту</a></li></ul>
</div>
</div></td>
    </tr><tr><td style="background-color: #fff; border-radius: 5px;"><script type="text/javascript">var i = 2;</script>  
   <div class="headi" style="margin: 10px 0 0 10px;">Добавление вопросов к тесту на тему "Дворцовые перевороты" <a href="test.php?sec=edit&cat=test&id=3">(назад)</a></div>
   <div style="margin-left: 10px;">
       <script type="text/javascript">var i = 2;</script>  
        <form action="test.php?act=addquestion&ret=from_edit&id=3&type=1&ret" method="post">
   <div class="hint" style="margin: 0 0 10px 10px;">Поставьте галочку рядом с ответом, который правильный.</div>
   <div class="table">
       
       
       <div class="left">
           <h1 class="head">Вопрос</h1>
           <div class="table_text"> <input name="title" type="text" class="big_input" style="width: 470px" /></div>
           <div class="table_input" style="width: 300px; text-align: left">Изображение (не обязательно)</div>
           <div class="file_upload" id="dropbox">
			<span class="message">Перенесите изображения сюда. <br /><i>(they will only be visible to you)</i></span>
		</div>
        
       </div>
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       <div class="right_bar">
           <h1 class="head" style="-moz-user-select: none; -webkit-user-select: none; ">Варианты ответа <span class="hint" ><span id="addans" class="addansact" style="color: #69C;">добавить</span> | <span id="delans">удалить</span> </span></h1>
           <div class="answer" id="input1"><input name="ok1" value="2" type="checkbox" class="big_checkbox" /><input name="answer1" type="text" class="big_input" style="width: 400px" /></div>
           <div class="answer" id="input2"><input name="ok1" value="2" type="checkbox" class="big_checkbox" /><input name=answer2" type="text" class="big_input" style="width: 400px" /></div> 
       </div>
   </div>
     <table width="100%" border="0" style="margin-top: 30px;">
       <tr>
         <td width="225px" align="right" class="ListTableLeftBar"><input type="checkbox" name="answers_next" value="2">Оставить ответы</td>
         <td><input type="hidden" name="number" id="valans" value="2"><input type="hidden" name="id" value="3"><input name="ok" type="submit" value="Сохранить и добавить еще один вопрос" /> &nbsp;</td>
       </tr>
   </table>

   </form>

   </div></td></tr>
<tr>
    <td><div class="footer"><span class="foo left"><a href="copyright.php">Правила перепечатки</a></span><span class="foo right">© sfml.tom.ru 2011 | Разработал <a href="http://vkontakte.ru/mukovkin">Муковкин Дмитрий</a></span></div></td>
    </tr>
  </table>
</div>
</div>
</div>
</body>
</html>