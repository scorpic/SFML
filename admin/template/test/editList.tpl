{HEADER}       
    <div class="headi" style="margin: 10px 10px 0 10px; height: 10px;">{CountAnswer} к тесту "{TestTitle}"</div>  
    <table width="100%" border="0">
    <tr>
        <span style="color: #323232; font-size: 14px; margin-left: 10px">
            <a href="test.php?sec=edit&cat=edit&id={TestId}" style="color: #69C">(изменить)</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="test.php?sec=add&cat=question&ret&id={TestId}" style="color: #69C">(добавить вопрос)</a>
        </span>
    </tr>
    <tr>
        <ul class="test">{ListTest}
        </ul>
    </tr>
    </table>
    {FOOTER}