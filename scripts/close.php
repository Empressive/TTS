<?php
if(isset($_GET['id']))
{
    include_once('../library/UnionDB.php');
    include_once('../config.php');

    $item_id = intval($_GET['id']);

    $status = intval($_POST['status']);
    $reason = intval($_POST['reason']);

    UnionDB::connectDb();

    mysql_query("UPDATE tickets SET status_id = '$status', reason_id = '$reason' WHERE id = '$item_id'");

    header("Location: {$local}/?page=detail&id={$item_id}");
}
else echo "<div class='alert'>Идентификатор не передан</div>";