<?php
#Добавление сотрудников в бд
include('../../config.php');

$login = htmlspecialchars(trim($_POST['login']));
$user = htmlspecialchars(trim($_POST['user']));
$group = htmlspecialchars(trim($_POST['group']));
$access = htmlspecialchars(trim($_POST['access']));
$passw = htmlspecialchars(trim($_POST['passw']));
$passw2 = htmlspecialchars(trim($_POST['passw2']));

if($passw == $passw2)
{
    include_once('../../library/MVdb.php');

    MVdb::connect();
    mysql_query("SELECT login FROM staff_login WHERE login = '$login'");

    if($result = mysql_fetch_assoc($query)) header("Location: $local/pages/502.html");
    else {
        $passw = md5(md5($passw.'secret'));

        mysql_query("INSERT INTO staff_login VALUES ('', '$login', '$user', '$group', '$passw', '', '', '', '', '', '$access')");
        mysql_query("INSERT INTO staff_name VALUES ('', '$user')");

        if($group == 4) mysql_query("INSERT INTO millwright VALUES ('','$user','1')");

        header("Location: $local/admin/");
    }
} else header("Location: $local/pages/502.html");

