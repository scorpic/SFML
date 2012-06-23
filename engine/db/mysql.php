<?php
if(!defined('CMS'))die('Сюда нельзя');
class DB  {
    public
        $count=0; // Сколько запросов в базу данных
	function __construct($s)
	{
		if(empty($s)) {
			die('Невозможно загрузить настройки');
		}
		if (!$mysql_c=mysql_connect($s['host'],$s['user'],$s['pass'])) {
			die('Не могу соединиться с базой данных :(');
		}

		if (!mysql_select_db($s['name'],$mysql_c)) {
			die('Невозможно сделать выборку из бд');
		}
                $this->query('SET NAMES CP1251');
	}
        /*
         * $string - Сам mysql запрос
         * $error - Если строка не пустая или не false, то проверяется на пустоту
         * $inArray - Все в массив
         */
	function query ($string='',$error=false,$inArray=false) {
            global $tmp;
            $arr=mysql_query($string) or die('
                Произошла ошибка<br/>
                Запрос: '.$string.'<br />'.mysql_error()
            );
            if ($error) {
                if ($this->num_rows($arr) == 0) {
                    $tmp->GNC($error);
                }
            }
            if($inArray) {
                $arr = $this->fetch_array($arr);
            }
            $this->count++;
            return $arr;
	}
	function num_rows ($string) {
	return mysql_num_rows($string);
	}
	function fetch_array ($string) {
	return mysql_fetch_array($string,MYSQL_ASSOC);
	}
        function fetch_assoc ($string) {
	return mysql_fetch_assoc($string);
	}
	function fetch_row ($string) {
	return mysql_fetch_row($string);
	}
}
$db=new DB($db_set);
?>