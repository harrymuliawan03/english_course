<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "english_course");

// ambil data dari tabel student
$result = mysqli_query($conn,"SELECT * FROM student");

// ambil data mahasiswa dari object result
// mysqli_fetch_row() // mengembalikan array numerik
// $mhs = mysqli_fetch_row($result);
// var_dump($mhs[1]);

// mysqli_fetch_assoc() // mengembalikan array assosiative
// $mhs = mysqli_fetch_assoc($result);
// var_dump($mhs);

// mysqli_fetch_array() /mengembalikan array numerik & assosiative
// $mhs = mysqli_fetch_array($result);
// var_dump($mhs);

// mysqli_fetch_object()

// while( $std = mysqli_fetch_assoc($result) ) {
//     var_dump($std["name"]);
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    table,
    tr,
    th,
    td {
        border: 1px solid black;
        padding: 10px;
    }

    table {
        border-collapse: collapse;
    }
    </style>
</head>

<body>

    <h1>List of Students</h1>

    <table>

        <tr>
            <th>no.</th>
            <th>foto</th>
            <th>nama</th>
            <th>tempat lahir</th>
            <th>tanggal lahir</th>
            <th>email</th>
        </tr>

        <?php $i = 1; ?>
        <?php while ( $row = mysqli_fetch_assoc($result) ) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><img src="img/<?= $row["photo"]; ?>" width="50"></td>
            <td>
                <?= $row["name"] ?>
            </td>
            <td><?= $row["birthplace"] ?></td>
            <td><?= $row["year_of_birth"] ?></td>
            <td><?= $row["email"] ?></td>
        </tr>
        <?php $i++; ?>
        <?php endwhile ?>

    </table>

</body>

</html>