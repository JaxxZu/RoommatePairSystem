<?php
$loco="localhost";
$ac_sql="rsp";
$pw_sql="Fa6NiMNi8jPEX4xS";



$link= mysqli_connect($loco,$ac_sql,$pw_sql);

if (!$link) {
    die('connect failed: ' . mysqli_connect_error());
}else{

    //echo ('connect ok');

$sldb = @mysqli_select_db($link,"rsp");
 if (!$sldb) {
        die('Select database failed: ' . mysqli_error($link));
    }else{
          //  echo ('sldb ok');

    }

}




