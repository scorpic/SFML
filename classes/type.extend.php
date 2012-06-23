<?php
if(!defined('CMS'))die('Сюда нельзя');
class Type {
    /* Функции для первого типа (вопроса с возможностью выбора вариантов ответа) */
    function typeOne($array) {
        global $test_mode;
        $ask = $this->charseTrue(stripslashes($array['ask']));
        $title=$this->charseTrue(stripslashes($array['title']));
        $arr = array('id' => $array['aid'], 'text' => $title, 'add_class' => 'a');
        /* Test Mode */
        if ($test_mode) {
            unset($arr);
            $b='a';
            if ($array['correct']==2) {
                $b='a b';
            }
            $arr = array('id' => $array['aid'], 'text' => $title, 'add_class' => $b);
        }
        $images = json_decode($array['code']);
        $count_images = count($images);
        return    array(
            'type' => '1',
            'text' => $ask,
            'path' => $images,
            'count_images' => $count_images,
            // массив вопросов
            'answers' => array(
                $arr
            )
        );
    }
    function typeOneYet($array) {
        global $test_mode;
        $title=$this->charseTrue(stripslashes($array['title']));
        $a=array('id' => $array['aid'], 'text' => $title, 'add_class' => 'a');
        /* Test Mode */
        if ($test_mode) {
            $b='a';
            if ($array['correct']==2) {
                $b='a b';
            }
            $a = array('id' => $array['aid'], 'text' => $title, 'add_class' => $b);
        }
        return $a;
    }
    /* Конец */
    
    /*  Функция для второго типа (вопрос с возможностью ввода своего ответа)  */
    function typeTwo($array) {
        $ask = $this->charseTrue(stripslashes($array['ask']));
        return    array(
            'type' => '2',
            'text' => $ask,
            // массив id по которому будет проверятся ответ
            'answers' => array(
                array('id' => $array['aid'])
            )
        );
    }
    /* Конец */
}

?>
