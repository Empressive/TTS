<?php
#Страница выхода
{
    session_destroy();
    setcookie("user_id", '', time() + 1, "/");
    setcookie("token", '', time() + 1, "/");
    header("Location: $local");
}