{HEADER}
   <script type="text/javascript">var i = {CountAnswer}, test_id = {TestId}, uid = "";</script>
    <div class="headi" style="margin: 10px 0 0 10px;">
        Редактирование ответов 
        <a href="test.php?sec=edit&cat=list&id={TestId}">(назад)</a>
    </div>
    <div style="margin-left: 10px;">
        <form action="test.php?sec=edit&cat=updateAnswer&id={AnswerId}" method="post">
            <div class="table">
            <div class="left" id="right_bar">
                <h1 class="head">Вопрос</h1>
                <div class="table_text"> 
                    <textarea name="title" class="big_input textArea" id="TitleTextarea" style="width: 470px; min-height: 50px; overflow: hidden; " />{TextAsk}</textarea>
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
             {ListAnswer}

            </div>     
        <div class="right_bar">
            <h1 class="head">Изображение (не обязательно)</h1>
            <div class="dropbox_top" style="width: 455px;">&nbsp;</div>
            <div class="file_upload" id="dropbox" style="width: 450px;">
               {ListFile}
                <input type="hidden" name="count_files" value="{CountFiles}" id="count_files">
            </div>
        </div>
        <table width="100%" border="0" style="margin-top: 40px;">
            <tr>
                <td width="325px" align="right" class="ListTableLeftBar">&nbsp;</td>
                <td>
                    <input type="hidden" name="number" id="valans" value="{CountAnswer}">
                    <input type="hidden" name="id" value="{AnswerId}">
                    <input name="ok" type="submit" value="Обновить вопрос" />
                </td>
            </tr>
        </table>
    </div>


    </form>

    </div>
{FOOTER}