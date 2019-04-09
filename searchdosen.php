<?php

session_start();

//if(!(isset($_SESSION['user'])))
//{
//    header("location:../login/form-login.php");
//}
    include '../connect.php';
    
    $cari = $_GET['cari'];

    $query = "SELECT * FROM dosen WHERE nama_dosen LIKE '%$cari%'";

    $result = mysqli_query($connect, $query);

    $num = mysqli_num_rows($result);

    ?>

<!DOCTYPE html> 
<html>

<body>
    
    <table border='1'>
    <h2>Data dosen</h2>
    <tr>
        <th>No.</th>
        <th>Nama Dosen</th>
        <th>Telepon</th>
        <th>Aksi</th>

    </tr>

    <?php
        if($num > 0)
        {
            $no = 1;
            while($data = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $data['nama_dosen'] . "</td>";
                echo "<td>" . $data['telp'] . "</td>";
                echo "<td><a href='form-update.php?id_dosen=" . $data['id_dosen'] . "'>Edit</a> | ";
                echo "<td><a href='delete.php?id_dosen=" . $data['id_dosen'] . "'onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>Hapus</a></td>";
                echo "</tr>";
                $no++;
            }
        }

        else
        {
            echo "<td colspan='3'>Tidak ada data</td>";
        }
        

        ?>
    </table>
    <?php
    echo "<a href='../login/logout.php'> Logout</a>";
    ?>
    </body>
    </html>