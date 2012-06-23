$(document).ready(function() 
{
	var oldText, newText;
  	$(".editable").hover(
		function()
		{
			$(this).addClass("editHover");
		}, 
		function()
		{
			$(this).removeClass("editHover");
		}
	);
  
  	$(".editable").bind("dblclick", replaceHTML);
	 
	 
	$(".btnSave").live("click", 
					function()
					{
						newText = $('#editBox').val().replace(/"/g, "&quot;");
						$.ajax({
                                                    type: 'POST',
                                                    url: 'test.php?act=editquest&id='+id
                                                });				 
										 
										 
						$(this).parent().parent()
							   .html(newText)
							   .removeClass("noPad")
							   .bind("dblclick", replaceHTML);
					}
					); 
	
	$(".btnDiscard").live("click", 
					function()
					{
						$(this).parent()
							   .html(oldText)
							   .removeClass("noPad")
							   .bind("dblclick", replaceHTML);
					}
					); 
	
	function replaceHTML()
					{
						oldText = $(this).html()
										 .replace(/"/g, "&quot;");
						$(this).addClass("noPad")
							   .html("")
							   .html("<div style=\"float: left;\"><input type=\"text\" id=\"editBox\" class=\"editBox\" value=\"" + oldText + "\" /></div><div class=\"okbox\"><a href=\"#\" class=\"btnSave\">Сохранить</a> <a href=\"#\" class=\"btnDiscard\">Отмена</a></div>")
							   .unbind('dblclick', replaceHTML);
			
					}
}
); 

