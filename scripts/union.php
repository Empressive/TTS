
<?php
    if (isset($_POST['value']) && isset($_POST['value2']) && isset($_GET['name']) && $_POST['value'] !== null) {

        include('../config.php');
        include_once("../library/UnionDB.php");

        $db_part = htmlspecialchars(trim($_GET['name']));
        $value = htmlspecialchars(trim($_POST['value']));
        $value2 = htmlspecialchars(trim($_POST['value2']));

        if ($value == $value2)
        {
            UnionDB::connectDb();

            mysql_query("INSERT INTO $db_part VALUES ('', '$value')");
            header("Location: $local?page=control");
        } else header("Location: $local/pages/502.html");
    } else header("Location: $local/pages/502.html");
