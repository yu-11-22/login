<?php
session_start();
require_once('../connection/conn_db.php');
$member = file_get_contents('member.html');

$account = $_SESSION['account'];

echo str_replace(['{{$account}}'], [$account], $member);

