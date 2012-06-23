<?php

/*
 * @author Ìóêîâêèí Äìèòðèé
 */

class check_test {

    function charseTrue($str, $first = 'cp1251', $second = 'utf-8') {
        $str = iconv($first, $second, $str);
        if (!$str) {
            return 'error';
        }
        return $str;
    }

    /* Ïðîâåðêà òåñòà */

    function TestId($id) {
        global $db, $sec;
        $id = $sec->ClearInt($id, 'Security breach: id');
        $type = $sec->ClearInt($_GET['type'], 'Security breach: type');
        switch ($type) {
            case '1':
                $corr = $db->query('SELECT correct FROM answers WHERE id="' . $id . '"', 'empty');
                $c = $db->fetch_array($corr);
                if ($c['correct'] == '2') {
                    return 'true';
                } else {
                    return 'false';
                }
                break;
            case '2':
                //ïåðåâåäåì è êîäèðîâêó
                $value = $this->charseTrue($_POST['value'], 'utf-8', 'cp1251');
                // ò.ê. î÷èùàåì
                $value = $sec->filter($this->st2lower(trim($value)));

                // à òåïåðü çàùèòèìñÿ
                if (empty($value)) {
                    return 'empty_value';
                }
                $answer = $db->query('SELECT title FROM answers WHERE id="' . $id . '"');
                if ($db->num_rows($answer) == 0) {
                    return 'empty2';
                }
                $ans = $db->fetch_array($answer);
                $ans = $this->st2lower($ans['title']);
                if ($ans == $value) {
                    return 'true';
                }
                else
                    return 'false';
                break;
            default:
                return 'false';
                break;
        }
    }

    function st2lower($st) {
        return(strtolower(strtr($st, "ÀÁÂÃÄÅ¨ÆÇÈÉÊËÌHÎÐÏÑÒÓÔÕÖ×ØÙÚÜÛÝÞß", "àáâãäå¸æçèéêëìíîðïñòóôõö÷øùúüûýþÿ")));
    }

    function CountPlus() {
        global $db, $sec;
        $id = $sec->ClearInt($_POST['id'], 'Security breach: id');
        $query = $db->query('SELECT count_pass FROM nametest WHERE id = ' . $id . '', 'Òåñò íå íàéäåí', true);

        $db->query('UPDATE nametest SET count_pass = ' . ($query['count_pass'] + 1) . ' WHERE id = ' . $id . '');
    }

}

$c = new check_test;
?>
