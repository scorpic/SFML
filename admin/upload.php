<?php
define('CMS', true);
define('A', '../admin/');
require A.'engine/classes/mainclass.php';
$mainclass->isAdmin();
require A.'engine/classes/other/secondary.class.php';
require A.'engine/classes/file.class.php';

$upload_dir = '../uploads/tests/';
$allowed_ext = array('jpg','jpeg','png','gif');

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	exit_status('Error! Wrong HTTP method!');
}
if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
	$pic = $_FILES['pic'];        
        $test_id = $sec->ClearInt($_GET['test'],true);
        $uid = $sec->filter($_GET['uid'],13);
        
        if (!$type = $file->isImage($_FILES['pic']['tmp_name'])) {
            exit_status('Is not image');
        }
        
        /* Проверка существует ли тест */
        if (!$secondary->issetTest($test_id)) {
            exit_status('Error! Test not found!');
        }
        /* Проверяем есть ли папка, если нет, то создаем её */
        if (!is_dir($upload_dir.$test_id)) {
            mkdir($upload_dir.$test_id, 0755);
        }
        
        $filename = $file->generateNameFile().$type;
        if(move_uploaded_file($pic['tmp_name'], $upload_dir.$test_id.'/a_'.$filename)){
            $new_height_b = $file->image[1];
        if ($file->image[0] > 280) {
            $new_height_b=floor($file->image[1]*(280/$file->image[0]));  
        }
	$file->img_resize($upload_dir.$test_id.'/a_'.$filename, $upload_dir.$test_id.'/b_'.$filename, 280, $new_height_b);
        $new_height_c=floor($file->image[1]*(130/$file->image[0])); 
        $file->img_resize($upload_dir.$test_id.'/a_'.$filename, $upload_dir.$test_id.'/c_'.$filename, 130, $new_height_c);
            
            exit_status($filename);
	}

}

exit_status('Something went wrong with your upload!');
function exit_status($str){
	exit( json_encode(array('status'=>$str)) );
}

function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}
?>