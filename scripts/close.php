<?php
#Закрытие заявки
session_start();
if(isset($_GET['id']) && $_SESSION['user_id'] != 0)
{
    include_once('../library/MVdb.php');
    include_once('../config.php');

    $staff_name = $_SESSION['user_id'];

    $item_id = intval($_GET['id']);

    $status = intval($_POST['status']);
    $reason = intval($_POST['reason']);

    $now_date = date('Y-m-d H:i:s');

    MVdb::connect();

    mysql_query("UPDATE tickets SET status_id = '$status', reason_id = '$reason' WHERE id = '$item_id'");

    $query = mysql_query("SELECT reason FROM reason WHERE reason_id = '$reason'");
    $result = mysql_fetch_assoc($query);

    $reason = $result['reason'];

    mysql_query("INSERT INTO comments VALUES ('$item_id','$now_date','$staff_name','Причина закрытия: $reason','1')");

    setcookie("status", 'success', time() + 1, "/");
    header("Location: {$local}/detail/{$item_id}/");
}
else header("Location: $local/pages/502.html");
