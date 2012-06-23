<?php
require(PATH.'engine/classes/other/other.class.php');
class edit extends someFunction {
    public 
    $test=array();
    function testMain() {
        global $db,$tmp;
        
        $tmp->setVar('title','Редактирование | Список предметов');
        $tmp->setCSS(array('li'));
        
            $sub_query=$db->query('SELECT * FROM subject ORDER BY title','Произошла ошибка в выборке предметов');
            while($subject=$db->fetch_array($sub_query)) {
                $list_sub.='
                    <li class="sub">
                        <a href="test.php?sec=edit&cat=subject&sid='.$subject['id'].'">'.$subject['title'].'</a>
                    </li>';
            }
        $tmp->setVar('ListSubject',$list_sub); 
    }
    
    function testSubject() {
        global $db,$sec,$tmp;
        
        $tmp->setVar('title','Редактирование | Cписок тестов');
        $tmp->setCSS(array('li'));
        
        $id=$sec->ClearInt($_GET['sid'],'Параметр задан неверно');
        $sub_query=$db->query('SELECT * FROM nametest WHERE `subject` ="'.$id.'" AND `delete` != "2"','Тесты ещё не добавлены <br /> <a href="">Добавьте</a> первым');
        
        while($subject=$db->fetch_array($sub_query)) {
            $list_sub.='
                    <li class="sub">
                        <a href="test.php?sec=edit&cat=list&id='.$subject['id'].'">'.$subject['title'].'</a>
                        <a href="test.php?sec=edit&cat=edit&id='.$subject['id'].'" style="font-size: 14px; color: #CD1B1B; margin-bottom: 3px;">(изменить)</a>
                        <a href="test.php?sec=delete&cat=test&id='.$subject['id'].'" style="font-size: 14px; color: #CD1B1B; margin-bottom: 3px;">(удалить)</a>
                    </li>';
        }
        $tmp->setVar('ListTest',$list_sub); 
        $tmp->setVar('idSubject',$id);
    }
    
    function testList() {
        global $db,$sec,$tmp,$other;
        
        $tmp->setVar('title','Редактирование теста');
        $tmp->setCSS(array('li'));
        
        $id=$sec->ClearInt($_GET['id'],'Параметр задан неверно');
        
        $quest=$db->query('SELECT * FROM question WHERE `test`="'.$id.'" AND `delete` != "2"','Вопросов нет, но вы можете <a href="test.php?sec=add&cat=question&ret&id='.$id.'" style="color: #2D76B9;">добавить</a> их в любое время');
        $sub=$db->query('SELECT * FROM nametest WHERE id="'.$id.'" LIMIT 1',false,true);
        while($subject=$db->fetch_array($quest)) {
            $list_sub.='
                <li class="editable">
                    <a href="test.php?sec=edit&cat=answer&id='.$subject['id'].'">'.stripslashes($subject['ask']).'</a>
                    <a href="test.php?sec=delete&cat=question&id='.$subject['id'].'" style="color: #CD1B1B; ">(удалить)</a>
                </li>';
        }
        $i=40;
        if (strlen($sub['title']) > $i) {
            $sub['title']=substr($sub['title'], 0, $i).'...';
        }
        
        $countAnswer = $other->time->rulesTime($db->num_rows($quest),array('вопрос','вопроса','вопросов'));
        
        $tmp->setVar('ListTest',$list_sub); 
        $tmp->setVar('CountAnswer',$countAnswer);
        $tmp->setVar('TestTitle',$sub['title']);
        $tmp->setVar('TestId',$id);
    } 
    
    function testAnswer() {
        global $db,$sec,$tmp;
        
        require 'engine/classes/file.class.php';
        
        $tmp->setVar('title','Редактирование ответов');
        $tmp->setJS(array('jquery.filedrop','fileupload','addanswers'));
        
        $id=$sec->ClearInt($_GET['id'],'Параметр задан неверно');        
        $question=$db->query('SELECT * FROM question WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого вопроса не нашлось',true);
        
        $function = 'typeTest_'.$question['type'];
        $this->$function($question['id']);
        
        $tmp->setVar('TestId',$question['test']);
        $tmp->setVar('AnswerId',$id);
        $tmp->setVar('TextAsk',stripslashes($question['ask']));
        $tmp->setVar('ListFile',$file->ListFile($question));
        $tmp->setVar('CountFile',$file->count);
        
    } 
    
    function testEdit() {
        global $db,$sec,$tmp;
        $tmp->setVar('title','Редактирование теста');
        
        $id=$sec->ClearInt($_GET['id'],'Параметр задан неверно');
       
        $sub=$db->query('SELECT * FROM nametest WHERE `id`="'.$id.'" AND `delete` != "2" LIMIT 1','Тест не нашелся',true);
        
        
        $sub_query=$db->query('SELECT * FROM subject','Произошла ошибка в выборке предметов');  
            while($subject=$db->fetch_array($sub_query)) {
                $check = ($subject['id']==$sub['subject'] ? ' selected' : '');
                $list_sub.='
                        <option value="'.$subject['id'].'"'.$check.'>'.$subject['title'].'</option>';
            }
            
        $tmp->setVar('TestId',$id);
        $tmp->setVar('InputTitle',stripslashes($sub['title']));
        $tmp->setVar('Checked',($sub['status']=='2' ? 'checked="checked"' : ''));
        $tmp->setVar('ListSubject',$list_sub);
        
    } 
    
    
    protected function typeTest_1($id) {
        global $db,$tmp,$mainclass;
        
        $i = 0;
        $query_ans=$db->query('SELECT * FROM answers WHERE question='.$id.'');
        
        while($arr=$db->fetch_array($query_ans)) {
            $i++;
            $answers.='
                <div class="answer" id="input'.$i.'">
                    <input name="ok'.$i.'" '.($arr['correct']==2 ? 'checked="checked"' : '').' value="2"  type="checkbox" class="big_checkbox" />
                    <input name="answer'.$i.'" type="text" value="'.$arr['title'].'" class="big_input" style="width: 400px" />
                    <input type="hidden" name="answerid'.$i.'" value="'.$arr['id'].'">
                </div>';
        }
        $mainclass->tmpName .= 'Type1';
        $tmp->setVar('CountAnswer',$i);
        $tmp->setVar('ListAnswer',$answers);
        
    }
    
    protected function typeTest_2($id) {
        global $db,$tmp,$mainclass;

        $arr=$db->query('SELECT * FROM answers WHERE question='.$id.' LIMIT 1',false,true);
        
        $mainclass->tmpName .= 'Type2';
        $tmp->setVar('Answer',$arr['title']);
        $tmp->setVar('CountAnswer','0');
    }

/*
 * Функции обработчики
 * testUpdateTest - изменение теста
 * testUpdateTypeOne - изменение вопроса 1 типа
 * testUpdateTypeTwo - изменение вопроса 2 типа
 */    
    
    
    function testUpdateTest() {
        global $db,$sec;
        $id=$sec->ClearInt($_GET['id'],'id теста неверен');
        
        $query_for_test=$db->query('SELECT id FROM nametest WHERE `id`='.$id.' AND `delete` != "2"','Теста не существует');

        $title=$sec->filter($_POST['title'],150,'Заголовок теста не заполнен');
        $subject=$sec->ClearInt($_POST['subject'],'Предмет не указан');
        $status=($_POST['status'] == '2' ? (int)$_POST['status'] : '1');
        
        $test_subject=$db->query('SELECT id FROM subject WHERE id="'.$subject.'"','id предмета неверен');
        
        $db->query('UPDATE nametest SET title="'.$title.'", subject="'.$subject.'", status="'.$status.'" WHERE id='.$id.'');
        
        $sec->head('test.php?sec=edit&cat=list&id='.$id.'&m=1');
    }
    
    function testUpdateAnswer() {
        global $sec,$db;
        $id=$sec->ClearInt($_GET['id'],'id теста неверен');
        
        if($id != $_POST['id']) {
            exit('Hacker :(');
        }
        $title = $sec->filter($_POST['title'],false,'Заголовок теста не заполнен');
        
        $arr_quest=$db->query('SELECT id, type, test FROM question WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого вопроса не нашлось',true);
        
        $this->test_id = $arr_quest['test'];
        
        $function = 'typeTest_'.$arr_quest['type'].'Update';

        $this->$function($arr_quest['id']);
        
        
        
        $file=$this->addFile(json_decode($arr_quest['code']));
        
        $db->query("UPDATE question SET ask='$title', code='".$file."' WHERE id={$arr_quest['id']} ");
        
        
        $sec->head('test.php?sec=edit&cat=list&m=1&id='.$arr_quest['test']);
    }
    
    function typeTest_1Update($id) {
        global $db,$sec,$err;
        /* Параметр предназначенный для передачи файлов */
        $num=$sec->ClearInt($_POST['number'],'Security breach');
        
        if ($num > 8) {
            return $err->GNC('Security breach 1');
        }

        /* Проверим реальное количество ответов */
        $array_answers = $this->RealCountAnswers($num,true);
        
        /* Проверяем, есть ли в ответах правильный ответ */
        if (!$this->isIssetTrueAnswer($array_answers)) {
            return $err->GNC('Вы не указали правильный ответ');
        }
        
        $first = true;
        foreach ($array_answers as $k => $v) {
            if (!$first) {
                $ids .= ' AND ';  
            }        
            if (!empty($v['id'])) { 
                $db->query('UPDATE answers SET title="'.$v['input'].'",correct='.$v['check'].' WHERE id='.$v['id'].'');
                $first = false;
                $ids .= 'id != '.$v['id'];
            }
            else {  
                $db->query("INSERT INTO answers (title,correct,question,ball) VALUES ('{$v['input']}','{$v['check']}','{$this->id}',1)");
                $ids .= 'id != '.mysql_insert_id();
                $first = false;
            }
        }     
        
        $db->query('DELETE FROM answers WHERE question='.$id.' AND ('.$ids.')');
        
    }
    
    function typeTest_2Update($id) {
        global $db,$sec;
        
        
        $input=strtolower($sec->filter($_POST['answer'],255,'Ответ не заполнен'));       
        
        $test_query=$db->query('UPDATE answers SET title="'.$input.'" WHERE question='.$id.'');
    }
}
?>