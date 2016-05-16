<?php
#Уведомление о незакрытых заявках
$user_id = intval($_SESSION['user_id']);
$now_date = date('Y-m-d');


$query = mysql_query("SELECT staff_group_id FROM staff_login WHERE id = $user_id");
$result = mysql_fetch_assoc($query);

$staff_rows = mysql_query("SELECT id, now_date, time_date, category, staff_group, agreement, location, house, driveway, floor, flat, comment, status FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE status_id != $all_ticket and status_id != $archive_ticket and status_id != $close_ticket and  staff_group_id = {$result['staff_group_id']} and time_date BETWEEN '0000-00-00' and '$now_date'");
$rows = mysql_num_rows($staff_rows);

echo "<table class='main_table' id='main_table' border='1'>";

echo "<tr><th colspan='9'>Количество заявок: $rows</th></tr>";
echo "<tr bgcolor='#339999'>";
echo "<td width='9%' id='td_color'>Номер заявки</td>";
echo "<td width='10%' id='td_color'>Дата принятия</td>";
echo "<td width='10%' id='td_color'>Дата выполнения</td>";
echo "<td width='12%' id='td_color'>Категория</td>";
echo "<td width='12%' id='td_color'>Исполнитель</td>";
echo "<td width='6%' id='td_color'>Договор</td>";
echo "<td width='15%' id='td_color'>Адрес<table class='border' width=100%><tr><td class='td_color'>дом</td><td class='td_color'>под.</td><td class='td_color'>эт.</td><td class='td_color'>кв.</td></tr></table></td>";
echo "<td width='23%' id='td_color'>Комментарий</td>";
echo "</tr>";

while ($result = mysql_fetch_assoc($staff_rows)) {

    if ($result['status'] == "Не выполнена") $color = "$default_color";
    if ($result['status'] == "Выполнена") $color = "$close_color";
    if ($result['status'] == "Выполнена частично") $color = "$toch_color";
    if ($result['status'] == "Архив") $color = "$archive_color";

    echo "<tr bgcolor='{$color}'>";
    echo "<td id='cursor' onclick=\"location.href='/detail/{$result['id']}/'\">{$result['id']}</a></td>";
    echo "<td>{$result['now_date']}</td>";
    echo "<td>{$result['time_date']}</td>";
    echo "<td>{$result['category']}</td>";
    echo "<td>{$result['staff_group']}</td>";
    echo "<td>{$result['agreement']}</td>";
    echo "<td>{$result['location']}<table class='border' width=100%><tr><td class='border'>{$result['house']}</td><td class='border'>{$result['driveway']}</td><td class='border'>{$result['floor']}</td><td class='border'>{$result['flat']}</td></tr></table></td>";
    echo "<td><div class='ajax_comment'>{$result['comment']}</div></td>";
}
echo "</table>";