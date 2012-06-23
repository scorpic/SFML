<?php
class Security {
    function head($s='index.php') {
        header("Location: $s");
        exit();
    }
    /*
     * $l - длина строки
     */
    function filter($str,$l=false,$err_str=false) {
        global $err;
        if($err_str) {
            if (empty($str)) {
                $err->GNC($err_str);
            }
        }
        $str=mysql_real_escape_string(htmlspecialchars(trim($str), ENT_SUBSTITUTE, 'cp1251'));
        if($l) {
            $str=substr($str,0,$l);
        }
        return $str;
    }

    function ClearInt($number,$str=false) {
        global $tmp;
        $number=(int)$number;
        if (empty($number) && $str) {
            $tmp->GNC($str);
            exit();
        }
        return $number;
    }

    function notLink($link) {
        return str_replace('://', '', $link);
    }

    function salt($str) {
        $salt='abcmsfml';
        return md5($str.$salt);
    }

    function ClearCookie() {
	setcookie('id', '', time()-60);
	setcookie('pass', '', time()-60);
	return true;
    }
    function isMail($email)
    {
         return preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email));
    }
    function Settings() {
        global $db;
        $test_mode = $db->query('SELECT value FROM settings WHERE cat = "test_mode" LIMIT 1',false,true);
        if ($test_mode['value'] == '1') {
            return true;
        }
        return false;
    }

}
$sec=new Security();
?>
