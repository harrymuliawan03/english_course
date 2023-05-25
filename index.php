<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';

// buat konfigurasi pagination
$batas = 2;
$halamanActive = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
$awalData = ($batas * $halamanActive) - $batas;

if ( isset($_POST["cari"]) ) {
    $cari = $_POST['keyword'];
    $_SESSION['cari'] = $cari;
} elseif( isset($_POST['all']) ){
    $_SESSION['cari'] = '';
}
// jika ada session cari
if( isset($_SESSION['cari']) && $_SESSION['cari'] != '' ) {
    $cari = $_SESSION['cari'];
    $student = query("SELECT * FROM student WHERE 
    name like '%$cari%' OR
    birthplace like '%$cari%' OR
    year_of_birth like '%$cari%' OR
    email like '%$cari%' LIMIT $awalData, $batas");
    if($student == []){
        $keterangan_cari = 'Data Tidak Ditemukan';
    }
    $jml = query("SELECT * FROM student WHERE 
    name like '%$cari%' OR
    birthplace like '%$cari%' OR
    year_of_birth like '%$cari%' OR
    email like '%$cari%'");
    $jumlahData = count($jml);
} else {
    $student = query("SELECT * FROM student LIMIT $awalData, $batas");
    $jumlahData = count(query("SELECT * FROM student"));
}

$jumlahHalaman = ceil($jumlahData / $batas);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .container form {
        margin-bottom: 10px;
    }

    table,
    tr,
    th,
    td {
        border: 1px solid black;
        padding: 10px 20px 10px 20px;
    }

    table {
        border-collapse: collapse;
    }
    </style>
</head>

<body>
    <a href="logout.php">logout</a>
    <div class="container">
        <h1>List of Students</h1>
        <a href="add.php">Add Student</a><br>
        <br><br>
        <!-- form untuk mencari data student -->
        <form class="cari" action="" method="post">
            <input type="text" name="keyword" autofocus placeholder="Input search keyword" size="40" autocomplete="off">
            <button type="submit" name="cari">Cari Data</button>
            <button type="submit" name="all">Semua Data</button>
        </form>

        <table>

            <tr>
                <th>no.</th>
                <th>foto</th>
                <th>nama</th>
                <th>tempat lahir</th>
                <th>tanggal lahir</th>
                <th>email</th>
                <th>aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach( $student as $row ) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><img src="img/<?= $row["photo"]; ?>" width="50"></td>
                <td>
                    <?= $row["name"] ?>
                </td>
                <td><?= $row["birthplace"] ?></td>
                <td><?= $row["year_of_birth"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><a href="change.php?id=<?= $row['id']; ?>">change</a> | <a href="delete.php?id=<?= $row['id'];?>"
                        onclick="return confirm('yakin ingin menghapus data ?'); ">delete</a></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>

        </table>
        <br><br>

        <!-- Navigasi -->
        <div>
            <?php if($halamanActive > 1): ?>
                <a href="?page=<?= $halamanActive - 1; ?>">&laquo;</a>
            <?php endif; ?>
                <?php if($jumlahHalaman == 1) : ?>
                        <p></p>
                    <?php else : ?>
                        <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>
                            <?php if($i == $halamanActive) : ?>
                                <a href="?page=<?= $i ?>" style="font-weight: bold; color: red;"><?= $i ?></a>
                            <?php else : ?>
                                <a href="?page=<?= $i ?>"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php endif; ?>

            <?php if($halamanActive < $jumlahHalaman): ?>
                <a href="?page=<?= $halamanActive + 1; ?>">&raquo;</a>
            <?php endif; ?>
        </div>

        <h1><?php global $keterangan_cari;
                    echo $keterangan_cari;
                ?></h1>
    </div>


</body>

</html>