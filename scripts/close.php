<?php
session_start();
if(isset($_GET['id']))
{
    include_once('../library/UnionDB.php');
    include_once('../config.php');

    $staff_name = $_SESSION['user_id'];

    $item_id = intval($_GET['id']);

    $status = intval($_POST['status']);
    $reason = intval($_POST['reason']);

    $now_date = date('Y-m-d H:i:s');

    UnionDB::connectDb();

    mysql_query("UPDATE tickets SET status_id = '$status', reason_id = '$reason' WHERE id = '$item_id'");

    $query = mysql_query("SELECT reason FROM reason WHERE reason_id = '$reason'");
    $result = mysql_fetch_assoc($query);

    $reason = $result['reason'];

    mysql_query("INSERT INTO comments VALUES ('$item_id','$now_date','$staff_name','Причина закрытия: $reason','1')");

    header("Location: {$local}/?page=detail&status=success&id={$item_id}");
}
else header("Location: $local/pages/502.html");
