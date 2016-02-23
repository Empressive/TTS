<?php
if(isset($_GET['id']))
{
    $id = intval($_GET['id']);
    $query = mysql_query("SELECT id, time_date,now_date, category, staff_group, agreement, location, house, driveway, floor, flat, comment, status FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE agreement = '$id' ORDER BY id DESC limit 50");

    echo "<table class='main_table' id='main_table' border='1'>";
    echo "<tr>";
    echo "<th width='9%'>Номер заявки</th>";
    echo "<th width='10%'>Дата выполнения</th>";
    echo "<th width='10%'>Дата принятия</th>";
    echo "<th width='12%'>Категория</th>";
    echo "<th width='12%'>Исполнитель</th>";
    echo "<th width='6%'>Договор</th>";
    echo "<th  width='15%'>Адрес<table class='border' width=100%><tr><td class='td_color'>дом</td><td class='td_color'>под.</td><td class='td_color'>эт.</td><td class='td_color'>кв.</td></tr></table></th>";
    echo "<th width='26%'>Комментарий</th>";
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
        echo "<td id='cursor' onclick=\"location.href='?page=detail&id={$id}'\">$id</td>";
        echo "<td>$t_date</td>";
        echo "<td>$n_date</td>";
        echo "<td>$category</td>";
        echo "<td>$executor</td>";
        echo "<td>$agreement</td>";
        echo "<td>$location<table class='border' width=100%><tr><td class='border'>$house</td><td class='border'>$driveway</td><td class='border'>$floor</td><td class='border'>$flat</td></tr></table></td>";
        echo "<td>$comment</td>";
    }
    echo "</table>";
}