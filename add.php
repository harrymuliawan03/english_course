<?php

session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';
    // cek apakah tombol submit sudah ditekan / belum
    if (isset($_POST["submit"])) {
        // validate data berhasil ditambah atau tidak
        if( add($_POST) > 0 ) {
            echo "<script>
                alert('Data berhasil ditambahkan !');
                document.location.href = 'index.php'
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan !');
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
    <title>Add New Student</title>
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Student</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="name"> Name : </label>
                    <input type="text" name="name" id="name" required>
                </li>
                <li>
                    <label for="level"> Level : </label>
                    <select name="level" id="level" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </li>
                <li>
                    <label for="birthplace"> Birthplace : </label>
                    <input type="text" name="birthplace" id="birthplace" required>
                </li>
                <li>
                    <label for="year_of_birth"> Year of Birth : </label>
                    <input type="date" name="year_of_birth" id="year_of_birth" required>
                </li>
                <li>
                    <label for="email"> Email : </label>
                    <input type="email" name="email" id="email" required>
                </li>
                <li>
                    <label for="photo"> Photo : </label>
                    <input type="file" name="photo" id="photo">
                </li>

                <li>
                    <button type="submit" name="submit">Add Data</button>
                </li>
            </ul>
        </form>
    </div>


</body>

</html>