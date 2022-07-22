<?php
session_start();
require_once('../connection/conn_db.php');
$register = file_get_contents('register.html');
$account = 'account';
$password = 'password';

if (isset($_POST['submit'])) {
    if (!empty($_POST['account']) && !empty($_POST['password'])) {
        $account = $_POST['account'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sqlString = "INSERT INTO vincent.member (account, password) VALUES ('$account','$password')";
        if (mysqli_query($link, $sqlString)) {
            echo '<script>alert("註冊成功!");</script>';
            echo '<script>window.location.href="member.php"</script>';
        } else {
            echo '<script>alert("帳號已被註冊!");</script>';
            echo '<script>window.location.href="register.php"</script>';
        }
        $_SESSION['account'] = $account;
    }
}
echo str_replace(['{{$account}}', '{{$password}}'], [$account, $password], $register);
