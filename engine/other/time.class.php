<?php
/*
 * Ётот класс предназначен дл€ правильного отображени€ времени на сайте
 */
class time {
    public $date = array(
        '1' => array('€нвар€'),
        '2' => array('феврал€'),
        '3' => array('марта'),
        '4' => array('апрел€'),
        '5' => array('ма€'),
        '6' => array('июн€'),
        '7' => array('июл€'),
        '8' => array('августа'),
        '9' => array('сент€бр€'),
        '10' => array('окт€бр€'),
        '11' => array('но€бр€'),
        '12' => array('декабр€'),
        );
    /*
     * array[0] = ответ
     * array[1] = ответа
     * array[2] = ответов
     */
    function rulesTime($number,$array) {
        $cases = array(2, 0, 1, 1, 1, 2);  
        return $number.' '.$array[ ($number%100 > 4 && $number%100<20) ? '2' : $cases[($number%10<5)? $number%10 : 5] ];
    }
    /*
     * timestamp -> date month year
     */
    function fullDate($int) {
        if ($int == 0) {
            return 'Ќеизвестно';
        }
        $nowdate=getdate();
	$date=getdate($int);
        if($nowdate['year']==$date['year']&&$nowdate['mon']==$date['mon']&&$nowdate['mday']==$date['mday']) {
                return 'сегодн€ в '.$date['hours'].':'.($date['minutes'] < 10 ? '0'.$date['minutes'] : $date['minutes']);
        }elseif($nowdate['year']==$date['year']&&$nowdate['mon']==$date['mon']&&($nowdate['mday']-1)==$date['mday']) {
                return 'вчера в '.$date['hours'].':'.($date['minutes'] < 10 ? '0'.$date['minutes'] : $date['minutes']);
        }
        else {
                return $date['mday'].' '.$this->date[$date['mon']][0].' '.$date['year'].' в '.$date['hours'].':'.($date['minutes'] < 10 ? '0'.$date['minutes'] : $date['minutes']);

        }
    }
}

?>
