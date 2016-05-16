<?php
#Файл конфигураций

#Настройки хоста и протокола
$config['HOST'] = 'localhost';
$config['PROTOCOL'] = 'http';
$config['PORT'] = '80';
$local = "{$config['PROTOCOL']}://{$config['HOST']}:{$config['PORT']}";

#Время хранение cookie в часах
$config['COOKIE_TIME'] = 12;

$config['COOKIE_TIME_ANNOUNCE'] = 12;

#Меню для пользователей
$admin = "<div class='menu_button'><ul class='links'><li><a href='{$local}'>Все заявки</a></li><li><a href='/add/'>Добавить заявку</a></li><li><a href='/support/'>Обратная связь</a></li></ul><div class='links2'><img class='menu_img' src='/img/tags.png' onclick=\"location.href='/stats/'\"><img class='menu_img' src='/img/obl2.png' onclick=\"location.href='/admin/'\"><img class='menu_img' src='/img/sad.png' onclick=\"location.href='/out/'\"></div></div>";
$moder = "<div class='menu_button'><ul class='links'><li><a href='{$local}'>Все заявки</a></li><li><a href='/add/'>Добавить заявку</a></li><li><a href='/support/'>Обратная связь</a></li></ul><div class='links2'><img class='menu_img' src='/img/tags.png' onclick=\"location.href='/stats/'\"><img class='menu_img' src='/img/obl2.png' onclick=\"location.href='/moder/'\"><img class='menu_img' src='/img/sad.png' onclick=\"location.href='/out/'\"></div></div>";
$user = "<div class='menu_button'><ul class='links'><li><a href='{$local}'>Все заявки</a></li><li><a href='/add/'>Добавить заявку</a></li><li><a href='/support/'>Обратная связь</a></li></ul><div class='links2'><img class='menu_img' src='/img/tags.png' onclick=\"location.href='/stats/'\"><img class='menu_img' src='/img/sad.png' onclick=\"location.href='/out/'\"></div></div>";

#Цветовые схемы
$default_color = '#ff9933';
$close_color = '#66cc66';
$toch_color = '#ffff66';
$archive_color = '#cccccc';

$announce_color = '#3BE1E1';

#ID важных данных
$all_ticket = '0'; #Все статус
$archive_ticket = '1'; #Архив
$close_ticket = '2'; #Выполнена
$open_ticket = '3'; #Не выполнена
$touch_ticket = '4'; #Выполнена частично

$all_category = '0'; #Все категория

$all_staff_group = '0'; #Все исполнитель
$archive_staff_group = '1'; #Архив

$archive_reason = '0'; #Причина архив

