        var i_old = i,
        table=$('.right_bar'),
        input_hidden=$('#valans');
        if(i > 2) {
                            $('#delans').addClass('delansact').css('color','#69C');
                        }
        $("span#addans").live("click", function() {
            if (i < 8) {
                $('#delans').addClass('delansact').css('color','#69C');
                i=i+1;
                input_hidden.val(i);
                if (i > i_old) {
                table.append('<div class="answer" id="input'+i+'"><input name="ok'+i+'" type="checkbox" value="2" class="big_checkbox" /><input name="answer'+i+'" type="text" class="big_input" style="width: 400px" /></div>');
                i_old=i_old+1;
                }
                else {
                     $('#input'+i).css('display', 'table-row');
                }
                    if(i > 7) {
                        $('#addans').removeClass('addansact').css('color','#666');
                    }
            }
        });
        $("span#delans").live("click", function() {
            if(i > 2) {
                $('#addans').addClass('addansact').css('color','#69C');
                $('#input'+i).css('display', 'none');
                i=i-1;
                input_hidden.val(i);
                if(i==2) {
                            $('#delans').removeClass('delansact').css('color','#666');
                        }
            }
        });
        
        $('.toogle').click(function() {
        $('#'+$(this).attr('to')).slideToggle("slow");
        $(this).toggleClass('on'); 
        });