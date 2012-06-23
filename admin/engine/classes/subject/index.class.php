<?php
class index {
    public
        $arrayText = array();
    function subjectMain() {
        global $db;
            $sub_query=$db->query('SELECT * FROM subject ORDER BY title','Произошла ошибка в выборке предметов');
            while($subject=$db->fetch_array($sub_query)) {
                $list_sub.='<li class="sub"><a href="subject.php?cat=sub&id='.$subject['id'].'">'.$subject['title'].'</a></li>';
            }
            $this->arrayText=array(
                'title' => 'Список предметов',
                'content' => '<tr><ul class="test">'.$list_sub.'</ul></tr>'
                );
    }
    function ListCategory($id) {
        global $db,$sec;
            $id = $sec->ClearInt($id,'Параметр задан неверно');
            $subject = $db->query('SELECT title FROM subject WHERE id = "'.$id.'"','Такого предмета не существеут',true);

            $query_cat = $db->query('SELECT id,title FROM subject_category WHERE subject = "'.$id.'"','Категорий в предмете не существует</br><a href="subject.php?cat=add_cat&sid='.$id.'" style="color: #2D76B9">Добавить</a>');
            while($cat = $db->fetch_array($query_cat)) {
                $html.='<li class="sub"><a href="subject.php?cat=edit_cat&id='.$cat['id'].'">'.$cat['title'].'</a></li>';
            }
            $this->arrayText = array(
                'title' => 'Список категорий',
                'menu' => array(
                        'Добавить категорию' => 'subject.php?cat=add_cat&sid='.$id
                    ),
                'content' => '<tr><ul class="test">'.$html.'</ul></tr>'
            );
    }
    function AddCategory($id) {
        global $db,$sec;
        if (isset($id)) {
            $id = $sec->ClearInt($id);
            $sub_query=$db->query('SELECT * FROM subject_category WHERE id='.$id.'','Произошла ошибка в выборке предметов',true);
            $sid = $sub_query['subject'];
            $title = $sub_query['title'];
            $act = 'edit_cat&id='.$id;
        }
        else {
            $act = 'add_cat';
            $sid = $sec->ClearInt($_GET['sid']);
        }
        $sub_query=$db->query('SELECT * FROM subject ORDER BY title','Произошла ошибка в выборке предметов');


            while($subject=$db->fetch_array($sub_query)) {
                $list_sub.="<option value='{$subject['id']}'".($subject['id'] == $sid ? ' selected' : '').">{$subject['title']}</option>\n";
            }
        $this->arrayText = array(
                'title' => 'Список категорий',
                'content' => '<form action="subject.php?act='.$act.'" method="post"><tr>
         <td width="26%" class="ListTableLeftBar">Категория:</td>
         <td width="74%"><input name="title" type="text" style="width: 400px" value="'.$title.'" maxlength="150" />&nbsp;</td>
       </tr>
       <tr>
         <td class="ListTableLeftBar">Предмет</td>
         <td><select name="subject">
                '.$list_sub.'
             </select></td>
       </tr>
       <tr>
         <td class="ListTableLeftBar">&nbsp;</td>
         <td><input name="ok" type="submit" value="Сохранить" />&nbsp;</td>
       </tr>
       <tr>
         <td class="ListTableLeftBar">&nbsp;</td>
         <td>&nbsp;</td>
       </tr>

</form>'
            );
    }
    function AddCat() {
        global $sec,$err,$db,$mainclass;
        $title=$sec->filter($_POST['title'],150,'Вы забыли ввести заголовок');
        $subject=$sec->ClearInt($_POST['subject'],'Предмет не выбран');

        $test_subject=$db->query('SELECT id FROM subject WHERE id="'.$subject.'"','id теста неверен');
        $db->query('INSERT INTO subject_category (`title`,`subject`) VALUES ("'.$title.'","'.$subject.'")');

        return $sec->head('subject.php?cat=sub&id='.$subject.'&m=6');
    }
    function EditCat($id) {
        global $sec,$err,$db,$mainclass;
        $id = $sec->ClearInt($id,'Пустой id');
        $title=$sec->filter($_POST['title'],150,'Вы забыли ввести заголовок');
        $subject=$sec->ClearInt($_POST['subject'],'Предмет не выбран');

        $db->query('SELECT id FROM subject_category WHERE id="'.$id.'"','Категории не существует');
        $db->query('SELECT id FROM subject WHERE id="'.$subject.'"','id теста неверен');
        $db->query('UPDATE subject_category SET `title` = "'.$title.'",`subject` = "'.$subject.'" WHERE id = '.$id.'');

        return $sec->head('subject.php?cat=sub&id='.$subject.'&m=1');
    }
}
?>
