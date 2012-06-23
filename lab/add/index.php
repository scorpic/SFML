
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="shortcut icon" href="../../../favicon.ico" />
<title>Редактирование ответов</title>
<script type="text/javascript" src="../../script/jquery.js"></script>
<link href="../../template/css/style.css" rel="stylesheet" type="text/css" />
<link href="../../admin/template/css/main.css" rel="stylesheet" type="text/css" />
<link href="../../admin/template/css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../../script/jquery.filedrop.js"></script>
<script type="text/javascript" src="../../script/fileupload.js"></script>
<script type="text/javascript" src="../../script/addanswers.js"></script>

</head>
<body>
    <div id="error_message"></div>
    <div class="wrapper">
    <div class="wr"><a href="index.php"><img src="../../template/images/loog.png" /></a></div>
    <div class="wrapper_without_img">
  <table width="100%">
    <tr>
      <td><div class="header">
<div class="menu">
<ul class="list"><li><a href="../admin">Главная</a></li><li><a href="../">Перейти к сайту</a></li></ul>
</div>
</div></td>
    </tr>
    <tr>
        <td style="background-color: #fff; border-radius: 5px;">
    <script type="text/javascript">var i = 5, test_id = 67, uid = "";</script>
    <div class="headi" style="margin: 10px 0 0 10px;">
        Редактирование вопроса
        <a href="test.php?sec=edit&cat=test&id=67">(назад)</a>
        
    </div>
    <div style="margin-left: 10px;">
        <form action="test.php?act=editquest&id=67&type=1" method="post">
            <div class="table">
            <div class="left" id="right_bar">
                <h1 class="head">Вопрос</h1>
                <div class="table_text"> 
                    <textarea name="title" class="big_input textArea" id="TitleTextarea" style="width: 470px; min-height: 50px; overflow: hidden; " />Оман</textarea>
                    <div class="textAreanone"></div>
                </div>
                 <h1 class="head" style="-moz-user-select: none; -webkit-user-select: none; ">
                Варианты ответа 
                <span class="hint" >
                    <span id="addans" class="addansact" style="color: #69C;">добавить</span>
                     | 
                    <span id="delans">удалить</span>
                </span>
            </h1>
            <div class="hint" style="margin: 0 0 10px 10px;">Поставьте галочку рядом с ответом, который правильный.</div>
            
                <div class="answer" id="input1">
                    <input name="ok1"  value="2"  type="checkbox" class="big_checkbox" />
                    <input name="answer1" type="text" value="Екатерина I" class="big_input" style="width: 400px" />
                    <input type="hidden" name="answerid1" value="39">
                </div>
                <div class="answer" id="input2">
                    <input name="ok2"  value="2"  type="checkbox" class="big_checkbox" />
                    <input name="answer2" type="text" value="Анна Иоанновна" class="big_input" style="width: 400px" />
                    <input type="hidden" name="answerid2" value="40">
                </div>
                <div class="answer" id="input3">
                    <input name="ok3"  value="2"  type="checkbox" class="big_checkbox" />
                    <input name="answer3" type="text" value="Елизавета Петровна" class="big_input" style="width: 400px" />
                    <input type="hidden" name="answerid3" value="41">
                </div>
                <div class="answer" id="input4">
                    <input name="ok4"  value="2"  type="checkbox" class="big_checkbox" />
                    <input name="answer4" type="text" value="Петр III" class="big_input" style="width: 400px" />
                    <input type="hidden" name="answerid4" value="42">
                </div>
                <div class="answer" id="input5">
                    <input name="ok5" checked="checked" value="2"  type="checkbox" class="big_checkbox" />
                    <input name="answer5" type="text" value="Петр II" class="big_input" style="width: 400px" />
                    <input type="hidden" name="answerid5" value="43">
                </div>

            </div>     
        <div class="right_bar">
            <h1 class="head">Изображение (не обязательно)</h1>
            <div class="dropbox_top" style="width: 455px;">&nbsp;</div>
            <div class="file_upload" id="dropbox" style="width: 450px;">
                <span class="message">Изображения не загружены<br /> Перенесите изображения сюда. <br /><i>(они сразу же появятся в тесте)</i></span>
                <input type="hidden" name="count_files" value="" id="count_files">
            </div>
        </div>
        <table width="100%" border="0" style="margin-top: 40px;">
            <tr>
                <td width="325px" align="right" class="ListTableLeftBar">&nbsp;</td>
                <td>
                    <input type="hidden" name="number" id="valans" value="1">
                    <input type="hidden" name="id" value="67">
                    <input name="ok" type="submit" value="Обновить вопрос" />
                </td>
            </tr>
        </table>
    </div>


    </form>

    </div>


        </td>
    </tr>
<tr>
    <td><div class="footer"><span class="foo left"><a href="copyright.php">Правила перепечатки</a></span><span class="foo right">© sfml.tom.ru 2012 </span></div></td>
    </tr>
  </table>
</div>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter10637911 = new Ya.Metrika({id:10637911, enableAll: true, webvisor:true});
        } catch(e) {}
    });
    
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/10637911" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html><!-- generated: 0.0125908851624 seconds -->