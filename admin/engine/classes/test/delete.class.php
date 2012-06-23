<?php
class delete {
    
    public function testQuestion() {
        global $db,$sec,$err;
        $id=$sec->ClearInt($_GET['id'],'Параметр id не задан');

        $question=$db->query('SELECT id,test FROM question WHERE id='.$id.'','Такого вопроса не существует',true);

        $db->query('UPDATE `question` SET  `delete` =  2 WHERE  `id`="'.$id.'"');
        $answer_in_quest=$db->query('UPDATE `answers` SET `delete` = 2 WHERE `question`='.$id.'');
            
        return $sec->head('test.php?sec=edit&cat=list&id='.$question['test'].'&m=12');
    }
    
    public function testTest() {
        global $db,$sec,$err;
        $id = $sec->ClearInt($_GET['id'],'Параметр id не задан');

        $test_name=$db->query('SELECT id,subject FROM nametest WHERE id='.$id.'','Такого теста не существует',true);

        $db->query('UPDATE `nametest` SET  `delete` =  2 WHERE  `id` = "'.$id.'"');
        $question=$db->query('SELECT id FROM question WHERE test='.$id.'');
        if($db->num_rows($question) == 0) {
            return $sec->head('test.php?sec=edit&cat=subject&sid='.$test_name['subject'].'');
        }
        $row1=$db->fetch_array($question);
        $where_id.='`question` = '.$row1['id'];
        while($row=$db->fetch_array($question)) {
            $where_id.=' AND `question` = '.$row['id'];
        }

        $db->query('UPDATE `question` SET  `delete` =  2 WHERE  `test`="'.$id.'"');
        $answer_in_quest=$db->query('UPDATE `answers` SET `delete` = 2 WHERE '.$where_id.'');
        $sec->head('test.php?sec=edit&cat=Subject&sid='.$test_name['subject'].'&m=13');

    }
    
}
?>