<html>
<meta charset="utf-8">
<?php
session_start();

include_once('../config.php');

if(isset($_POST['comment']) && $_POST['comment'] != null) {

    include_once('../library/UnionDB.php');

    UnionDB::connectDb();

    $user_id = $_SESSION['user_id'];
    $comment = htmlspecialchars(trim($_POST['comment']));
    $now_date = date('Y-m-d H:i:s');
    $comment_type_id = '3';

    $query = mysql_query("SELECT status_id FROM announcement WHERE status_id != 1");
    if(mysql_numrows($query) < 3) {
        mysql_query("INSERT INTO announcement VALUES ('', '$user_id', '$now_date', '$comment', '$comment_type_id', '')");
        header("Location: $local");
    }
    echo "Число оповещений больше трех, закройте предыдущие оповещения !";
} header("Location: $local");
?>
</html>
