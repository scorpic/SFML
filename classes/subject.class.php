<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of subject
 *
 * @author Дмитрий
 */
class subject {
    function SubjectId($id) {
        global $sec, $db;
        $id=(int)$id;
        if(empty($id)) {
            $sec->head();
        }
        $subject=$db->query('SELECT title FROM subject WHERE id="'.$id.'" LIMIT 1');
        if($db->num_rows($subject) == 0) {
            $sec->head('../');
        }
        $subject=$db->fetch_array($subject);
        $s=$db->query('SELECT * FROM nametest WHERE `subject`="'.$id.'" AND `status`="2" AND `delete` !=2 ORDER BY title');
        if($db->num_rows($s) == 0) {
            $subject['text'].='<h2>Тесты не найдены</h2>';
        } else {
            $subject['text']='<ul class="unstyled">';
        while($arr=$db->fetch_array($s)) {
            $subject['text'].='<li class="sub"><h3><a href="test.php?id='.$arr['id'].'" style="color: #333">'.$arr['title'].'</a></h3></li>';
        }
        $subject['text'].='</ul>';
            
        }
        return $subject;
    }

    function SubjectList() {
        global $sec, $db;

        $subject=$db->query('SELECT n.id,n.title, s.title AS sub_title FROM nametest AS n INNER JOIN subject AS s ON n.subject=s.id WHERE n.status="2" AND n.delete!=2 ORDER BY id LIMIT 50');

        if($db->num_rows($subject) == 0) {
            $c='<h2>Тесты не найдены</h2>';
        } else {
            $c.='<ul class="unstyled">';
        while($arr=$db->fetch_array($subject)) {
            $c.='<li class="sub"><h3><a href="test.php?id='.$arr['id'].'" style="color: #333">'.$arr['title'].'</a></h3></li>';
        }
            $c.='</ul>';
        }
        return $c;
    }
}
$s=new subject;
?>
