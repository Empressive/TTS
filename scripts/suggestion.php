<?php
#Изменение статуса предложений
session_start();
if(isset($_POST['subject']) && isset($_POST['comment']))
{
    include_once('../library/MVdb.php');
    include_once('../config.php');

    $staff_id = intval($_SESSION['user_id']);

    $subject = htmlspecialchars(trim($_POST['subject']));
    $comment = htmlspecialchars(trim($_POST['comment']));

    $now_date = date('Y-m-d H:i:s');

    MVdb::connect();

    mysql_query("INSERT INTO suggestion VALUES ('','$now_date','$staff_id','$subject','$comment','$open_ticket')");

    header("Location: $local/support/");
}
if(isset($_GET['admin']))
{
    include_once('../library/MVdb.php');
    include_once('../config.php');

    MVdb::connect();

    foreach ($_POST['id'] as $key => $value)
    {
        $query = mysql_query("SELECT status_id FROM suggestion WHERE suggestion_id = '$value'");
        $result = mysql_fetch_assoc($query);
        if($result['status_id'] == 2) mysql_query("UPDATE suggestion SET status_id = $open_ticket WHERE suggestion_id = '$value'");
        if($result['status_id'] == 3) mysql_query("UPDATE suggestion SET status_id = $touch_ticket WHERE suggestion_id = '$value'");
        if($result['status_id'] == 4) mysql_query("UPDATE suggestion SET status_id = $close_ticket WHERE suggestion_id = '$value'");
    }
    header("Location: $local/support/");
}