<?php

require('other/other.class.php');

class test extends someFunction {

    public
    $test = array();

    function ListSubject() {
        global $db, $err;
        $sub_query = $db->query('SELECT * FROM subject ORDER BY title', 'Произошла ошибка в выборке предметов');
        while ($subject = $db->fetch_array($sub_query)) {
            $list_sub.='<li class="sub"><a href="answer.php?cat=list&sid=' . $subject['id'] . '">' . $subject['title'] . '</a></li>';
        }
        $content = '<div class="headi" style="margin: 10px 10px 0 10px; height: 10px;">Список предметов     </div>
   <table width="100%" border="0">
     <tr><ul class="test">' . $list_sub . '</ul></tr>
   </table>
     <p>&nbsp;</p>';
        return $content;
    }

    function ListTest($id) {
        global $db, $err, $sec;
        $id = $sec->ClearInt($id, 'Параметр задан неверно');
        $sub_query = $db->query('SELECT * FROM nametest WHERE `subject` ="' . $id . '" AND `delete` != "2"', 'Тестов не нашлось');

        while ($subject = $db->fetch_array($sub_query)) {
            $list_sub.='<li class="sub"><a href="answer.php?cat=test&id=' . $subject['id'] . '">' . $subject['title'] . '</a></li>';
        }
        $content = '<div class="headi" style="margin: 10px 10px 0 10px; height: 10px;">Список тестов     </div>
   <table width="100%" border="0">
    <tr><ul class="test">
         ' . $list_sub . '
         </ul>
    </tr>
   </table>';
        return $content;
    }

    function TestId($id) {
        global $db, $err, $sec, $other;
        $id = $sec->ClearInt($id, 'Параметр задан неверно');

        $quest = $db->query('SELECT q.ask, q.type, a.title FROM question AS q INNER JOIN answers AS a ON q.id = a.question WHERE q.test = "' . $id . '" AND q.delete != "2" AND a.correct = "2"', 'Вопросов нет, но вы можете <a href="test.php?sec=add&cat=question&ret&id=' . $id . '" style="color: #2D76B9;">добавить</a> их в любое время');

        while ($inArray = $db->fetch_array($quest)) {
            $array[ $inArray['title'] ][] = $inArray['ask'];
            $count++;
        }

        $sub=$db->query('SELECT * FROM nametest WHERE id="'.$id.'" LIMIT 1',false,true);
        $i = 40;
        if (strlen($sub['title']) > $i) {
            $sub['title'] = substr($sub['title'], 0, $i) . '...';
        }

        if (count($array) <= 9 && $count >= 8) {
            foreach ($array as $key => $value) {
                $html .= '
                    <div class="cat" style="margin-top: 8px; font-size: 16px;">
                        '.$key.'
                    </div>';
                foreach ($value as $k => $v) {
                    $html .= '
                        <span style="font-size: 16px; margin-left: 10px; ">
                           '.stripslashes($v).'
                        </span>
                        </br>
                        ';
                }
            }
        }
        else {
            foreach ($array as $key => $value) {
                foreach ($value as $k => $v) {
                    $html .= '
                        <span style="font-size: 16px; margin-left: 10px; ">
                           '.stripslashes($v).' <b>('.$key.')</b>
                        </span>
                        </br>
                        ';
                }
            }
        }

        $content = '
   <div class="headi" style="margin: 10px 10px 0 10px; height: 10px;">Ответы к тесту "' . $sub['title'] . '"</div>
   <ul class="test" style="width: 630px; padding: 0 10px 0 10px;" >
        '.$html.'
   </ul>
           ';
        return $content;
    }

}

$test = new test;
?>