<?php

include '../connect.php';


$query = "SELECT kode, nama_matkul, sks, semester, nama_dosen
        FROM matakuliah LEFT JOIN dosen
        USING (id_dosen)
        ORDER BY (kode)";

$result = mysqli_query($connect, $query);

$num = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
        <form action="search.php" method="get">
                <input type="search" name="cari" placeholder="Masukkan pencarian...">
                <select name="kategori" id="">
                        <option value="nama_matkul">Matakuliah</option>
                        <option value="nama_dosen">Dosen</option>
                        <option value="sks">Semester</option>
                </select>
                <input type="submit" value="Cari">
        </form>
        <table border="1">
            <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Matakuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Dosen Pengajar</th>
                <th>Aksi</th>
        
        </tr>
        <?php
                if($num > 0)
                {
                        $no = 1;
                        while($data = mysqli_fetch_assoc($result)) { ?>

                                <tr>
                                    <td> <?php echo $no; ?></td>
                                    <td> <?php echo $data['kode'] ?></td>
                                    <td> <?php echo $data['nama_matkul'] ?></td>
                                    <td> <?php echo $data['sks'] ?></td>
                                    <td> <?php echo $data['semester'] ?></td>
                                    <td> 
                                        <?php
                                                if($data['nama_dosen'] != NULL)
                                                { echo $data['nama_dosen']; }
                                                else { echo "NULL"; }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="form-update.php?kode=<?php echo $data['kode']; ?>">Edit </a> |
                                        <a href="delete.php?kode=<?php echo $data['kode']; ?> " onclick="return confirm('Anda yakin ingin menghapus data?')">Hapus</a>
                                    </td>
                                    
                                </tr>
                        <?php
                        $no++;

                        }       
                }
                else 
                {
                        echo "<tr> <td colspan='7'>Tidak ada data</td></tr>";
                }
        ?>

        </table>
</body>
</html>
