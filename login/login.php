<?php
session_start();
require_once('../connection/conn_db.php');
$login = file_get_contents('login.html');
$account = 'account';
$password = 'password';

if (isset($_POST['submit'])) {
    if (!empty($_POST['account']) && !empty($_POST['password'])) {
        $account = $_POST['account'];
        $password = $_POST['password'];
        // $sqlString = "SELECT * FROM vincent.member WHERE member.account='$account' AND member.password='$password'";
        $sqlString = "SELECT * FROM vincent.member WHERE member.account='$account'";
        $result = mysqli_query($link, $sqlString);
        $resultRows = mysqli_fetch_assoc($result);
        // if (mysqli_num_rows($result) > 0)
        if (password_verify($password, $resultRows['password']))
         {
            echo '<script>alert("登入成功!");</script>';
            echo '<script>window.location.href="member.php"</script>';
        } else {
            echo '<script>alert("帳號或密碼有誤!");</script>';
            echo '<script>window.location.href="login.php"</script>';
        }
        $_SESSION['account'] = $account;
    }
}
echo str_replace(['{{$account}}', '{{$password}}'], [$account, $password], $login);
