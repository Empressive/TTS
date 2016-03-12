<?php
include ('../config.php');

if(isset($_POST['user_id']) && $_POST['user_id'] != null)
{
    include_once('../library/UnionDB.php');

    echo $id = intval($_POST['user_id']);
    echo $staff_name = htmlspecialchars(trim($_POST['staff_name']));
    echo $status = intval($_POST['status']);

    UnionDB::connectDb();

    mysql_query("UPDATE millwright SET staff_name = '$staff_name', millwright_status_id = '$status' WHERE millwright_id = '$id'");
    header("Location: $local?page=millwright");
}