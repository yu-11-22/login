<?php
session_start();
require_once('../connection/conn_db.php');
$update = file_get_contents('update.html');
$account = $_SESSION['account'];
$password = 'password';
$checkpassword = 'checkpassword';

if (isset($_POST['submit'])) {
    $account = $_SESSION['account'];
    $password = $_POST['password'];
    $checkpassword = $_POST['checkpassword'];
    if ($password != $checkpassword) {
        echo '<script>alert("兩次密碼不一致，請重新輸入!");</script>';
        echo '<script>window.location.href="update.php"</script>';
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sqlString = "UPDATE vincent.member SET member.password='$password' WHERE member.account='$account'";
        mysqli_query($link, $sqlString);
        echo '<script>alert("更改完成!");</script>';
        echo '<script>window.location.href="member.php"</script>';
    }
    $_SESSION['account'] = $account;
}
echo str_replace(['{{$account}}', '{{$password}}', '{{$checkpassword}}'], [$account, $password, $checkpassword], $update);
