<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author Дмитрий
 */
class test {
    function DelOneQuest($id) {
        global $db,$sec,$err;
        $id=$sec->ClearInt($id,'Параметр id не задан');

        $question=$db->query('SELECT id,test FROM question WHERE id='.$id.'','Такого вопроса не существует');
        $question=$db->fetch_array($question);
        $db->query('UPDATE `question` SET  `delete` =  2 WHERE  `id`="'.$id.'"');
        $answer_in_quest=$db->query('UPDATE `answers` SET `delete` = 2 WHERE `question`='.$id.'');
            
        return $sec->head('test.php?sec=edit&cat=test&id='.$question['test']);
    }
    function DelOneTest() {
        global $db,$sec,$err;
        
        $id = $sec->ClearInt($_GET['id'],'Параметр id не задан');

        $test_name=$db->query('SELECT id,subject FROM nametest WHERE id='.$id.'','Такого теста не существует');

     
        $test_name=$db->fetch_array($test_name);
        $db->query('UPDATE `nametest` SET  `delete` =  2 WHERE  `id`="'.$id.'"');
        $question=$db->query('SELECT id FROM question WHERE test='.$id.'');
        if($db->num_rows($question) == 0) {
            return $sec->head('test.php?sec=edit&cat=list&sid='.$test_name['subject'].'');
        }
        $row1=$db->fetch_array($question);
        $where_id.='`question` = '.$row1['id'];
        while($row=$db->fetch_array($question)) {
            $where_id.=' AND `question`='.$row['id'];
        }
        $question=$db->fetch_array($question);
        $db->query('UPDATE `question` SET  `delete` =  2 WHERE  `test`="'.$id.'"');
        $answer_in_quest=$db->query('UPDATE `answers` SET `delete` = 2 WHERE '.$where_id.'');
            $sec->head('test.php?sec=edit&cat=list&sid='.$test_name['subject'].'');
            return false;
    }
}
$test=new test;
?>