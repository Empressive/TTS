<html>
<meta charset="utf-8">
<?php
if (include('../config.php')) {
    if (isset($_POST['value']) && isset($_POST['value2']) && isset($_GET['name']) && $_POST['value'] !== null) {

        include_once("../library/UnionDB.php");

        $db_part = htmlspecialchars(trim($_GET['name']));
        $value = htmlspecialchars(trim($_POST['value']));
        $value2 = htmlspecialchars(trim($_POST['value2']));

        if ($value == $value2)
        {
echo "test";
            UnionDB::connectDb();

            mysql_query("INSERT INTO $db_part VALUES ('', '$value')");
            header("Location: $local?page=control");
        }

        else echo "<div class='alert'>Значения не совпадают !</div>";
    }
    else echo "Ошибка ввода !";
}
?>
</html>
