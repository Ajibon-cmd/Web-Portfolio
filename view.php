<?php
$connect = mysqli_connect("localhost","root","","db_image");
if(!$connect)
{
    echo "Koneksi ke database gagal";   
}
    if(isset($_GET['photo'])) 
    {
                $ekstensiGambarvalid = ['jpg','jpeg','svg','png'];
                $file_name = $_FILES['gambar']['name'];
                $file_size = $_FILES['gambar']['size'];
                $file_error = $_FILES['gambar']['error'];
                $file_type = $_FILES['gambar']['type'];
                $tmp_name = $_FILES['gambar']['tmp_name'];
                $ekstensiGambar = explode('.', $file_name);
                $ekstensiGambar = strtolower(end($ekstensiGambarvalid));

        $show = mysqli_query($koneksi,"SELECT * from db_input where photo ='".$_GET['photo']."'");
        $data = mysqli_fetch_array($show);
        header("Content-type: " . $show["$file_name"]);
        echo $row["gambar"];
    }
    else
    {
        header('location:index.php');
    }
?>