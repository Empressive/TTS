<?php
#Страница выхода
include_once('../config.php');
{
    session_destroy();
    setcookie("user_id", '', time() + 1, "/");
    setcookie("token", '', time() + 1, "/");
    header("Location: $local");
}