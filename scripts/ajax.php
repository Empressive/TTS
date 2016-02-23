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
    $staff_group = intval($_POST['staffGroup']);
    $agreement = htmlspecialchars(trim($_POST['agreement']));

    mysql_query("UPDATE staff_login SET status_id = {$status}, category_id = {$category}, staff_group_id = {$staff_group} WHERE id = {$user_id}");

    $time_date = "AND time_date = '$date'";

    if ($agreement == null) $agreement = '0';

    if ($date < 1) $time_date = null;
    if ($status < 1) $status = "ANY(SELECT status_id FROM tickets)";
    if ($category < 1) $category = "ANY(SELECT category_id FROM tickets)";
    if ($staff_group < 1) $staff_group = "ANY(SELECT staff_group_id FROM tickets)";
    if ($agreement < 1) $agreement = "ANY(SELECT agreement FROM tickets)";

    $query = mysql_query("SELECT * FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE status_id = $status AND category_id = $category AND staff_group_id = $staff_group AND agreement = {$agreement} $time_date ORDER BY id DESC limit {$limit}");

    echo "<table class='main_table' id='main_table' border='1'>";

    echo "<tr>";
    echo "<th width='3%'><input type='checkbox' id='check'></th>";
    echo "<th width='9%'>Номер заявки</th>";
    echo "<th width='10%'>Дата принятия</th>";
    echo "<th width='10%'>Дата выполнения</th>";
    echo "<th width='12%'>Категория</th>";
    echo "<th width='12%'>Исполнитель</th>";
    echo "<th width='6%'>Договор</th>";
    echo "<th width='15%'>Адрес<table class='border' width=100%><tr><td class='td_color'>дом</td><td class='td_color'>под.</td><td class='td_color'>эт.</td><td class='td_color'>кв.</td></tr></table></th>";
    echo "<th width='23%'>Комментарий</th>";
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
        echo "<td><div class='test'>$comment</div></td>";
    }
    echo "</table>";
}
else echo "<div class='alert'>Ошибка !</div>";
