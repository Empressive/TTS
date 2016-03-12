<?php
#Обработка данных методом Ajax
session_start();
if (isset($_POST['limit'])) {

    include_once('../library/UnionDB.php');
    include_once('../config.php');

    UnionDB::connectDb();

    $user_id = $_SESSION['user_id'];

    $limit = intval($_POST['limit']);
    $status = intval($_POST['status']);
    $category = intval($_POST['category']);
    $date = htmlspecialchars(trim($_POST['date']));
    $end_date = htmlspecialchars(trim($_POST['end_date']));
    $staff_group = intval($_POST['staffGroup']);
    $agreement = htmlspecialchars(trim($_POST['agreement']));
    $now_date = date('Y-m-d');

    mysql_query("UPDATE staff_login SET status_id = {$status}, category_id = {$category}, group_id = {$staff_group}, time_date = '$date', agreement = '$agreement' WHERE id = {$user_id}");

    if ($agreement == null) $agreement = '0';

    if($date < 1 && $end_date < 1) $time_date = null;
    if($date > 1 && $end_date < 1) $time_date = "AND time_date = '$date'";
    if($date < 1 && $end_date > 1) $time_date = "AND time_date = '$end_date'";
    if($date > 1 && $end_date > 1) $time_date = "AND time_date between '{$date}' and '{$end_date}'";

    if ($status < 1) $status = "ANY(SELECT status_id FROM tickets)";
    if ($category < 1) $category = "ANY(SELECT category_id FROM tickets)";
    if ($staff_group < 1) $staff_group = "ANY(SELECT staff_group_id FROM tickets)";
    if ($agreement < 1) $agreement = "ANY(SELECT agreement FROM tickets)";

    $query = mysql_query("SELECT * FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE status_id = $status AND category_id = $category AND staff_group_id = $staff_group AND agreement = {$agreement} $time_date ORDER BY id DESC limit {$limit}");

    $rows = mysql_query("SELECT id FROM tickets WHERE status_id = {$status} AND category_id = {$category} AND staff_group_id = {$staff_group} AND agreement = {$agreement} $time_date");

    $staff_group_id = mysql_query("SELECT staff_group_id FROM staff_login WHERE id = $user_id");

    $result = mysql_fetch_assoc($staff_group_id);

    $staff_id = $result['staff_group_id'];

    $staff_rows = mysql_query("SELECT id FROM tickets WHERE status_id != 0 and status_id != 1 and status_id != 2 and  staff_group_id = $staff_id and time_date BETWEEN '0000-00-00' and '$now_date'");

    $staff_row = mysql_num_rows($staff_rows);

    $result = mysql_num_rows($rows);

    echo "<table class='main_table' id='main_table' border='1'>";

    echo "<tr><th colspan='9'>Количество заявок: $result</th><input type='text' value='$result' id='num_rows' hidden><input type='text' value='$staff_row' hidden id='staff_rows'></tr>";
    echo "<tr bgcolor='#339999'>";
    echo "<td width='3%'><input type='checkbox' id='check'></td>";
    echo "<td width='9%' id='td_color'>Номер заявки</td>";
    echo "<td width='10%' id='td_color'>Дата принятия</td>";
    echo "<td width='10%' id='td_color'>Дата выполнения</td>";
    echo "<td width='12%' id='td_color'>Категория</td>";
    echo "<td width='12%' id='td_color'>Исполнитель</td>";
    echo "<td width='6%' id='td_color'>Договор</td>";
    echo "<td width='15%' id='td_color'>Адрес<table class='border' width=100%><tr><td class='td_color'>дом</td><td class='td_color'>под.</td><td class='td_color'>эт.</td><td class='td_color'>кв.</td></tr></table></td>";
    echo "<td width='23%' id='td_color'>Комментарий</td>";
    echo "</tr>";

    while ($row = mysql_fetch_assoc($query)) {
        $id = $row['id']; #id заявки
        $t_date = $row['time_date']; #Дата выполнения заявки
        $n_date = $row['now_date']; #Дата получаения заявки
        $category = $row['category']; #Категория
        $executor = $row['staff_group']; #Исполнитель
        $agreement = $row['agreement']; #Номер договора
        $location = $row['location']; #Сегмент
        $house = $row['house']; #Дом
        $driveway = $row['driveway']; #Подъезд
        $floor = $row['floor']; #Этаж
        $flat = $row['flat'];  #Квартира
        $comment = $row['comment']; #Текст заявки
        $status = $row['status']; #Статус заявки

        if ($status == "Не выполнена") $color = "$default_color";
        if ($status == "Выполнена") $color = "$close_color";
        if ($status == "Выполнена частично") $color = "$toch_color";
        if ($status == "Архив") $color = "$archive_color";

        echo "<tr bgcolor='{$color}'>";
        echo "<td><input id='checkbox' type='checkbox' name='id[]' value='$id'></td>";
        echo "<td id='cursor' onclick=\"location.href='?page=detail&id={$id}'\">$id</a></td>";
        echo "<td>$n_date</td>";
        echo "<td>$t_date</td>";
        echo "<td>$category</td>";
        echo "<td>$executor</td>";
        echo "<td>$agreement</td>";
        echo "<td>$location<table class='border' width=100%><tr><td class='border'>$house</td><td class='border'>$driveway</td><td class='border'>$floor</td><td class='border'>$flat</td></tr></table></td>";
        echo "<td><div class='ajax_comment'>$comment</div></td>";
    }
    echo "</table>";
}
else echo "<div class='alert'>Ошибка !</div>";
