<?php
#Изменение данных заявки.

session_start();

if(isset($_GET['id']))
{
    include_once('../library/UnionDB.php');
    include_once('../config.php');

    $item_id = intval($_GET['id']);
    $staff_id = intval($_SESSION['user_id']);

    $time_date = htmlspecialchars(trim($_POST['time_date']));
    $status_id = htmlspecialchars(trim($_POST['status']));
    $category_id = htmlspecialchars(trim($_POST['category']));
    $executor_id = htmlspecialchars(trim($_POST['executor']));
    $house = htmlspecialchars(trim($_POST['house']));
    $driveway = htmlspecialchars(trim($_POST['driveway']));
    $floor = htmlspecialchars(trim($_POST['floor']));
    $flat = htmlspecialchars(trim($_POST['flat']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $comment = htmlspecialchars(trim($_POST['comment1']));

    $now_date = date('Y-m-d H:i:s');

    $millwright1 = intval($_POST['millwright1']);

    $millwright2 = intval($_POST['millwright2']);

    $millwright3 = intval($_POST['millwright3']);

    UnionDB::connectDb();
    $query = mysql_query("SELECT category FROM category WHERE category_id = '$category_id'");
    $result = mysql_fetch_assoc($query);
    $category = $result['category'];

    $query = mysql_query("SELECT staff_group FROM staff_group WHERE staff_group_id = '$executor_id'");
    $result = mysql_fetch_assoc($query);
    $executor = $result['staff_group'];

    $query = mysql_query("SELECT category_id, staff_group_id FROM tickets WHERE id = '$item_id'");
    $result = mysql_fetch_assoc($query);

    $db_category_id = $result['category_id'];
    $db_staff_group_id = $result['staff_group_id'];

    $query = mysql_query("SELECT millwright_1, millwright_2, millwright_3 FROM tickets WHERE id = '$item_id'");
    $result = mysql_fetch_assoc($query);

    $db_millwright1 = $result['millwright_1'];
    $db_millwright2 = $result['millwright_2'];
    $db_millwright3 = $result['millwright_3'];

    if($millwright1 != $db_millwright1 || $millwright2 != $db_millwright2 || $millwright3 != $db_millwright3)
    {
        $query = mysql_query("SELECT staff_name FROM millwright WHERE millwright_id = '$millwright1'");
        $result = mysql_fetch_assoc($query);
        $c_millwright1 = $result['staff_name'];

        $query = mysql_query("SELECT staff_name FROM millwright WHERE millwright_id = '$millwright2'");
        $result = mysql_fetch_assoc($query);
        $c_millwright2 = $result['staff_name'];

        $query = mysql_query("SELECT staff_name FROM millwright WHERE millwright_id = '$millwright3'");
        $result = mysql_fetch_assoc($query);
        $c_millwright3 = $result['staff_name'];

        mysql_query("INSERT INTO comments VALUES ('$item_id', '$now_date', '$staff_id', 'Монтажники: $c_millwright1 $c_millwright2 $c_millwright3', '1')");
    }

    if($db_category_id !== $category_id)
    {
        if($db_staff_group_id !== $executor_id)
        {
            mysql_query("INSERT INTO comments VALUES ('$item_id', '$now_date', '$staff_id', 'Категория: $category. Исполнитель: $executor.', '1')");
        }
        else mysql_query("INSERT INTO comments VALUES ('$item_id','$now_date','$staff_id','Категория: $category.','1')");
    } elseif($db_staff_group_id !== $executor_id) mysql_query("INSERT INTO comments VALUES ('$item_id','$now_date','$staff_id','Исполнитель: $executor.','1')");

    if($status_id == 2) {

        $query = mysql_query("UPDATE tickets SET time_date = '$time_date', category_id = '$category_id', staff_group_id = '$executor_id', house = '$house', driveway = '$driveway', floor = '$floor', flat = '$flat', phone = '$phone', comment = '$comment', millwright_1 = '$millwright1', millwright_2 = '$millwright2', millwright_3 = '$millwright3' WHERE id = '$item_id'");
        header("Location: {$local}/?page=close&id={$item_id}");
    }

    else {
        $query = mysql_query("UPDATE tickets SET time_date = '$time_date', status_id = '$status_id', category_id = '$category_id', staff_group_id = '$executor_id', house = '$house', driveway = '$driveway', floor = '$floor', flat = '$flat', phone = '$phone', comment = '$comment', millwright_1 = '$millwright1', millwright_2 = '$millwright2', millwright_3 = '$millwright3' WHERE id = '$item_id'");
        header("Location: {$local}/?page=detail&id={$item_id}");
    }
}
else echo "<div class='alert'>Идентификатор не передан !</div>";
