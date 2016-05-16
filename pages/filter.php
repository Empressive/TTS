<?php
#Фильтр заявок по договору выбранному в развернутой заявке.
if(isset($_GET['id']))
{
    $id = htmlspecialchars(trim($_GET['id']));
    
    $c_id = str_replace('-','/',$id);

    $query = mysql_query("SELECT id, time_date,now_date, category, staff_group, agreement, location, house, driveway, floor, flat, comment, status FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE agreement = '$c_id' ORDER BY id DESC limit 50");

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

    while ($result = mysql_fetch_assoc($query)) {
        if ($result['status'] == "Не выполнена") $color = "$default_color";
        if ($result['status'] == "Выполнена") $color = "$close_color";
        if ($result['status'] == "Выполнена частично") $color = "$toch_color";
        if ($result['status'] == "Архив") $color = "$archive_color";

        echo "<tr bgcolor='{$color}'>";
        echo "<td id='cursor' onclick=\"location.href='/detail/{$result['id']}/'\">{$result['id']}</td>";
        echo "<td>{$result['time_date']}</td>";
        echo "<td>{$result['now_date']}</td>";
        echo "<td>{$result['category']}</td>";
        echo "<td>{$result['staff_group']}</td>";
        echo "<td>{$result['agreement']}</td>";
        echo "<td>{$result['location']}<table class='border' width=100%><tr><td class='border'>{$result['house']}</td><td class='border'>{$result['driveway']}</td><td class='border'>{$result['floor']}</td><td class='border'>{$result['flat']}</td></tr></table></td>";
        echo "<td>{$result['comment']}</td>";
    }
    echo "</table>";
}
