$(document).ready(function(event){
    // Второстепенные функции
    function rulesTime(number,arr) {
        cases = [2, 0, 1, 1, 1, 2];  
        return number + ' ' + arr[ (number%100 > 4 && number%100<20) ? 2 : cases[(number%10<5)?number%10 : 5] ];
    }
    
    function calcPercent(count_answers, count_true_answers) {
        return Math.round( (count_true_answers * 100) / count_answers);
    }    
    function calcBall(percent) {
        if (percent > 80) {  return '5'; }
        else if (percent > 60) { return '4'; }
        else if (percent > 30) { return '3'; }
        else { return '2'; }
    }
    
    // Конец
    
    function succesRequest(bool,number) {
        if(bool == 'true') {
            number_true_answers = number_true_answers + 1;
            $('button.btn#' + number).addClass('btn-success');
        } else
            $('button.btn#' + number).addClass('btn-danger');
    }
    
    function AjaxTest(id,async) {
        i++;
        if (arr.questions[i-1].type == 2) {
            var valueinp=$('input#'+id).val();
            $.ajax({ type: "POST", async: async, cache: false, url: "./test.php?act=test&type=2",
                data: ({ id: id, value : valueinp }),
                success: function(data) { succesRequest(data,i)  }
            });     
        } 
        else
        {
            // Проверка теста
            $.ajax({ type: "POST", async: async, cache: false, url: "./test.php?act=test&type=1",
                data: ({ id: id }),
                success: function(data) { succesRequest(data,i)  }
            });
        }
    }
    function NextAsk(i) {
        ul.html('');
        images.html('');
        images.css({'display' : 'none'});
        $("#ask").html(arr.questions[i].text);
        if (arr.questions[i].path != null) {
            images.css({'display' : 'block'});
            $(arr.questions[i].path).each(function(){
            if (arr.questions[i].count_images == 1) {
                images.append('<div class="image_row"><img src="uploads/tests/'+test_id+'/b_'+this.path+'" /></div>');
            }    
            else {
                images.append('<div class="image_row"><img src="uploads/tests/'+test_id+'/c_'+this.path+'" /></div>');
            }
            
        });
            
        } else {
            images.css({'display' : 'none'});
        }
        if (arr.questions[i].type == 1) {
            AskType1(i);
        } else if(arr.questions[i].type == 2) {
            AskType2(i);
        } 
        $(window).load(function () {
            $('.LeftBar').height($('.MainBar').innerHeight()-5);
        });
    }
    function EndTest(time) {
        images.html('');
        images.css({'display' : 'none'});
        $.ajax({ type: "POST", async: true, cache: false, url: "./test.php?act=count_pass",
                data: ({ id: test_id }),
                success: function(data) { }
            });
        $("#ask").html(lang['test_complete']);
        percent = calcPercent(arr.questions.length,number_true_answers);
        block_answer.css({'width' : '100%'});
        block_answer.html("<div class='percent'>"+calcBall(percent)+"</div>\n\
        <div class='inform'><p>"+lang['test_complete_in'] + rulesTime(time,lang['arr_seconds']) + " <br />"+lang['number_true_answers']+number_true_answers+"<br />"+lang['test_complete_on']+percent+"%<br /> <br /> <div class='buttonVK'><a href='javascript:location.reload(true)'>"+lang['refresh']+"</a></p></div><div class='buttonVK'><a href='http://vkontakte.ru/share.php?url=http://sfml.tom.ru/tests/&image=http://sfml.tom.ru/tests/template/images/logo_main.png&title=%D0%AF+%D0%BF%D1%80%D0%B0%D0%B2%D0%B8%D0%BB%D1%8C%D0%BD%D0%BE+%D0%BE%D1%82%D0%B2%D0%B5%D1%82%D0%B8%D0%BB+%D0%BD%D0%B0+"+number_true_answers+"+%D0%B8%D0%B7+"+rulesTime(arr.questions.length,lang['arr_questions'])+"&description=%D0%92+%D1%82%D0%B5%D1%81%D1%82%D0%B5+%D0%BF%D0%BE+%D1%82%D0%B5%D0%BC%D0%B5+%22"+encodeURIComponent(theme)+"%22' target='_blank'>"+lang['tell_vk']+"</a></div></div>");
        $('.LeftBar').height($('.MainBar').innerHeight()-5);
        return true;
    }
    function AskType1(i) {
        $(arr.questions[i].answers).each(function(){
            var li = $('<li>',{
                id      : this.id,
                html    : this.text
            });
            li.addClass(this.add_class);
            li.data('object',this);
            ul.append(li);
        });
        
    }
    function AskType2(i) {
            $(arr.questions[i].answers).each(function(){
                var input = $('<input>',{ id : this.id, value : lang['enter_answer'] });
                input.addClass('InputAns');
                input.data('object',this);
                var but = $('<div>',{
                    id      : this.id,
                    html    : lang['reply']
                });
                but.addClass('a but');
                
                
                ul.append(input);
                ul.append(but);
                Focus(this.id);
            });
    }
    function isClick() {
        $(".a").live("click", function(event){
            id = $(this).attr('id');
            $('.but').css({'display' : 'none'});
            var button_load= $('<div>',{
                html    : '<img src="./template/images/search-preloader.gif" />'
            });
            button_load.addClass('but');
            ul.append(button_load);
            GoGo(id,event);
        }); 
    }
    function isEnterDown(id) {
        $(window).keydown(function(ev){
            if (ev.keyCode == 13) {
                GoGo(id);        
            }
        });
    }
    function Focus(id) {
        $('.InputAns').focus(function(){
            if($('.InputAns').val() == lang['enter_answer']) {
            $('.InputAns').val('');
            }
        });
        $('.InputAns').blur(function(){
            if($('.InputAns').val().length == '') {
            $('.InputAns').val(lang['enter_answer']);
            }
        });
    }  function GoGo(id,event) {
        if((arr.questions.length - 1) == i) {
            time = (Math.round(+new Date()/1000)-time);
            // Проверка теста
            // Выполняется синхронный запрос
            AjaxTest(id,false);
            EndTest(time);
           }
        else {
            // Проверка теста
            AjaxTest(id,true); 
            // Следующий вопрос
            NextAsk(i);
        }
    }

  
    
    var i = 0,
    time = Math.round(+new Date()/1000),
    number_true_answers = 0, // количество правильных ответов
    ul=$('ul.ans'),
    sc=$('ul.sc'),
    images = $('div.images'), 
    scale='',
    block_answer=$('div.answer'),
    // слова
    theme=$('#theme').text();
    // конец слов
    $('#theme').html();
    // Первый вопрос
    NextAsk(0);
    isClick();
    
    $("#error_message").ajaxError(function(event, request, settings){ 
        $(this).css({'display' : 'block'});
        $(this).html(lang['ajax_error'] + ' ' + lang['on_page'] + settings.url + "</br>" + lang['you_cannot_test_complete']);   
    });  
});