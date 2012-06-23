<?php

require '../admin/header.php';

class mainclassAdmin {
    public  $user = array(),
            $section;

    function Login($to = 'index.php') {
        global $db, $sec;
        $to = $sec->notLink(urldecode($to));
        if (empty($to)) {
            $to = 'index.php';
        }
        $login = strtolower($sec->filter($_POST['login'], 25));
        $pass = $sec->filter($_POST['pass'], 25);

        $admin = $db->query('SELECT id,pass FROM user WHERE login="' . $login . '" LIMIT 1');
        if ($db->num_rows($admin) == 0) {
            return false;
        }
        $admin = $db->fetch_array($admin);
        if ($admin['pass'] == $sec->salt($pass)) {
            setcookie('id', $admin['id'], time() + 3600);
            setcookie('pass', $admin['pass'], time() + 3600);
            $sec->head($to);
        }
        return false;
    }

    /*
     * НОВАЯ ФУНКЦИЯ!!!!
     * Функция предназначена для проверки правильно ли зашел пользователь
     */

    public function isAdmin() {
        global $sec, $db;
        if ($this->isIssetCookie()) {
            $query = $db->query('SELECT * FROM user WHERE id=' . $this->user['id'] . '');
            if ($db->num_rows($query) == 1) {
                $user = $db->fetch_array($query);

                if ($user['pass'] == $this->user['pass']) {
                    $this->user = $user;
                    $this->UpdateLastVisit();
                    return true;
                } else {
                    $sec->ClearCookie();

                    $sec->head('login.php?from=' . urlencode($_SERVER['REQUEST_URI']));
                }
            } else {
                $sec->ClearCookie();
                $sec->head('login.php?from=' . urlencode($_SERVER['REQUEST_URI']));
            }
        } else {
            $sec->ClearCookie();
            $sec->head('login.php?from=' . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    function LogOut() {
        global $sec;
        $sec->ClearCookie();
    }

    function UpdateLastVisit() {
        global $db;
        $db->query('UPDATE user SET lastvisit="' . time() . '" WHERE id = "' . $this->user['id'] . '"');
    }
    
    public function LoadCategory($file) {
        global $array_section,$sec;
        
        $section = $sec->filter($_GET['sec']);
        $category = ucfirst($sec->filter($_GET['cat']));
        $func = $file.$category;
        
        if (!empty($array_section['second'][$section])) {
            $this->section = $array_section['second'][$section];
        }
        else {
            $this->section = $array_section['main'];
        }
        
        require PATH.'engine/classes/'.$file.'/'.$this->section.'.class.php';

        $module = new $this->section;
        
        
        if(method_exists($this->section, $func)) {
            $this->tmpName = $this->section.$category;
            return $module->$func();
        }
        $this->tmpName = $this->section.'Main';
        $func = $file.'Main';
        return $module->$func();
    }
    
    function LoadMessage() {
        global $tmp;
        $tmp->setVar('message','');
        if (isset($_GET['m'])) {
            require PATH.'engine/classes/message.class.php';
            $tmp->setVar('message',$m->GetError($_GET['m']));
            $tmp->setJS(array('bouncebox','message'));
        }
        
    }
    
    function isIssetCookie() {
        global $sec;
        if ($sec->filter($_COOKIE['id']) && $sec->filter($_COOKIE['pass'])) {
            $this->user['id'] = $sec->ClearInt($_COOKIE['id']);
            $this->user['pass'] = $sec->filter($_COOKIE['pass']);
            return true;
        }
        else
            return false;
    }

    function SetTestMode() {
        global $sec;
        if ($this->user['priv'] == 1) {
            if ($sec->Settings()) {
                return '<a href="?test_mode=on">Включить</a>';
            }
            return '<a href="?test_mode=off">Выключить</a>';
        }
        return '';
    }

    function setSettings() {
        global $db;
        if (!empty($_GET['test_mode']) and $this->user['priv'] == 1) {
            $var = $_GET['test_mode'] == 'on' ? '2' : '1';
            $db->query('UPDATE settings SET value="' . $var . '" WHERE cat = "test_mode"');
        }
        return false;
    }

    function testLogin($login) {
        global $db;
        $test = $db->query('SELECT id FROM user WHERE login="' . $login . '"');
        if ($db->num_rows($test) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function testMail($mail) {
        global $db;
        $test = $db->query('SELECT id FROM user WHERE mail="' . $mail . '"');
        if ($db->num_rows($test) > 0) {
            return true;
        } else {
            return false;
        }
    }
    function AssetsUser($priv = array(), $noerror = false) {
        foreach ($priv as $k) {
            if ($this->user['priv'] == $k)
                return true;
        }
        if ($noerror) {
                return false;
        }
        exit('У вас не хватает прав на выполнение данного действия');
    }

    /*
     * Функция для вывода табличек (как в Windows Metro)
     * Цвета:
     * 1 - красный цвет
     * 2 - зеленый цвет
     *
     */

    function Tablets($title, $link, $color = '0') {
        switch ($color) {
            case '1':
                $col = '#ec110d';
                break;
            case '2':
                $col = '#f5c228';
                break;
            case '3':
                $col = '#1fa1df';
                break;
            default:
                $col = '#6bb32d';
                break;
        }
        return '<a href="'.$link.'"><div class="MainList" style="background-color: '.$col.';"><div>'.$title.'</div></div></a>';
    }

    function HelloUser($str) {
        $time = time();
        $date = date('G', $time);
        $arr_day = array('Почему не спим', 'Доброе утро', 'Добрый день', 'Добрый вечер');
        if ($date < 7) {
            $s = $arr_day[0];
        } else if ($date < 11) {
            $s = $arr_day[1];
        } else if ($date < 18) {
            $s = $arr_day[2];
        } else {
            $s = $arr_day[3];
        }
        return $s . ', ' . $str;
    }

}

$mainclass = new mainclassAdmin();
?>
