<?php
require('other/other.class.php');
class test extends someFunction {
    public 
    $test=array();
    function ListSubject() {
        global $db,$err;
            $sub_query=$db->query('SELECT * FROM subject ORDER BY title','Произошла ошибка в выборке предметов');
            while($subject=$db->fetch_array($sub_query)) {
                $list_sub.='<li class="sub"><a href="test.php?sec=edit&cat=list&sid='.$subject['id'].'">'.$subject['title'].'</a></li>';
            }
    $content='<div class="headi" style="margin: 10px 10px 0 10px; height: 10px;">Список предметов     </div>
   <table width="100%" border="0">
     <tr><ul class="test">'.$list_sub.'</ul></tr>
   </table>
     <p>&nbsp;</p>';
        return $content;
    }

     function ListTest($id) {
        global $db,$err,$sec;
        $id=$sec->ClearInt($id,'Параметр задан неверно');
        $sub_query=$db->query('SELECT * FROM nametest WHERE `subject` ="'.$id.'" AND `delete` != "2"','Тестов не нашлось');
        
        while($subject=$db->fetch_array($sub_query)) {
            $list_sub.='<li class="sub"><a href="test.php?sec=edit&cat=test&id='.$subject['id'].'">'.$subject['title'].'</a> <a href="test.php?sec=edit&cat=nametest&id='.$subject['id'].'" style="font-size: 14px; color: #CD1B1B; margin-bottom: 3px;">(изменить)</a> <a href="test.php?act=deltest&id='.$subject['id'].'" style="font-size: 14px; color: #CD1B1B; margin-bottom: 3px;">(удалить)</a></li>';
        }
        $content='<div class="headi" style="margin: 10px 10px 0 10px; height: 10px;">Список тестов     </div>
   <table width="100%" border="0">
 <tr><span style="color: #323232; font-size: 14px; margin-left: 10px"><a href="test.php?sec=add&sid='.$id.'" style="color: #69C">(добавить тест)</a></span></tr>     
<tr><ul class="test">
         '.$list_sub.'
         </ul>
    </tr>
   </table>';
        return $content;
    }
    
    function TestId($id) {
        global $db,$err,$sec,$other;
        $id=$sec->ClearInt($id,'Параметр задан неверно');
        
        $quest=$db->query('SELECT * FROM question WHERE `test`="'.$id.'" AND `delete` != "2"','Вопросов нет, но вы можете <a href="test.php?sec=add&cat=question&ret&id='.$id.'" style="color: #2D76B9;">добавить</a> их в любое время');
        $sub=$db->query('SELECT * FROM nametest WHERE id="'.$id.'" LIMIT 1',false,true);
        while($subject=$db->fetch_array($quest)) {
            $list_sub.='<li class="editable"><a href="test.php?sec=edit&cat=answer&id='.$subject['id'].'">'.stripslashes($subject['ask']).'</a> <a href="test.php?act=delquest&id='.$subject['id'].'" style="color: #CD1B1B; ">(удалить)</a></li>';
        }
        $i=40;
        if (strlen($sub['title']) > $i) {
            $sub['title']=substr($sub['title'], 0, $i).'...';
        }
        $content='
   <div class="headi" style="margin: 10px 10px 0 10px; height: 10px;">'.$other->time->rulesTime($db->num_rows($quest),array('вопрос','вопроса','вопросов')).' к тесту "'.$sub['title'].'"</div>  
   <table width="100%" border="0">
   <tr><span style="color: #323232; font-size: 14px; margin-left: 10px"> <a href="test.php?sec=edit&cat=nametest&id='.$sub['id'].'" style="color: #69C">(изменить)</a>&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="test.php?sec=add&cat=question&ret&id='.$sub['id'].'" style="color: #69C">(добавить вопрос)</a></span></tr>
     <tr>'.$descr_err.'<ul class="test">
         '.$list_sub.'
         </ul>
    </tr>
   </table>';
        return $content;
    }
    function NameTest($id) {
        global $db,$err,$sec;
        $id=$sec->ClearInt($id,'Параметр задан неверно');

            $sub=$db->query('SELECT * FROM nametest WHERE `id`="'.$id.'" AND `delete` != "2" LIMIT 1','Тест не нашелся',true);
            $sub_query=$db->query('SELECT * FROM subject','Произошла ошибка в выборке предметов');
           
            while($subject=$db->fetch_array($sub_query)) {
                $list_sub.='<option value="'.$subject['id'].'" '.($subject['id']==$sub['subject'] ? 'selected' : '').' >'.$subject['title'].'</option>';
            }
            $content='<form action="test.php?act=editest&id='.$sub['id'].'" method="post">
           <div class="headi" style="margin: 10px;">Редактирование теста <a href="test.php?sec=edit&cat=test&id='.$sub['id'].'">(назад)</a>    </div>
           <table width="100%" border="0">
             <tr>
                 <td width="26%" class="ListTableLeftBar">Тема теста</td>
                 <td width="74%"><input name="title" type="text" style="width: 400px" maxlength="150" value="'.stripslashes($sub['title']).'" />&nbsp;</td>
               </tr>
               <tr>
                 <td class="ListTableLeftBar">Предмет</td>
                 <td><select name="subject">'.$list_sub.'</select></td>
               </tr>
               <tr>
                 <td class="ListTableLeftBar">Будет ли показываться?</td>
                 <td><input name="status" type="checkbox" value="2" '.($sub['status']=='2' ? 'checked="checked"' : '').'/>&nbsp;</td>
               </tr>
               <tr>
                 <td class="ListTableLeftBar">&nbsp;</td>
                 <td><input name="ok" type="submit" value="Обновить" />&nbsp;</td>
               </tr>
           </table>
             <p>&nbsp;</p>

           </form>';
        return $content;
    }
    function EditQuestion($id) {
        global $db,$err,$sec;
        $id=$sec->ClearInt($id,'Пустой id');
        
        $arr_quest=$db->query('SELECT * FROM question WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого вопроса не нашлось',true);
        $this->test['id'] = $id;
        switch ($arr_quest['type']) {
            case '1':
                return $this->EditQuestionType1($id,$arr_quest);
                break;
            case '2':
                return $this->EditQuestionType2($id,$arr_quest);
                break;
            default:
                break;
        }
    }
    function EditQuestionType1($id,$arr_quest) {
        global $db,$err;
        require 'engine/classes/file.class.php';
        $i = 0;
        $query_ans=$db->query('SELECT * FROM answers WHERE question='.$id.'');
        while($arr=$db->fetch_array($query_ans)) {
            $i++;
            $answers.='<div class="answer" id="input'.$i.'"><input name="ok'.$i.'" '.($arr['correct']==2 ? 'checked="checked"' : '').' value="2"  type="checkbox" class="big_checkbox" /><input name="answer'.$i.'" type="text" value="'.$arr['title'].'" class="big_input" style="width: 400px" /><input type="hidden" name="answerid'.$i.'" value="'.$arr['id'].'"></div>';
        }
        $content='<script type="text/javascript">var i='.$i.', test_id = '.$arr_quest['test'].', uid = "";</script>';
        $content.='
   <div class="headi" style="margin: 10px 0 0 10px;">Редактирование ответов к вопросу "'.stripslashes($arr_quest['ask']).'" <a href="test.php?sec=edit&cat=test&id='.$arr_quest['test'].'">(назад)</a>   </div>
   <div style="margin-left: 10px;">
        <form action="test.php?act=editquest&id='.$arr_quest['id'].'&type=1" method="post">
  <div class="table">
       <div class="left">
           <h1 class="head">Вопрос</h1>
           <div class="table_text"> 
               <textarea name="title" class="big_input textArea" id="TitleTextarea" style="width: 470px; min-height: 50px; overflow: hidden; " />'.stripslashes($arr_quest['ask']).'</textarea>
               <div class="textAreanone" style=""></div>
           </div>
           <div class="table_input" style="width: 300px; text-align: left">Изображение (не обязательно)</div>
           <div class="dropbox_top">&nbsp;</div>
           <div class="file_upload" id="dropbox">
                        '.$file->ListFile($arr_quest).'
			
           <input type="hidden" name="count_files" value="'.$file->count.'" id="count_files">
           </div>
       </div>     
       <div class="right_bar">
           <h1 class="head" style="-moz-user-select: none; -webkit-user-select: none; ">Варианты ответа <span class="hint" ><span id="addans" class="addansact" style="color: #69C;">добавить</span> | <span id="delans">удалить</span> </span></h1>
            <div class="hint" style="margin: 0 0 10px 10px;">Поставьте галочку рядом с ответом, который правильный.</div>
'.$answers.'    
    </div>
    <table width="100%" border="0" style="margin-top: 40px;">
       <tr>
         <td width="325px" align="right" class="ListTableLeftBar">&nbsp;</td>
         <td><input type="hidden" name="number" id="valans" value="'.$i.'"><input type="hidden" name="id" value="'.$arr_quest['id'].'"><input name="ok" type="submit" value="Обновить вопрос" /> &nbsp;</td>
       </tr>
   </table>
   </div>
     

   </form>

   </div>
   ';
        return $content;
    }
    function EditQuestionType2($id,$arr_quest) {
        global $db,$err;
        $arr=$db->query('SELECT * FROM answers WHERE question='.$id.' LIMIT 1',false,true);
        
        $content.='<form action="test.php?act=editquest&id='.$arr_quest['id'].'&type=2" method="post">
   <div class="headi" style="margin: 10px 0 0 10px;">Редактирование ответов к вопросу "'.stripslashes($arr_quest['ask']).'" <a href="test.php?sec=edit&cat=test&id='.$arr_quest['test'].'">(назад)</a>   </div>
   <div class="hint" style="margin: 0 0 10px 10px;">Поставьте галочку рядом с ответом, который правильный.</div>
   <table width="100%" border="0" id="table">
     <tr>
         <td width="26%" align="right" class="ListTableLeftBar">Вопрос:</td>
         <td width="74%"><input name="title" type="text" style="width: 400px" value="'.stripslashes($arr_quest['ask']).'" />&nbsp;</td>
       </tr>
       <tr id="input"><td align="right" class="ListTableLeftBar" >Ответ:</td><td><input type="text" style="width: 400px;" name="answer" maxlength="255" value="'.$arr['title'].'" /></td></tr>
   </table>
     <table width="100%" border="0" style="margin-top: 30px;">
       <tr>
         <td width="225px" align="right" class="ListTableLeftBar">&nbsp;</td>
         <td><input type="hidden" name="id" value="'.$arr_quest['id'].'"><input name="ok" type="submit" value="Обновить вопрос" /> &nbsp;</td>
       </tr>
   </table>

   </form>';
        return $content;
    }
    function EditQuest($id) {
        global $err,$sec,$db;
        $id=$sec->ClearInt($id);
        if($id != $_POST['id']) {
            return $err->GNC('Конфликт параметров');
        }
        $arr_quest=$db->query('SELECT * FROM question WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого вопроса не нашлось',true);
        $type=$sec->ClearInt($_GET['type']);
        switch ($type) {
            case '1':
                return $this->EditQuestType1($arr_quest);
                break;
            case '2':
                return $this->EditQuestType2($id);
                break;
               
            default:
                exit('Hacker?');
                break;
        }
    }
    /* 2 стадия */
    function EditQuestType1($array) {
        global $db,$sec,$err;
        /* Параметр предназначенный для передачи файлов */
        $this->id = $array['id'];
        $this->test_id = $array['test'];
        $num=$sec->ClearInt($_POST['number'],'Security breach');
        $title=$sec->filter($_POST['title'],false,'Заголовок теста не заполнен');
        
        if ($num > 8) {
            return $err->GNC('Security breach 1');
        }
        $file=$this->addFile(json_decode($array['code']));
        $db->query("UPDATE question SET ask='{$title}', code='{$file}' WHERE id={$this->id} ");
        
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
        
        $db->query('DELETE FROM answers WHERE question='.$this->id.' AND ('.$ids.')');
        return $sec->head('test.php?sec=edit&cat=answer&m=1&id='.$this->id);
    }
    function EditQuestType2($id) {
        global $db,$sec,$err;
        $title=$sec->filter($_POST['title'],false,'Заголовок теста не заполнен');
        $input=strtolower($sec->filter($_POST['answer'],255,'Ответ не заполнен'));       
        
        $db->query('UPDATE question SET ask="'.$title.'" WHERE id='.$id.'');
        $test_query=$db->query('UPDATE answers SET title="'.$input.'" WHERE question='.$id.'');
        
        if ($test_query != true) {
               return $sec->head('test.php?sec=edit&cat=answer&m=4&id='.$id);
            }
        return $sec->head('test.php?sec=edit&cat=answer&m=1&id='.$id);
    }
    function EditTest ($id) {
        global $sec,$err,$db,$mainclass;
        $id=$sec->ClearInt($id,'id теста неверен');
        
        $query_for_test=$db->query('SELECT id FROM nametest WHERE `id`='.$id.' AND `delete` != "2"','Тест не нашелся');

        $title=$sec->filter($_POST['title'],150,'Заголовок теста не заполнен');
        $subject=$sec->ClearInt($_POST['subject'],'Предмет не указан');
        $status=($_POST['status'] == '2' ? (int)$_POST['status'] : '1');
        
        $test_subject=$db->query('SELECT id FROM subject WHERE id="'.$subject.'"','id предмета неверен');
        
        $db->query('UPDATE nametest SET title="'.$title.'", subject="'.$subject.'", status="'.$status.'" WHERE id='.$id.'');
        return $sec->head('test.php?sec=edit&cat=test&id='.$id.'&m=1');
    }
}
$test=new test;
?>