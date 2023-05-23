<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
if(isset($_COOKIE['login'])) {
    setcookie('login', '');
}


header("Location: login.php");
exit;
?>