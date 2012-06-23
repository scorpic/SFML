$(function(){
	var dropbox = $('#dropbox'),
		message = $('.message', dropbox);
                count_files = 1;
	dropbox.filedrop({
		paramname:'pic',
		maxfiles: 8,
                maxfilesize: 2,
		url: '../admin/upload.php?test=' + test_id + '&uid=' + uid,
		uploadFinished:function(i,file,response){
                        $('.file_upload').append('<input type="hidden" name="file'+count_files+'" value="'+response['status']+'">');
			$('#count_files').val(count_files)
                        count_files++;
                        $.data(file).addClass('done');
		},
		
    	error: function(err, file) {
			switch(err) {
				case 'BrowserNotSupported':
					showMessage('<span style="font-size: 18px; color: #CD1B1B">Ваш браузер устарел.</br></br>Загрузка файлов невозможна</span>');
					break;
				case 'TooManyFiles':
					alert('Можно загрузить до 8 файлов');
					break;
				case 'FileTooLarge':
					alert(file.name+' слишком большой! Пожалуйста, загрузите файл меньшего размера (до 2 мб.)');
					break;
				default:
					break;
			}
		},
		
		// Функция вызываемая перед загрузкой
		beforeEach: function(file){
			if(!file.type.match(/^image\//)){
				alert('Можно загрузить только картинки');
				return false;
			}
		},
		
		uploadStarted:function(i, file, len){
			createImage(file);
		},
		
		progressUpdated: function(i, file, progress) {
			$.data(file).find('.progress').width(progress);
		},
                
                afterAll: function(msg) {
                    message.html('Ujnjdj');
                }
    	 
	});
	
	var template = '<div class="preview">'+
						'<span class="imageHolder">'+
							'<img />'+
							'<span class="uploaded"></span>'+
						'</span>'+
						'<div class="progressHolder">'+
							'<div class="progress"></div>'+
						'</div>'+
					'</div>'; 
	
	
	function createImage(file){

		var preview = $(template), 
			image = $('img', preview);
			
		var reader = new FileReader();
		
		image.width = 100;
		image.height = 100;
		
		reader.onload = function(e){
			
			// e.target.result holds the DataURL which
			// can be used as a source of the image:
			
			image.attr('src',e.target.result);
		};
		// Reading the file as a DataURL. When finished,
		// this will trigger the onload function above:
		reader.readAsDataURL(file);
		
		message.hide();
		preview.appendTo(dropbox);
		
		// Associating a preview container
		// with the file, using jQuery's $.data():
		
		$.data(file,preview);
	}
        
	function showMessage(msg){
		message.html(msg);
	}

});