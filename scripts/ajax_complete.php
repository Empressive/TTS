<?php
#Подгрузка дополнительных заявок методом ajax
include_once('../library/UnionDB.php');

UnionDB::connectDb();

$offset = intval($_POST['offset']);
$limit = intval($_POST['limit']);
$status = intval($_POST['status']);
$category = intval($_POST['category']);
$date = htmlspecialchars(trim($_POST['date']));
$end_date = htmlspecialchars(trim($_POST['end_date']));
$staff_group = intval($_POST['staffGroup']);
$agreement = htmlspecialchars(trim($_POST['agreement']));

if ($agreement == null) $agreement = '0';

if($date < 1 && $end_date <1) $time_date = null;
if($date > 1 && $end_date < 1) $time_date = "AND time_date = {$date}";
if($date < 1 && $end_date > 1) $time_date = null;
if($date > 1 && $end_date > 1) $time_date = "AND time_date between '{$date}' and '{$end_date}'";


if ($status < 1) $status = "ANY(SELECT status_id FROM tickets)";
if ($category < 1) $category = "ANY(SELECT category_id FROM tickets)";
if ($staff_group < 1) $staff_group = "ANY(SELECT staff_group_id FROM tickets)";
if ($agreement < 1) $agreement = "ANY(SELECT agreement FROM tickets)";


$query = mysql_query("SELECT id, time_date, now_date, category, staff_group, agreement, location, house, driveway, floor, flat, comment, status FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE status_id = $status AND category_id = $category AND staff_group_id = $staff_group AND agreement = {$agreement} {$time_date} ORDER BY id DESC limit {$offset},{$limit}");

$res = array();

while ($result = mysql_fetch_assoc($query)) {
    $res[] = $result;
}

echo json_encode($res);
