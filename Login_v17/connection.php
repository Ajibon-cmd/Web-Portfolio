<?php
$connect = mysqli_connect("localhost","root","","login");
if(!$connect)
{
    echo "Koneksi ke database gagal";   
}
?>