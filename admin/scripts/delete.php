<?php
#Удаление данных (причины, категории...) из базы
include_once('../../config.php');
include_once('../../library/MVdb.php');

if(isset($_POST['value']) && $_POST['value'] != null)
{
    MVdb::connect();

    $id = intval($_POST['value']);
    $db = htmlspecialchars(trim($_POST['db']));
    $db_value = htmlspecialchars(trim($_POST['db_value']));

    mysql_query("DELETE FROM $db WHERE $db_value = $id");

    header("Location: $local/admin/union/$db/");
}
else header("Location: $local/pages/502.html");