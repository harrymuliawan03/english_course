<?php 
require 'function.php';

if(isset($_POST["registration"])){

    if( registration($_POST) > 0 ){
        echo"<script> 
            alert('user baru berhasil ditambahkan!');
            document.location.href = 'index.php'
            </script>";
    } else{
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
        border: .5px solid gray;
        padding: 30px;
    }

    .container h1 {
        text-align: center;
        color: #5DA6EF;
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

    .active {
        border: 3px solid #1B66CA;
    }

    button {
        height: 50px;
    }

    button:hover {
        cursor: pointer;
        background-color: #1B66CA;
        border: none;
        color: white;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Registration Page</h1>

        <form action="" method="post">

            <ul>
                <li>
                    <input type="text" name="username" id="username" placeholder="Username">
                </li>
                <li>
                    <input type="password" name="password" id="password" placeholder="Password">
                </li>

                <li>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                </li>

                <li>
                    <button type="submit" name="registration">Register</button>
                </li>

                <li>
                    <p><a href="login.php">Login</a></p>
                </li>
            </ul>

        </form>
    </div>
</body>
<script>
</script>

</html>