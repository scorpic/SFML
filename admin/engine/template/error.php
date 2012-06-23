<?php
class err {
    function GNC($str) {
        $admin='../';
        require '../template/header.php';
        echo '<tr><td style="background-color: #fff; border-radius: 5px; text-align: center;">
        <div style="padding: 30px;"><span style="font-size: 29px; font-weight: bold; color: #999; margin: 30px;">'.$str.'</span></div>
        </td>
    </tr>';
        require '../template/footer.php';
        exit();
    }
}
$err=new err;
?>
