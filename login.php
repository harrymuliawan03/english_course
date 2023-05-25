<?php 
require 'function.php';
session_start();

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }
}

if( isset($_SESSION['login']) ) {
    header('Location: index.php');
    exit;
}


if(isset($_POST["login"])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if( mysqli_num_rows($result) === 1 ) {

        
        
        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row['password']) ) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if( isset($_POST['remember']) ){
                // buat cookie

                setcookie('id', $row['id'], time() + 604800);
                setcookie('key', hash('sha256', $row['username']), time() + 604800);
            }
            
            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    * {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        transition: .2s linear;
    }


    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 100px auto;
        width: 500px;
        border: 5px solid gray;
        padding: 30px;
    }

    .container h1 {
        text-align: center;
        color: #5af69c;
        margin: 30px;
    }

    .container ul li {
        display: flex;
        justify-content: center;
        flex-direction: column;
        list-style: none;
        margin: 20px 0;
    }

    .container ul li input {
        height: 40px;
        width: 400px;
        padding-left: 10px;
        border: 3px solid gray;
        border-radius: 5px;
    }

    .container ul li input:hover {
        border: 3px solid #1B66CA;
    }

    .container ul li a {
        text-decoration: none;
        color: #053370;
    }

    .container ul li a:hover {
        color: #14d2d0;
    }

    .active {
        border: 3px solid #1B66CA;
    }

    button {
        height: 50px;
        background-color: #5587c9;
        border: none;
        color: white;
        margin-top: 20px;
    }

    button:hover {
        cursor: pointer;
        background-color: #1B66CA;
        border: none;
        color: white;
    }

    .foot {
        display: flex;
        justify-content: space-around;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login Page</h1>

        <?php if( isset($error) ) : ?>
        <p style="color: red; font-style: Italic;">Username / Password salah</p>
        <?php endif; ?>

        <form action="" method="post">

            <ul>
                <li>
                    <input type="text" name="username" id="username" placeholder="Username">
                </li>
                <li>
                    <input type="password" name="password" id="password" placeholder="Password">
                </li>

                <li>
                    <button type="submit" name="login">Login</button>
                </li>
            </ul>
            <div class="foot">
                <p><a href="registration.php">Register / Buat Akun</a></p>
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
            </div>

        </form>
    </div>
</body>
<script>
</script>

</html>