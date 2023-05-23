<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';
$student = query("SELECT * FROM student");

if (isset($_POST["cari"])) {
    if($_POST['keyword'] == ""){
        $student = query("SELECT * FROM student");
    }else {
        $student = cari($_POST['keyword']);
        if($student == []) {
            $keterangan_cari = "Data tidak Ditemukan";
        }else {
            $keterangan_cari = "";
        }
    }
}

if (isset($POST["all"])) {
    $student = query("SELECT * FROM student");
}
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
        <h1><?php global $keterangan_cari;
                    echo $keterangan_cari;
                ?></h1>
    </div>


</body>

</html>