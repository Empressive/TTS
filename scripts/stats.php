<?php

include_once('../library/UnionDB.php');
include_once('../config.php');

$location = $_POST['location'];
$category = $_POST['category'];
$date = $_POST['date'];
$end_date = $_POST['end_date'];
$status_id = $_POST['status'];

if(isset($date) && isset($end_date) && $date != null && $end_date != null)
{
    $time = "and time_date between '$date' and '$end_date'";
}
else $time = null;

if($location < 1)
{
    $location = "ANY(SELECT location_id FROM tickets)";
}

UnionDB::connectDb();

$query = mysql_query("SELECT id FROM tickets WHERE location_id = {$location} and category_id = '$category' $time and status_id !=1");
$all = mysql_num_rows($query);

$query = mysql_query("SELECT id FROM tickets WHERE location_id = {$location} and category_id = '$category' $time and status_id = 2");
$close = mysql_num_rows($query);

$query = mysql_query("SELECT id FROM tickets WHERE location_id = {$location} and category_id = '$category' $time and status_id = 3");
$other = mysql_num_rows($query);

$query = mysql_query("SELECT id FROM tickets WHERE location_id = {$location} and category_id = '$category' $time and status_id = 4");
$touch = mysql_num_rows($query);

$query = mysql_query("SELECT id, time_date, now_date, category, staff_group, location, house, driveway, floor, flat, comment, status FROM tickets INNER JOIN category USING(category_id) INNER JOIN staff_group USING(staff_group_id) INNER JOIN location USING(location_id) INNER JOIN status USING(status_id) WHERE location_id = {$location} and category_id = '$category' $time and status_id = '$status_id'");

echo "<table class='main_table' id='main_table' border='1'>";
echo "<tr ><th colspan='2'>Количество заявок: $all</th><th colspan='2'>Количество выполненных: $close</th><th colspan='2'>Количество не выполненных: $other</th><th colspan='1'>Количество выполненных частично: $touch</th></tr>";
echo "<tr bgcolor='#339999'>";
echo "<td width='9%' id='td_color'>Номер заявки</td>";
echo "<td width='10%' id='td_color'>Дата принятия</td>";
echo "<td width='10%' id='td_color'>Дата выполнения</td>";
echo "<td width='12%' id='td_color'>Категория</td>";
echo "<td width='12%' id='td_color'>Исполнитель</td>";
echo "<td width='15%' id='td_color'>Адрес<table class='border' width=100%><tr><td class='td_color'>дом</td><td class='td_color'>под.</td><td class='td_color'>эт.</td><td class='td_color'>кв.</td></tr></table></td>";
echo "<td width='23%' id='td_color'>Комментарий</td>";
echo "</tr>";
while($result = mysql_fetch_assoc($query)){
    $id = $result['id'];
    $now_date = $result['now_date'];
    $time_date = $result['time_date'];
    $category = $result['category'];
    $staff_group = $result['staff_group'];
    $location = $result['location'];
    $house = $result['house'];
    $driveway = $result['driveway'];
    $floor = $result['floor'];
    $flat = $result['flat'];
    $comment = $result['comment'];
    $status = $result['status'];

    if ($status == "Не выполнена") $color = "$default_color";
    if ($status == "Выполнена частично") $color = "$toch_color";
    if ($status == "Выполнена") $color = "$close_color";

    echo "<tr bgcolor='{$color}'>";
    echo "<td id='cursor' onclick=\"window.open('?page=detail&id={$id}')\">$id</a></td>";
    echo "<td>$now_date</td>";
    echo "<td>$time_date</td>";
    echo "<td>$category</td>";
    echo "<td>$staff_group</td>";
    echo "<td>$location<table class='border' width=100%><tr><td class='border'>$house</td><td class='border'>$driveway</td><td class='border'>$floor</td><td class='border'>$flat</td></tr></table></td>";
    echo "<td>$comment</td>";
}
echo "</table>";