<?php
include_once('../config.php');

if (isset($_POST['id']) && $_POST['id'] != null) {

    include_once('../library/UnionDB.php');

    UnionDB::connectDb();

    foreach ($_POST['id'] as $key => $value)
    {
        $query = mysql_query("UPDATE announcement SET status_id = '1' WHERE comment_id = '$value'");
    }

    header("Location: $local");
}