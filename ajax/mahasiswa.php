<?php 
require '../function.php';

$keyword = $_GET['keyword'];
$query = "SELECT * FROM student
WHERE 
name like '%$keyword%' OR
birthplace like '%$keyword%' OR
year_of_birth like '%$keyword%' OR
email like '%$keyword%'";

$student = query($query);

?>
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