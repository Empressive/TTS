<?php
#Добавление заяки в бд
session_start();
if($_SESSION['user_id'] != 0) {
include_once('../config.php');

$category = htmlspecialchars(trim($_POST['category']));
$agreement = htmlspecialchars(trim($_POST['agreement']));
$ip = htmlspecialchars(trim($_POST['ip']));
$username = htmlspecialchars(trim($_POST['username']));
$location = htmlspecialchars(trim($_POST['location']));
$house = htmlspecialchars(trim($_POST['house']));
$driveway = htmlspecialchars(trim($_POST['driveway']));
$floor = htmlspecialchars(trim($_POST['floor']));
$flat = htmlspecialchars(trim($_POST['flat']));
$phone = htmlspecialchars(trim($_POST['phone']));
$comment = htmlspecialchars(trim($_POST['comment']));
$staff_group_id = htmlspecialchars(trim($_POST['executor']));
$status = 3;

$time_date = htmlspecialchars(trim($_POST['time_date']));
$now_date = date('Y-m-d H:i:s');

include_once('../library/MVdb.php');

MVdb::connect();

$user_id = $_SESSION['user_id'];

mysql_query("INSERT INTO tickets VALUES('', '$category', '$agreement', '$ip', '$username', '$location', '$house', '$driveway', '$floor', '$flat', '$phone', '$comment', '$time_date', '$now_date', '$user_id', '$staff_group_id', '', '', '', '$status', '')");
header("Location: $local");
}
else header("location: $local/pages/502.html");
