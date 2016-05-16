<?php
#Обработка cookie для скрытия оповещений
if(isset($_POST['cookie']))
{
    include_once ('../config.php');

    $id = intval($_POST['cookie']);

    if(isset($_COOKIE['announce1']))
    {
        if(isset($_COOKIE['announce2']))
        {
            if(isset($_COOKIE['announce3']))
            {
                setcookie("announce1", $id, time() + 60 * 60 * $config['COOKIE_TIME_ANNOUNCE'], "/");
            }
            else setcookie("announce3", $id, time() + 60 * 60 * $config['COOKIE_TIME_ANNOUNCE'], "/");
        }
        else setcookie("announce2", $id, time() + 60 * 60 * $config['COOKIE_TIME_ANNOUNCE'], "/");
    }
    else setcookie("announce1", $id, time() + 60 * 60 * $config['COOKIE_TIME_ANNOUNCE'], "/");
}