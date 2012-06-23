{HEADER}
<script type="text/javascript">var i = {countAnswer}, test_id = {testId}, uid = "{testUnique}";</script>
<div class="headi" style="margin: 10px 0 0 10px;">
    Добавление вопросов к тесту на тему "{testTitle}"
    <a href="test.php?sec=edit&cat=list&id={testId}">{return}</a>
</div>
    <div style="margin-left: 10px;">
        <form action="test.php?sec=add&cat=addQuestion&id={testId}" method="post">
            <div class="table">
                <div class="left" id="right_bar">
                    <h1 class="head">Вопрос</h1>
                    <div class="table_text"> 
                        <textarea name="title" class="big_input textArea" id="TitleTextarea" style="width: 465px; min-height: 50px; overflow: hidden; " /></textarea>
                        <div class="textAreanone"></div>  
                    </div>
                    <h1 class="head" style="-moz-user-select: none; -webkit-user-select: none; ">
                        Варианты ответа 
                        <span class="hint">
                            <span id="addans" class="addansact" style="color: #69C;">добавить</span>
                             | 
                            <span id="delans">удалить</span> 
                        </span>
                    </h1>
                    <div class="hint" style="margin: 0 0 10px 10px;">Поставьте галочку рядом с ответом, который правильный.</div>
                        {answers}
                 </div>
                    <div class="right_bar">
                        <h1 class="head">Изображение (не обязательно)</h1>
                        <div class="dropbox_top">&nbsp;</div>
                        <div class="file_upload" id="dropbox">
                            <span class="message">
                                Перенесите изображения сюда. <br />
                                <i>(они сразу же появятся в тесте)</i>
                            </span>

                            <input type="hidden" name="count_files" value="0" id="count_files">
                        </div>
                        
                    </div>
                    <table width="100%" border="0" style="margin-top: 30px;">
                        <tr>
                            <td width="225px" align="right" class="ListTableLeftBar">
                                <input type="checkbox" name="answers_next" value="2" {checkedAnswer} >Оставить ответы
                            </td>
                            <td>
                                <input type="hidden" name="number" id="valans" value="{countAnswer}">
                                <input name="ok" type="submit" value="Сохранить" /> &nbsp;
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </div>
{FOOTER}