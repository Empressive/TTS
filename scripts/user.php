<?php
#Добавление сотрудников в бд

$login = htmlspecialchars(trim($_POST['login']));
$user = htmlspecialchars(trim($_POST['user']));
$group = htmlspecialchars(trim($_POST['group']));
$access = htmlspecialchars(trim($_POST['access']));
$passw = htmlspecialchars(trim($_POST['passw']));
$passw2 = htmlspecialchars(trim($_POST['passw2']));

if($passw == $passw2)
{
    include_once ('../library/UnionDB.php');
    UnionDB::connectDb();
    mysql_query("SELECT login FROM staff_login WHERE login = '$login'");
    if($resault = mysql_fetch_assoc($query)) echo "<div class='alert'>Логин занят !</div>";
    else {

        $passw = md5(md5($passw.'secret'));

        mysql_query("INSERT INTO staff_login VALUES ('', '$login', '$user', '$group', '$passw', '', '', '', '$access')");
        mysql_query("INSERT INTO staff_name VALUES ('', '$user')");

        if(include('../config.php')) header("Location: $local?page=control");
    }
}
else echo "<div class='alert'>Пароли не совпадают !</div>";
