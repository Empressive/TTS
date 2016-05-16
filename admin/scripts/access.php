<?php
#Изменение сотрудника
include('../../config.php');

include_once('../../library/MVdb.php');

$id = intval($_POST['user_id']);
$login = htmlspecialchars(trim($_POST['login']));
$user = htmlspecialchars(trim($_POST['staff_name']));
$staff_group = intval($_POST['staff_group']);
$access = intval($_POST['access']);

$password = htmlspecialchars(trim($_POST['passw']));
$password2 = htmlspecialchars(trim($_POST['passw2']));


MVdb::connect();

$query = mysql_query("UPDATE staff_login SET login = '$login', staff_name = '$user', staff_group_id = '$staff_group', access_id = '$access' WHERE id = {$id}");

if(isset($password) && isset($password2) && $password != null)
{
    if($password == $password2)
    {
        $token = md5(md5($password.'secret'));

        mysql_query("UPDATE staff_login SET token = '$token' WHERE id = {$id}");
    } else header("Location: $local/pages/502.html");

}

header("Location: $local/admin/edit/{$id}/");