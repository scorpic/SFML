<?php
class count {
    /*
     * Считаем количество тестов в базе, которые не удалены и не скрыты.
     */
    function countTestWrite() {
        global $db;
        $count = $db->query('SELECT COUNT(id) FROM nametest WHERE `status`=2 AND `delete` != "2"',false,true);
        return $count['COUNT(id)'];
    }
    /*
     * Количество администаторов в базе
     */
    function countAdmin() {
        global $db;
        $count = $db->query('SELECT COUNT(id) FROM user',false,true);
        return $count['COUNT(id)'];
    }
}

?>
