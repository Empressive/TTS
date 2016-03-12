<?php
session_start();

include_once('../library/UnionDB.php');
include_once('../config.php');

UnionDB::connectDb();

$user_id = $_SESSION['user_id'];
$now_date = date('Y-m-d');


$staff_group_id = mysql_query("SELECT staff_group_id FROM staff_login WHERE id = $user_id");
$result = mysql_fetch_assoc($staff_group_id);
$staff_id = $result['staff_group_id'];


$staff_rows = mysql_query("SELECT id, now_date, time_date, category, staff_group, agreement, location, house, driveway, floor, flat, comment, status FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE status_id != 0 and status_id != 1 and status_id != 2 and  staff_group_id = $staff_id and time_date BETWEEN '0000-00-00' and '$now_date'");
$rows = mysql_num_rows($staff_rows);

echo "<table class='main_table' id='main_table' border='1'>";

echo "<tr><th colspan='9'>Количество заявок: $rows</th></tr>";
echo "<tr bgcolor='#339999'>";
echo "<td width='9%' id='td_color'>Номер заявки</td>";
echo "<td width='10%' id='td_color'>Дата принятия</td>";
echo "<td width='10%' id='td_color'>Дата выполнения</td>";
echo "<td width='12%' id='td_color'>Категория</td>";
echo "<td width='12%' id='td_color'>Исполнитель</td>";
echo "<td width='6%' id='td_color'>Договор</td>";
echo "<td width='15%' id='td_color'>Адрес<table class='border' width=100%><tr><td class='td_color'>дом</td><td class='td_color'>под.</td><td class='td_color'>эт.</td><td class='td_color'>кв.</td></tr></table></td>";
echo "<td width='23%' id='td_color'>Комментарий</td>";
echo "</tr>";

while ($result = mysql_fetch_assoc($staff_rows)) {
    $id = $result['id']; #id заявки
    $t_date = $result['time_date']; #Дата выполнения заявки
    $n_date = $result['now_date']; #Дата получаения заявки
    $category = $result['category']; #Категория
    $executor = $result['staff_group']; #Исполнитель
    $agreement = $result['agreement']; #Номер договора
    $location = $result['location']; #Сегмент
    $house = $result['house']; #Дом
    $driveway = $result['driveway']; #Подъезд
    $floor = $result['floor']; #Этаж
    $flat = $result['flat'];  #Квартира
    $comment = $result['comment']; #Текст заявки
    $status = $result['status']; #Статус заявки

    if ($status == "Не выполнена") $color = "$default_color";
    if ($status == "Выполнена") $color = "$close_color";
    if ($status == "Выполнена частично") $color = "$toch_color";
    if ($status == "Архив") $color = "$archive_color";

    echo "<tr bgcolor='{$color}'>";
    echo "<td id='cursor' onclick=\"location.href='?page=detail&id={$id}'\">$id</a></td>";
    echo "<td>$n_date</td>";
    echo "<td>$t_date</td>";
    echo "<td>$category</td>";
    echo "<td>$executor</td>";
    echo "<td>$agreement</td>";
    echo "<td>$location<table class='border' width=100%><tr><td class='border'>$house</td><td class='border'>$driveway</td><td class='border'>$floor</td><td class='border'>$flat</td></tr></table></td>";
    echo "<td><div class='ajax_comment'>$comment</div></td>";
}
echo "</table>";