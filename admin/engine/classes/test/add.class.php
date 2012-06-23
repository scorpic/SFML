<?php
/**
 * Description of test
 *
 * @author Дмитрий
 */
require(PATH.'engine/classes/other/other.class.php');
class add extends someFunction {
    function testAdd() {
        global $sec,$db,$mainclass;
        
        $title=$sec->filter($_POST['title'],150,'Вы забыли ввести заголовок');
        $subject=$sec->ClearInt($_POST['subject'],'Предмет не заполнен');
        $status=((int)$_POST['status']==2) ? '2' : '1';

        $test_subject=$db->query('SELECT id FROM subject WHERE id="'.$subject.'"','id теста неверен');
        $db->query('INSERT INTO nametest (`title`,`subject`,`status`,`user`) VALUES ("'.$title.'","'.$subject.'","'.$status.'","'.$mainclass->user['id'].'")');

        $sec->head('test.php?sec=add&cat=question&id='.mysql_insert_id().'&m=6');
    }

    function testMain() {
        global $db,$sec,$tmp;
            $tmp->setVar('title','Добавление теста');
            $sub_query=$db->query('SELECT * FROM subject ORDER BY title','Произошла ошибка в выборке предметов');
            $sid = $sec->ClearInt($_GET['sid']);

            while($subject=$db->fetch_array($sub_query)) {
                $list_sub.='
                    <option value="'.$subject['id'].'"'.($subject['id'] == $sid ? ' selected' : '').'>'.$subject['title'].'</option>'."\n";
            }
            $tmp->setVar('ListSubject',$list_sub);
            
        
    }

    function testQuestion($id=false,$message=false,$number_quest=2,$array=false) {
        global $db,$err,$sec,$m,$tmp;
        
        $tmp->setVar('title','Добавление вопросов');
        $tmp->setJS(array('addanswers','jquery.filedrop','fileupload','file'));
        $tmp->setVar('return','');
        $tmp->setVar('checkedAnswer','');
        
        $id=$sec->ClearInt($_GET['id'],'Пустой id');
        /* Выводим сообщение, если это нужно */
        if($message) {
            $_GET['m'] = $message;
            
        }
        /* Проверка на существование теста */
        $arr=$db->query('SELECT id,title FROM nametest WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого теста не нашлось',true);
        $i=20;
        if (strlen($arr['title']) > $i) {
            $arr['title']=substr($arr['title'], 0, $i).'...';
        }
        if(isset($_GET['ret'])) {
            $tmp->setVar('return','(назад)');
            $arr['link']='&ret=from_edit';
        }
        /* Создаем уникальный индентификатор */
        $arr['uid'] = uniqid();

        if($array) {
            $a=1;
            $tmp->setVar('checkedAnswer','checked');
            $tmp->setVar('return','(назад)');

            foreach($array as $k=>$v) {
                $arr_td.=$this->Tr($v['input'], $v['check'], $a);
                $a++;
            }
            $arr['link']='&ret=from_edit';
        } else {
            $arr_td.=$this->Tr('',false,1);
            $arr_td.=$this->Tr('',false,2);
        }
        $tmp->setVar('testId',$arr['id']);
        $tmp->setVar('testTitle',$arr['title']);
        $tmp->setVar('testUnique',$arr['uid']);
        $tmp->setVar('countAnswer',$number_quest);
        $tmp->setVar('answers',$arr_td);
    }
    /* Обновленная функция
     * Совмещает сохранение 1 и 2 типа вопроса
     * Если ответов больше чем 1, то 1 тип.
    */
    public function testAddQuestion() {
        global $err,$sec,$db,$mainclass;
        $type = 1;
        $id = $sec->ClearInt($_GET['id'],'Параметр задан неверно');
        /* Проверка на существование теста */        
        $query = $db->query('SELECT title FROM nametest WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого теста не нашлось');

        /* Собираем параметры */
        $title = $sec->filter($_POST['title'],false,'Вы случайно не забыли ввести название?');
        
        /* Проверим реальное количество ответов */
        $array_answers = $this->RealCountAnswers(8,false,1);
        
        if (count($array_answers) == 1) {
            $type = 2;
        }
        else {
            if (count($array_answers) > 8) {
                return $err->GNC('Очень очень очень много вопросов');
            }
            /* Проверяем, есть ли в ответах правильный ответ */
            if (!$this->isIssetTrueAnswer($array_answers)) {
                return $err->GNC('Вы не указали правильный ответ');
            }
            
        }
        
        $db->query('INSERT INTO question (ask,type,test,ball) VALUES ("'.$title.'",'.$type.','.$id.',0)');
        $last_id = mysql_insert_id();

        foreach($array_answers as $k => $v) {
            $db->query('INSERT INTO answers (title,question,correct,ball) VALUES ("'.$v['input'].'",'.$last_id.','.($type == 2 ? '1' : $v['check']).',1)');
        }
        
        $link=$this->pasteLink();
        $file=$this->addFile();
        
        if ($_POST['answers_next'] == '2' && $type == 1) {
            $mainclass->tmpName = 'addQuestion';
            return $this->TestQuestion($id,5,count($array_answers),$array_answers);
        }
            
        else
            return $sec->head('test.php?sec=add&cat=question&id='.$id.'&m=5&ret');
    }
    function Tr($input='',$check=false,$i) {
        return '<div class="answer" id="input'.$i.'"><input type="checkbox" name="ok'.$i.'" '.($check=='2' ? 'checked' : '').' value="2" class="big_checkbox" /><input name="answer'.$i.'" type="text" value="'.stripslashes($input).'" class="big_input" style="width: 400px" /></div>';
    }
    
}
?>
