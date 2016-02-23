<?php
#Логин пользователей
session_start();
if (isset($_POST['login']) && isset($_POST['passw'])) {

    include('../config.php');

    $login = htmlspecialchars(trim($_POST['login']));
    $passw = md5(md5(htmlspecialchars(trim($_POST['passw']))));
    if ((include_once '../library/UnionDB.php')) {
        UnionDB::connectDb();

        $query = mysql_query("SELECT id, login, token FROM staff_login WHERE login = '$login'");
        $result = mysql_fetch_assoc($query);

        $db_user_id = $result['id'];
        $db_login = $result['login'];
        $db_passw = $result['token'];

        if ($login == $db_login && $passw == $db_passw) {
            $_SESSION['user_id'] = $db_user_id;

            setcookie("user_id", $db_user_id, time() + 60 * 60 * $config['COOKIE_TIME'], "/");
            setcookie("token", $db_passw, time() + 60 * 60 * $config['COOKIE_TIME'], "/");

            if (include_once('../config.php')) ;
            header("Location: $local");
        } else header("Location: $local");
    }
}