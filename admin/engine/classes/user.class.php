<?php
/*
 * Description of test
 *
 * @author Дмитрий
 */
class user {
    function AddUser() {
        global $sec,$err,$db,$mainclass;
        $name=$sec->filter($_POST['name'],30,'Вы не заполнили поле имя');
        $surname=$sec->filter($_POST['surname'],30,'Вы не заполнили поле фамилия');
        $login=strtolower($sec->filter($_POST['login'],25, 'Вы не ввели логин'));
        $mail=strtolower($sec->filter($_POST['mail'],32, 'Вы не ввели e-mail'));
        $pass=$sec->filter($_POST['pass'],20,'Пароль не введен');

        if (!$sec->isMail($mail)) {
            return $err->GNC('E-mail не валидный');
        }

        if ($mainclass->testMail($mail)) {
            return $err->GNC('Такой e-mail уже зарегистрирован в системе');
        }

        if ($mainclass->testLogin($login)) {
            return $err->GNC('Такой логин уже существует');
        }
        $pass=$sec->salt($pass);
        $time = time();
        $db->query('INSERT INTO user (`name`,`surname`,`login`,`pass`,`priv`,lastvisit,registered) VALUES ("'.$name.'","'.$surname.'","'.$login.'","'.$pass.'","2","0","'.$time.'")');
        return $sec->head('user.php?m=7');
    }

    function EditUser($id) {
        global $sec,$err,$db,$mainclass;
        $user = $db->query('SELECT name, surname, login, mail FROM user WHERE id = '.$id.'','Пользователь не найден',true);
        $name=$sec->filter($_POST['name'],30,'Вы не заполнили поле имя');
        $surname=$sec->filter($_POST['surname'],30,'Вы не заполнили поле фамилия');
        $login=strtolower($sec->filter($_POST['login'],25, 'Вы не ввели логин'));
        $mail=strtolower($sec->filter($_POST['mail'],32));
        $pass=$sec->filter($_POST['pass'],20);
        if (!empty($pass)) {
            $pass=$sec->salt($pass);
            $pass_query=',pass="'.$pass.'"';
        }

        if (!$sec->isMail($mail)) {
            return $err->GNC('E-mail не валидный');
        }

        if ($user['mail'] != $mail && $mainclass->testMail($mail)) {
            return $err->GNC('Такой e-mail уже зарегистрирован в системе');
        }

        if ($user['login'] != $login && $mainclass->testLogin($login) ) {
            return $err->GNC('Такой логин уже существует');
        }

        $db->query('UPDATE user SET name="'.$name.'", surname="'.$surname.'", login="'.$login.'", mail="'.$mail.'" '.$pass_query.' WHERE id = '.$id.'');
        return $sec->head('user.php?m=8');
    }

    function userEdit($id) {
        global $db,$tmp;
        $query = $db->query('SELECT id, name, surname, login, mail FROM user WHERE id = '.$id.'','Ошибка выборки базы данных',true);
        $tmp->setVar('name',$query['name']);
        $tmp->setVar('id',$query['id']);
        $tmp->setVar('surname',$query['surname']);
        $tmp->setVar('login',$query['login']);
        $tmp->setVar('mail',$query['mail']);
    }

    function DeleteUser($id) {
        global $db,$sec;
        $db->query('DELETE FROM user WHERE id = '.$id.'');
        return $sec->head('user.php?m=9');
    }

    function adminsList() {
        global $db;
        $query=$db->query('SELECT id,name,surname FROM user ORDER BY id','Произошла ошибка в выборке администраторов');
        while($admin=$db->fetch_array($query)) {
            $list_sub.='<li class="sub"><a href="user.php?sec=profile&id='.$admin['id'].'">'.$admin['surname'].' '.$admin['name'].'</a></li>';
        }
        return $list_sub;
    }

    function Profile($id) {
        global $db;
        $query=$db->query('SELECT id,name,surname,lastvisit, login, priv FROM user WHERE id = '.$id.'','Произошла ошибка в выборке администратора',true);
        return $query;
    }

    function ListAddTests ($id) {
        global $db;
        $query=$db->query('SELECT n.id,n.title,n.delete,s.id AS sid, s.title AS subject FROM nametest AS n INNER JOIN subject AS s ON n.subject = s.id WHERE n.user = '.$id.' ORDER BY s.title ');
        if ($db->num_rows($query) == 0) {
            return 'Администратор ничего не добавил';
        }
        while($admin=$db->fetch_array($query)) {
            $ListTest[$admin['subject']][] = $admin;
            $list_sub.='<li class="sub"><a href="user.php?sec=profile&id='.$admin['id'].'">'.$admin['title'].' ('.$admin['subject'].')</a></li>';
        }

        foreach ($ListTest as $k => $v) {
            $list_sub1.='<div class="cat" style="margin-top: 8px; font-size: 16px;"><a href="test.php?sec=edit&cat=list&sid='.$v[0]['sid'].'">'.$k.'</a></div>';

            foreach ($v as $k1 => $v1 ) {
                $list_sub1.= '<span style="font-size: 16px; margin-left: 10px; '.($v1['delete'] == '2' ? 'color: #CD1B1B;' : '').'"><a href="test.php?sec=edit&cat=test&id='.$v1['id'].'" style="'.($v1['delete'] == '2' ? 'color: #CD1B1B;' : '').'">'.stripslashes($v1['title']).'</a> '.($v1['delete'] == '2' ? '(удален)' : '').'</span></br>';
            }
        }
        return $list_sub1;
    }
}
$user=new user;
?>