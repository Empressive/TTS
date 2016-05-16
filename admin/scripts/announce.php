<?php
#Закрытие оповещений
include_once('../../config.php');

if (isset($_POST['id']) && $_POST['id'] != null) {

    include_once('../../library/MVdb.php');

    MVdb::connect();

    foreach ($_POST['id'] as $key => $value)
    {
        $query = mysql_query("UPDATE announcement SET status_id = '1' WHERE comment_id = '$value'");
    }

    header("Location: $local");
}
else header("Location: $local/pages/502.html");
