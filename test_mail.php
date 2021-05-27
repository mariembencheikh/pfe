<?php
$to="mariembencheikh71@gmail.com";
//$to="webmaster@winicari.tn";
$subject="test_mail";
$message="hhhhh";
$Email="kortashelmi7@gmail.com";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
//$headers .= 'From: '.$Email . "\r\n" ;
if(mail($to,$subject,$message,$headers)){
    echo 'done';
}
else{
    echo 'fail';
}