<?php

session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';

// ambiil id dari url dengan GET
$id = $_GET["id"];
$student = query("SELECT * FROM student WHERE id = $id")[0];
    if (isset($_POST["submit"])) {
        // validate data berhasil diubah atau tidak
        if( change($_POST) > 0 ) {
            echo "<script>
                alert('Data berhasil diubah !');
                document.location.href = 'index.php'
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah !');
                document.location.href = 'index.php'
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Data Student</title>
    <style>
    ul li {
        list-style: none;
        margin: 10px 0;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .gambar {
        display: flex;
        flex-direction: column;
    }

    img {
        margin: 10px 0;
    }
    </style>
</head>

<body>

    <div class="container">

        <h1>Change Student</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $student['id']; ?>">
            <input type="hidden" name="photoLama" value="<?= $student['photo']; ?>">
            <ul>
                <li>
                    <label for="name"> Name : </label>
                    <input type="text" name="name" id="name" value="<?= $student['name']; ?>" required>
                </li>
                <li>
                    <label for="level"> Level : </label>
                    <select name="level" id="level" required>
                        <option hidden value="<?= $student['level']; ?>"> <?= $student['level'] ?></option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </li>
                <li>
                    <label for="birthplace"> Birthplace : </label>
                    <input type="text" name="birthplace" id="birthplace" value="<?= $student['birthplace']; ?>"
                        required>
                </li>
                <li>
                    <label for="year_of_birth"> Year of Birth : </label>
                    <input type="date" name="year_of_birth" id="year_of_birth" value="<?= $student['year_of_birth']; ?>"
                        required>
                </li>
                <li>
                    <label for="email"> Email : </label>
                    <input type="email" name="email" id="email" value="<?= $student['email']; ?>" required>
                </li>
                <li class="gambar">
                    <label for="photo"> Photo : </label>
                    <img src="img/<?= $student['photo'];?>" width="40">
                    <input type="file" name="photo" id="photo">
                </li>

                <li>
                    <button type="submit" name="submit">Change Data</button>
                </li>
            </ul>
        </form>
    </div>

</body>

</html>