<?php
#Главная страница панели администратора

if (include('config.php')) {

    if ($this->user_access > 1) {

    } else header("Location: $local/pages/403.html");
}