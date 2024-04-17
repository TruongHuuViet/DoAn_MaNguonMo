<?php

    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'webbangiay';

    $conn = new mysqLi($server, $user, $pass, $database);

    if($conn){
        mysqli_query($conn, "SET NAMES 'utf8'");
    }
    else
    {
        echo 'Kết nối với Database không thành công !';
    }

?>