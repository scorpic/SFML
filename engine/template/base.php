<?php
if(!defined('CMS'))die('Сюда нельзя');
require_once 'engine/template/error.php';
/*
 * Класс для вставки переменных в шаблон
 * Обязательная функция - parse()
 */
class baseTemplate extends err {
    private $array_replace = array(),
            $array_replace_js = array(),
            $array_replace_css = array(),
            $path = 'template/';

    /* Вставка переменных в шаблон */
    function setVar($key,$value) {
        $this->array_replace[$key] = $value;
    }
    /* Замена переменных и вывод на экран */
    function parse($filename) {
        if (!file_exists($this->path.$filename.'.tpl')) {
            exit('Шаблона '.$filename.' не существует');
        }

        $getFile = file_get_contents($this->path.$filename.'.tpl');
        /* Подключаем шапку и низ */
        $getFile = str_replace('{HEADER}', file_get_contents($this->path.'header.tpl'), $getFile);
        $getFile = str_replace('{FOOTER}', file_get_contents($this->path.'footer.tpl'), $getFile);

        $this->setVar('CSS',$this->generateCSS());
        $this->setVar('JS',$this->generateJS());
        foreach ($this->array_replace as $k => $v) {
            $getFile = str_replace('{'.$k.'}', $v, $getFile);
        }
        echo $getFile;
        $this->genTime();
    }
    /* Функция для вставки в массив ссылок javascript файлов */
    function setJS($array) {
        foreach ($array as $k) {
            $this->array_replace_js[] = $k;
        }
    }
    /* Функция для вставки в массив ссылок css файлов */
    function setCSS($array) {
        foreach ($array as $k) {
            $this->array_replace_css[] = $k;
        }
    }
    /* Функции для генерации html кода */
    function generateJS () {
        foreach ($this->array_replace_js as $key => $value) {
            $js.='<script type="text/javascript" src="../script/'.$value.'.js"></script>'."\n";
        }
        return $js;
    }

    function generateCSS () {
        foreach ($this->array_replace_css as $key => $value) {
            $css.='<link href="./template/css/'.$value.'.css" rel="stylesheet" type="text/css" />'."\n";
        }
        return $css;
    }
    /* Конец функций для генерирования html кода */

    /* Функция для вывода в конце документа времени генерации страницы */
    function genTime() {
        global $time;
	$stime = explode(" ",$time);
	$stime = $stime[1] + $stime[0];

	$etime=explode(" ",microtime());
	$etime=($etime[1] + $etime[0]) - $stime;
	echo '<!-- generated: '.$etime.' seconds -->';
    }
}
$tmp = new baseTemplate();
?>
