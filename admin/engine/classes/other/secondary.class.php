<?php

/*
 * Класс предназначен для второстепенных функций, обслуживающие классы тестов
 */

/**
 * Description of secondary
 *
 * @author Дмитрий
 */
class secondary {
    function GetSubject() {
        global $db;
        $sub_query=$db->query('SELECT * FROM subject','Произошла ошибка в выборке предметов');

        while($subject=$db->fetch_array($sub_query)) {
        $list_sub.='<option value="'.$subject['id'].'">'.$subject['title'].'</option>';
        }
        return $list_sub;
    }
    function issetTest($id) {
        global $db;
            $query=$db->query('SELECT id FROM nametest WHERE id ='.$id.'');
            if ($db->num_rows($query) > 0) 
                return true;
            else
                return false;    
    }
}
$secondary=new secondary;
?>
