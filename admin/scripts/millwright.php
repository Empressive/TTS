<?php
#Редактирование монтажника
include ('../../config.php');

if(isset($_POST['user_id']) && $_POST['user_id'] != null)
{
    include_once('../../library/MVdb.php');

    echo $id = intval($_POST['user_id']);
    echo $staff_name = htmlspecialchars(trim($_POST['staff_name']));
    echo $status = intval($_POST['status']);

    MVdb::connect();

    mysql_query("UPDATE millwright SET staff_name = '$staff_name', millwright_status_id = '$status' WHERE millwright_id = '$id'");
    header("Location: $local/admin/millwright/");
}