<?php
#Изменение данных заявки.

session_start();

if(isset($_GET['id']) && $_SESSION['user_id'] != 0)
{
    include_once('../library/MVdb.php');
    include_once('../config.php');

    $item_id = intval($_GET['id']);
    $staff_id = intval($_SESSION['user_id']);

    $time_date = htmlspecialchars(trim($_POST['time_date']));
    $status_id = htmlspecialchars(trim($_POST['status']));
    $category_id = htmlspecialchars(trim($_POST['category']));
    $executor_id = htmlspecialchars(trim($_POST['executor']));
    $location = intval($_POST['location']);
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

    if($millwright1 == $millwright2 && $millwright1 != $millwright3) {
        $millwright2 = $millwright3;
        $millwright3 = 0;
    }
    if($millwright1 == $millwright3 && $millwright1 != $millwright2) {
        $millwright3 = 0;
    }
    if($millwright2 == $millwright3 && $millwright1 != $millwright2) {
        $millwright3 = 0;
    }
    if($millwright2 == $millwright3 && $millwright2 == $millwright1) {
        $millwright2 = 0;
        $millwright3 = 0;
    }
    MVdb::connect();
    $query = mysql_query("SELECT category FROM category WHERE category_id = '$category_id'");
    $result = mysql_fetch_assoc($query);
    $category = $result['category'];

    $query = mysql_query("SELECT staff_group FROM staff_group WHERE staff_group_id = '$executor_id'");
    $result = mysql_fetch_assoc($query);
    $executor = $result['staff_group'];

    $query = mysql_query("SELECT category_id, category, staff_group_id, staff_group, location_id, location, phone, status_id, status, time_date FROM tickets INNER JOIN category USING (category_id) INNER JOIN staff_group USING (staff_group_id) INNER JOIN status USING (status_id) INNER JOIN location USING (location_id) WHERE id = '$item_id'");
    $result = mysql_fetch_assoc($query);

    $db_location_id = $result['location_id'];
    $db_location = $result['location'];
    $db_category_id = $result['category_id'];
    $db_staff_group_id = $result['staff_group_id'];
    $db_status_id = $result['status_id'];
    $db_phone = $result['phone'];
    $db_time_date = $result['time_date'];
    $db_category = $result['category'];
    $db_staff_group = $result['staff_group'];
    $db_status = $result['status'];

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

        if($millwright1 != $db_millwright1 || $millwright2 != $db_millwright2 || $millwright3 != $db_millwright3)
        {
            if($c_millwright1 != null && $c_millwright2 == null && $c_millwright3 == null) $c_millwright1_space = ".";
            if($c_millwright1 != null && $c_millwright2 != null && $c_millwright3 == null) {
                $c_millwright1_space = "-";
                $c_millwright2_space = ".";
            }
            if($c_millwright1 != null && $c_millwright2!= null && $c_millwright3 != null){
                $c_millwright1_space = "-";
                $c_millwright2_space = "-";
                $c_millwright3_space = ".";
            }


            mysql_query("INSERT INTO comments VALUES ('$item_id', '$now_date', '$staff_id', 'Монтажники: $c_millwright1 $c_millwright1_space $c_millwright2 $c_millwright2_space $c_millwright3 $c_millwright3_space', '1')");
        }
    }

    if($db_category_id != $category_id)
    {
        $query = mysql_query("SELECT category FROM category WHERE category_id = $category_id");
        $result = mysql_fetch_assoc($query);
        $c_category = $result['category'];

        mysql_query("INSERT INTO comments VALUES ('$item_id','$now_date','$staff_id','Категория: $db_category -> $c_category.','1')");
    }

    if($db_staff_group_id != $executor_id)
    {
        $query = mysql_query("SELECT staff_group FROM staff_group WHERE staff_group_id = $executor_id");
        $result = mysql_fetch_assoc($query);
        $c_staff_group = $result['staff_group'];

        mysql_query("INSERT INTO comments VALUES ('$item_id','$now_date','$staff_id','Исполнитель: $db_staff_group -> $c_staff_group.','1')");
    }

    if($db_status_id != $status_id && $status_id != 2)
    {
        $query = mysql_query("SELECT status FROM status WHERE status_id = '$status_id'");
        $result = mysql_fetch_assoc($query);
        $c_status = $result['status'];

        mysql_query("INSERT INTO comments VALUES ('$item_id', '$now_date', '$staff_id', 'Статус: $db_status -> $c_status.', '1')");
    }

    if($db_location_id != $location)
    {
        $query = mysql_query("SELECT location FROM location WHERE location_id = '$location'");
        $result = mysql_fetch_assoc($query);
        $c_location = $result['location'];

        mysql_query("INSERT INTO comments VALUES ('$item_id', '$now_date', '$staff_id', 'Сегмент: $db_location -> $c_location.', '1')");
    }

    if($db_phone != $phone)
    {
        mysql_query("INSERT INTO comments VALUES ('$item_id', '$now_date', '$staff_id', 'Телефон: $db_phone -> $phone.', '1')");
    }

    if($db_time_date != $time_date)
    {
        mysql_query("INSERT INTO comments VALUES ('$item_id', '$now_date', '$staff_id', 'Дата: $db_time_date -> $time_date.', '1')");
    }

    if($status_id == 2 && $db_status_id != $status_id) {
        $query = mysql_query("UPDATE tickets SET time_date = '$time_date', category_id = '$category_id', staff_group_id = '$executor_id', location_id = '$location', house = '$house', driveway = '$driveway', floor = '$floor', flat = '$flat', phone = '$phone', comment = '$comment', millwright_1 = '$millwright1', millwright_2 = '$millwright2', millwright_3 = '$millwright3' WHERE id = '$item_id'");
        header("Location: {$local}/close/{$item_id}/");
    }
    else {
        $query = mysql_query("UPDATE tickets SET time_date = '$time_date', status_id = '$status_id', category_id = '$category_id', staff_group_id = '$executor_id', location_id = '$location', house = '$house', driveway = '$driveway', floor = '$floor', flat = '$flat', phone = '$phone', comment = '$comment', millwright_1 = '$millwright1', millwright_2 = '$millwright2', millwright_3 = '$millwright3' WHERE id = '$item_id'");
        setcookie("status", 'success', time() + 1, "/");
        header("Location: {$local}/detail/{$item_id}/");
    }
}
else header("Location: $local/pages/502.html");

