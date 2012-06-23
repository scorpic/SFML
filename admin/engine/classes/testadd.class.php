<?php
/**
 * Description of test
 *
 * @author Дмитрий
 */
require('other/other.class.php');
class test extends someFunction {
    private $type_watch=false;
    function AddTest() {
        global $sec,$err,$db,$mainclass;
        $title=$sec->filter($_POST['title'],255,'Вы забыли ввести заголовок');
        $subject=$sec->ClearInt($_POST['subject'],'Предмет не заполнен');
        $status=((int)$_POST['status']==2) ? '2' : '1';

        $test_subject=$db->query('SELECT id FROM subject WHERE id="'.$subject.'"','id теста неверен');
        $db->query('INSERT INTO nametest (`title`,`subject`,`status`,`user`) VALUES ("'.$title.'","'.$subject.'","'.$status.'","'.$mainclass->user['id'].'")');

        return $sec->head('test.php?sec=add&cat=question&id='.mysql_insert_id().'&m=6');
    }

    function AddTestWrite() {
        global $db,$err,$sec;
            $sub_query=$db->query('SELECT * FROM subject ORDER BY title','Произошла ошибка в выборке предметов');
            $sid = $sec->ClearInt($_GET['sid']);

            while($subject=$db->fetch_array($sub_query)) {
                $list_sub.='<option value="'.$subject['id'].'" '.($subject['id'] == $sid ? 'selected' : '').'>'.$subject['title'].'</option>';
            }
            $content='<form action="test.php?act=addtest" method="post">
   <div class="headi" style="margin: 10px;">Добавление теста     </div>
   <table width="100%" border="0">
     <tr>
         <td width="26%" class="ListTableLeftBar">Тема теста</td>
         <td width="74%"><input name="title" type="text" style="width: 400px" maxlength="150" />&nbsp;</td>
       </tr>
       <tr>
         <td class="ListTableLeftBar">Предмет</td>
         <td><select name="subject">'.$list_sub.'</select></td>
       </tr>
       <tr>
         <td class="ListTableLeftBar">Будет ли показываться?</td>
         <td><input name="status" type="checkbox" value="2" />&nbsp;</td>
       </tr>
       <tr>
         <td class="ListTableLeftBar">&nbsp;</td>
         <td><input name="ok" type="submit" value="Сохранить" />&nbsp;</td>
       </tr>
   </table>
     <p>&nbsp;</p>

   </form>';
        return $content;
    }

    function AddQuestion($id,$message=false,$number_quest=2,$array=false) {
        global $db,$err,$sec,$m;
        $id=$sec->ClearInt($id,'Пустой id');
        /* Выводим сообщение, если это нужно */
        if($message) {
            $mes=$m->GetError($message);
        }
        /* Проверка на существование теста */
        $arr=$db->query('SELECT id,title FROM nametest WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого теста не нашлось',true);

        $i=20;
        if (strlen($arr['title']) > $i) {
            $arr['title']=substr($arr['title'], 0, $i).'...';
        }
        if(isset($_GET['ret'])) {
            $arr['from_edit']=true;
            $arr['link']='&ret=from_edit';
        }
        /* Создаем уникальный индентификатор */
        $arr['uid'] = uniqid();

        if($array) {
            $a=1;
            $this->type_watch=true;
            foreach($array as $k=>$v) {
                $arr_td.=$this->Tr($v[0], $v[1], $a);
                $a++;
            }
        } else {
            $arr_td.=$this->Tr('',false,1);
            $arr_td.=$this->Tr('',false,2);
        }
         return $this->TemplateQuestion($arr,$mes,$number_quest,$arr_td);
    }
    function AddQuestionSecond($id) {
        global $err;
        $type=(int)$_GET['type'];

        if(empty($id)) {
            return $err->GNC('Пустой id');
        }
        switch ($type) {
            case '1':
                return $this->AddQuestionSecondType1($id);
                break;
            case '2':
                $this->AddQuestionSecondType2($id);
                break;
            default:
                return $err->GNC('Тип вопроса не указан');
                break;
        }

    }
    function AddQuestionSecondType1($id) {
        global $db,$err,$sec;
        $this->test_id = $id;
        $query=$db->query('SELECT title FROM nametest WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого теста не нашлось');
        
        $title=$sec->filter($_POST['title'],false,'Вы случайно не забыли ввести название?');
        $number=$sec->ClearInt($_POST['number'],'Security breach 1');
        
        if($number > 8) {
            return $err->GNC('Security breach 2');
        }
        /* Проверим реальное количество ответов */
        $array_answers = $this->RealCountAnswers($number);

        /* Проверяем, есть ли в ответах правильный ответ */
        if (!$this->isIssetTrueAnswer($array_answers)) {
            return $err->GNC('Вы не указали правильный ответ');
        }

        $link=$this->pasteLink();
        $file=$this->addFile();

        $db->query("INSERT INTO question (ask,type,test,code,ball) VALUES ('$title',1,$id,'{$file}',0)");
        $last_id=mysql_insert_id();

        foreach($array_answers as $k => $v) {
            $db->query('INSERT INTO answers (title,question,correct,ball) VALUES ("'.$v['input'].'",'.$last_id.','.$v['check'].',1)');
        }

        if ($_POST['answers_next'] == '2')
            return $this->AddQuestion($id,5,count($array_answers),$array_answers);
        else
            return $sec->head('test.php?sec=add&cat=question'.$link.'&id='.$id.'&m=5');


    }

    function AddQuestionSecondType2($id) {
        global $db,$err,$sec;

        $query=$db->query('SELECT title FROM nametest WHERE `id`='.$id.' AND `delete` != "2" LIMIT 1','Такого теста не нашлось');

        $title=$sec->filter($_POST['title'],false,'Вы случайно не забыли ввести название?');
        $input=strtolower($sec->filter($_POST['answer'],255,'Поле Ответ не заполнен'));

        $link=$this->pasteLink();

        $db->query('INSERT INTO question (ask,type,test,ball) VALUES ("'.$title.'",2,'.$id.',0)');
        $last_id=mysql_insert_id();


        $db->query('INSERT INTO answers (title,question,correct,ball) VALUES ("'.$input.'",'.$last_id.',1,1)');

        return $sec->head('test.php?sec=add&cat=question'.$link.'&id='.$id.'&m=5&ret');
    }
    function Tr($input='',$check=false,$i) {
        return '<div class="answer" id="input'.$i.'"><input type="checkbox" name="ok'.$i.'" '.($check=='2' ? 'checked' : '').' value="2" class="big_checkbox" /><input name="answer'.$i.'" type="text" value="'.stripslashes($input).'" class="big_input" style="width: 400px" /></div>';
    }
    // Функция для вывода строки с заглавием и input
    function askHTML() {
        return '<tr>
         <td width="25%" align="right" class="ListTableLeftBar">Вопрос:</td>
         <td width="75%"><input name="title" type="text" style="width: 400px" /></td>
       </tr>';
    }
    function TemplateQuestion($arr,$m='',$i=2,$answers) {
        
        return $m.'<script type="text/javascript">var i = '.$i.', test_id = '.$arr['id'].', uid = "'.$arr['uid'].'";</script>
        <div class="headi" style="margin: 10px 0 0 10px;">Добавление вопросов к тесту на тему "'.$arr['title'].'" '.($arr['from_edit']==true ? '<a href="test.php?sec=edit&cat=test&id='.$arr['id'].'">(назад)</a>' : '').'</div>
        
        <div class="toogle'.($this->type_watch ? ' on' : '').'" to="groups_input_type_1">Добавить вопрос с возможностью выбора нескольких ответов (первый тип)</div>
        <div id="groups_input_type_1" style="'.($this->type_watch ? '' : 'display: none').'">
        <div style="margin-left: 10px;">
            <form action="test.php?act=addquestion&ret=from_edit&id='.$arr['id'].'&type=1" method="post">
    <div class="table">
        <div class="left">
            <h1 class="head">Вопрос</h1>
            <div class="table_text"> 
                <textarea name="title" class="big_input textArea" id="TitleTextarea" style="width: 465px; min-height: 50px; overflow: hidden; " /></textarea>
                <div class="textAreanone"></div>
                <div class="table_input" style="width: 300px; text-align: left">Изображение (не обязательно)</div>
                <div class="dropbox_top">&nbsp;</div>
                <div class="file_upload" id="dropbox">
                <span class="message">
                    Перенесите изображения сюда. <br />
                    <i>(они сразу же появятся в тесте)</i>
                </span>
                
                <input type="hidden" name="count_files" value="0" id="count_files">
            </div>
        </div>
        <div class="right_bar">
            <h1 class="head" style="-moz-user-select: none; -webkit-user-select: none; ">Варианты ответа <span class="hint" ><span id="addans" class="addansact" style="color: #69C;">добавить</span> | <span id="delans">удалить</span> </span></h1>
                <div class="hint" style="margin: 0 0 10px 10px;">Поставьте галочку рядом с ответом, который правильный.</div>
    '.$answers.'
        </div>
        <table width="100%" border="0" style="margin-top: 30px;">
        <tr>
            <td width="225px" align="right" class="ListTableLeftBar"><input type="checkbox" name="answers_next" value="2" '.($this->type_watch ? 'checked' : '').'>Оставить ответы</td>
            <td><input type="hidden" name="number" id="valans" value="'.$i.'"><input name="ok" type="submit" value="Сохранить и добавить еще один вопрос" /> &nbsp;</td>
        </tr>
    </table>
    </div>


   </form>

   </div>
   </div>
   <div class="toogle" to="groups_input_type_2" style="margin-top: 20px;">Добавить вопрос с возможностью заполнения ответа с клавиатуры (второй тип)</div>
   <div id="groups_input_type_2" style="display: none;">
      <form action="test.php?act=addquestion'.$arr['link'].'&id='.$arr['id'].'&type=2&ret" method="post">
   <table width="100%" border="0" id="table">
    '.$this->askHTML().'
       <tr style="-moz-user-select: none; -webkit-user-select: none; ">
         <td align="right" class="ListTableLeftBar" >Ответ:<br /></td>
         <td><input type="text" style="width: 400px" name="answer" maxlength="255" /></td>
       </tr>

   </table>
     <table width="100%" border="0" style="margin-top: 30px;">
       <tr>
         <td width="225px" align="right" class="ListTableLeftBar">&nbsp;</td>
         <td><input type="hidden" name="id" value="'.$arr['id'].'"><input name="ok" type="submit" value="Сохранить и добавить еще один вопрос" /> &nbsp;</td>
       </tr>
   </table>

   </form>
   </div>';
    }
}
$test=new test;
?>