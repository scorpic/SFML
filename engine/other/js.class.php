<?php
if(!defined('CMS'))die('—юда нельз€');
/*
 * @author ћуковкин ƒмитрий
 */
class js {
    function getJS($array) {
        foreach($array as $key) {
            $string.='<script type="text/javascript" src="./script/'.$key.'.js"></script>'."\n";
        }
        return $string;
    }
}

?>
