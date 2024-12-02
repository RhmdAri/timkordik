<?php
    $con = mysqli_connect('localhost','root','','simkordik');

    if (mysqli_connect_errno()){
        echo "<h1>Koneksi Database Error : " . mysqli_connect_errno() ."</h1>";
    }
?>