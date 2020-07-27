<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "db_image";

    $connect = mysqli_connect($server, $user, $pass, $database) or die (my_sqli_error($connect));

    // if save
    if(isset($_POST['tsimpan']))
    {
        if(isset($_GET['hal']))
            {
            if($_GET['hal'] == "edit")
            {
                $ekstensi_diperbolehkan = ['png','jpg'];
                $nama = $_FILES['gambar']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran = $_FILES['gambar']['size'];
                $file_tmp = $_FILES['gambar']['tmp_name'];

                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
                {
                    if($ukuran < 3000000)
                    {
                        move_uploaded_file($file_tmp, 'database/img/' .$nama);
                        $simpan = mysqli_query($connect, "INSERT INTO db_input VALUES('', '$nama')");
                    }
                    else{
                        echo "<script>alert('ukuran tidak di dukung');
                            document.location = 'database.php'
                    </script>";
                    }
                }
                $nama = $_FILES['gambar']['name'];
                $edit = mysqli_query($connect, "UPDATE db_input set 
                                    name = '$_POST[tname]',
                                    desk = '$_POST[tdesc]',
                                    day = '$_POST[tdate]',
                                    month = '$_POST[tmonth]',
                                    year = '$_POST[tyear]',
                                    photo = '$nama'
                                    WHERE name = '$_GET[id]'
                ");
                if($edit) //if inputed
                            {
                                echo "<script>
                
                                    alert('Save data Success!');
                                    document.location = 'database.php';
                                </script>";
                            }
                            else{
                
                                echo "<script>
                
                                    alert('Save data Invalid!!!');
                                    document.location = 'database.php';
                                </script>";
                            }
            }
        }
        else
        {
            // apabila 'hal' tidak sama dengan "edit"
                $ekstensi_diperbolehkan = ['png','jpg'];
                $nama = $_FILES['gambar']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran = $_FILES['gambar']['size'];
                $file_tmp = $_FILES['gambar']['tmp_name'];

                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
                {
                    if($ukuran < 3000000)
                    {
                        move_uploaded_file($file_tmp, 'database/img/' .$nama);
                        $simpan = mysqli_query($connect, "INSERT INTO db_input VALUES('', '$nama')");
                    }
                    else{
                        echo "<script>alert('ukuran tidak di dukung');
                            document.location = 'database.php'
                    </script>";
                    }
                }
                else{
                    echo "<script>alert('Ekstensi tidak di dukung');
                            document.location = 'database.php'
                    </script>";
                }
                
            $file_name = $_FILES['gambar']['name'];
            $save = mysqli_query($connect, "INSERT INTO db_input (name, desk,day,month,year,photo) VALUES (
                '$_POST[tname]', 
                '$_POST[tdesc]',
                '$_POST[tdate]',
                '$_POST[tmonth]',
                '$_POST[tyear]',
                '$file_name'
                )");
                if($save) //if inputed
                {
                    echo "<script>
    
                        alert('Save data Success!');
                        document.location = 'database.php';
                    </script>";
                }
                else{
    
                    echo "<script>
    
                        alert('Save data Invalid!!!');
                        document.location = 'database.php';
                    </script>";
                }
        }
    }
    if(isset($_GET['hal']))
    {
        // pengujian edit
        if($_GET['hal'] == "edit")
        {
            // tampilkan data
            $show = mysqli_query($connect, "SELECT * FROM db_input WHERE name = '$_GET[id]'");
            $data = mysqli_fetch_array($show);
            if($data)
            {
                $vname = $data['name'];
                $vdesc = $data['desk'];
                $vdate = $data['day'];
                $vmonth = $data['month'];
                $vyear = $data['year'];
                $vgambar = $data['photo'];
            }
        }
        else if($_GET['hal'] == "delete")
        {
            if("delete"==true)
            {
                
                $delete = mysqli_query($connect, "DELETE FROM db_input WHERE name = '$_GET[id]'");
                if($delete) //condition delete
                {
                        echo "<script>
        
                            alert('Delete data Success!');
                            document.location = 'database.php';
                        </script>";
                }
            }
            else
            {
                echo "<script>
        
                            alert('Delete data Invalid!!!');
                            document.location = 'database.php';
                        </script>";
            }
        }
    }
?>

<html>

    <head>

        <title>Database</title>
        <link rel="stylesheet" href="database/css/bootstrap.min.css">
        <style>
            html{
                scroll-behavior:smooth;
            }
        </style>
    </head>
    <body>
<div class="container">
        <h1 class="text-center">Database</h1>
        <div class="navbar bg-transparent">
            
            <a href="#fform" class="btn btn-success bg-success">Add +</a>
            <a href="login.php" class="btn btn-danger bg-danger">Logout</a>
        </div>
        <!-- Awal card Form -->
        <div class="card">

            <div class="card-header bg-primary text-white text-center" id="fform">

               Form for input image
            </div>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name image</label>
                        <input type="text" name="tname" value="<?=@$vname?>" class="form-control" placeholder="Input Name Image" required>
                    </div>
                    <div class="form-group">
                        <label>Description Image</label>
                        <textarea class="form-control" name="tdesc" placeholder="Input Description Image" required><?=@$vdesc?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Day</label>
                        <select name="tdate" class="form-control">
                            <option value="<?=@$vdate?>"><?=@$vdate?></option>
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>22</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option>
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Month</label>
                        <select name="tmonth" class="form-control">
                            <option value="<?=@$vmonth?>"><?=@$vmonth?></option>
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <select name="tyear" class="form-control" required>
                            <option value="<?=@$vyear?>"><?=@$vyear?></option>
                            <option>2000</option>
                            <option>2001</option>
                            <option>2002</option>
                            <option>2003</option>
                            <option>2004</option>
                            <option>2005</option>
                            <option>2006</option>
                            <option>2007</option>
                            <option>2008</option>
                            <option>2009</option>
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option>
                            <option>2013</option>
                            <option>2014</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Image</label>
                        
                        <input type="file" value="<?=@$vgambar?>" name="gambar" class="btn btn-file" >
                    </div>
                    <button type="submit" name="tsimpan" class="btn btn-success">Save</button>
                    <button type="reset" name="treset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
        <!-- akhir card Form -->
        <div class="card mt-3">

            <div class="card-header bg-success text-white">

                List image
            </div>
            <div class="card-body">
            
                <table class="table table-bordered table-striped">

                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name Image</th>
                        <th>Image</th>
                        <th>Aksi edit</th>
                        <th>Aksi delete</th>
                    </tr>
                    <?php
                    $no = 1;
                        $show = mysqli_query($connect, "SELECT * FROM db_input order by name desc");
                        while($data = mysqli_fetch_array($show)):
                    ?>
                    <tr> 
                        <td class="text-center"><?= $no++;?></td>
                        <td class="text-center"><?=$data['name']?></td>
                        <td class="text-center">
                        
                        <p class="text-center">
                            <img src="<?php echo "database/img/" .$data['photo']?>" alt="" width="20%">
                        </p>
                        
                            <h3 class="text-center text-danger font">
                                
                                <?=$data['day']?> - <?=$data['month']?> - <?=$data['year']?>
                            </h3>
                            <p class="text-center text-success">
                                <?=$data['desk']?>
                            </p>
                        </td>
                        <td class="text-center">
                            <a href="database.php?hal=edit&id=<?=$data['name']?>" class="btn btn-warning">Edit</a>
                        </td>
                        <td class="text-center">
                            <a href="database.php?hal=delete&id=<?=$data['name']?>" onclick="confirm('Apakah anda Yakin?')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                        <?php endwhile;?>
                </table>
            </div>
            </div>
</div>
        <script src="database/js/bootstrap.min.js"></script>
    </body>
</html>