<?php
#Файл конфигураций

#Настройки хоста и протокола
$config['HOST'] = 'localhost';
$config['PROTOCOL'] = 'http';
$config['PORT'] = '80';
$local = "{$config['PROTOCOL']}://{$config['HOST']}:{$config['PORT']}";

#Время хранение cookie в часах
$config['COOKIE_TIME'] = 12;

$config['COOKIE_TIME_ANNOUNCE'] = 1;

#Меню для пользователей
$admin = "<div class='menu_button'><ul class='links'><li><a href='{$local}'>Все заявки</a></li><li><a href='?page=add'>Добавить заявку</a></li><li><a href='?page=support'>Обратная связь</a></li></ul><div class='links2'><img class='menu_img' src='img/tags.png' onclick=\"location.href='?page=stats'\"><img class='menu_img' src='img/obl2.png' onclick=\"location.href='?page=control'\"><img class='menu_img' src='img/sad.png' onclick=\"location.href='?page=out'\"></div></div>";
$moder = "<div class='menu_button'><ul class='links'><li><a href='{$local}'>Все заявки</a></li><li><a href='?page=add'>Добавить заявку</a></li><li><a href='?page=support'>Обратная связь</a></li></ul><div class='links2'><img class='menu_img' src='img/tags.png' onclick=\"location.href='?page=stats'\"><img class='menu_img' src='img/obl2.png' onclick=\"location.href='?page=moder'\"><img class='menu_img' src='img/sad.png' onclick=\"location.href='?page=out'\"></div></div>";
$user = "<div class='menu_button'><ul class='links'><li><a href='{$local}'>Все заявки</a></li><li><a href='?page=add'>Добавить заявку</a></li><li><a href='?page=support'>Обратная связь</a></li></ul><div class='links2'><img class='menu_img' src='img/tags.png' onclick=\"location.href='?page=stats'\"><img class='menu_img' src='img/sad.png' onclick=\"location.href='?page=out'\"></div></div>";

#Цветовые схемы
$default_color = '#ff9933';
$close_color = '#66cc66';
$toch_color = '#ffff66';
$archive_color = '#cccccc';

$announce_color = '#3BE1E1';