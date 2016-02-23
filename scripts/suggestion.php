<?php
session_start();
if(isset($_POST['subject']) && isset($_POST['comment']))
{
    include_once('../library/UnionDB.php');
    include_once('../config.php');

    $staff_id = intval($_SESSION['user_id']);

    $subject = htmlspecialchars(trim($_POST['subject']));
    $comment = htmlspecialchars(trim($_POST['comment']));

    $now_date = date('Y-m-d H:i:s');

    UnionDB::connectDb();

    mysql_query("INSERT INTO suggestion VALUES ('','$now_date','$staff_id','$subject','$comment','3')");

    header("Location: $local?page=support");
}
if(isset($_GET['admin']))
{
    include_once('../library/UnionDB.php');
    include_once('../config.php');

    UnionDB::connectDb();

    foreach ($_POST['id'] as $key => $value)
    {
        $query = mysql_query("SELECT status_id FROM suggestion WHERE suggestion_id = '$value'");
        $resault = mysql_fetch_assoc($query);
        if($resault['status_id'] == 2) mysql_query("UPDATE suggestion SET status_id = '3' WHERE suggestion_id = '$value'");
        if($resault['status_id'] == 3) mysql_query("UPDATE suggestion SET status_id = '4' WHERE suggestion_id = '$value'");
        if($resault['status_id'] == 4) mysql_query("UPDATE suggestion SET status_id = '2' WHERE suggestion_id = '$value'");
    }
    header("Location: $local?page=support");
}