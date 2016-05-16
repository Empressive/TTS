<?php
#Страница управления оповещениями
$query = mysql_query("SELECT comment_id, staff_name, now_date, comment, status_id FROM announcement INNER JOIN staff_name USING(staff_name_id)");

if(mysql_num_rows($query) > 0)
{
    echo "<form action='/admin/scripts/announce.php' method='post'>";
    echo "<table id='announce_table'>";
    echo "<tr><th width='10%'></th><th width='30%'>Сотрудник</th><th width='25%'>Дата оповещения</th><th>Текст оповещения</th></tr>";

    while($result = mysql_fetch_assoc($query))
    {
        if($result['status_id'] == 1) {
            echo "<tr bgcolor='#cccccc'><td><input disabled type='checkbox' name='id[]' value='{$result['comment_id']}'></td><td>{$result['staff_name']}</td><td>{$result['now_date']}</td><td>{$result['comment']}</td></tr>";
        }
        else echo "<tr bgcolor='#66cc66'><td><input type='checkbox' name='id[]' value='{$result['comment_id']}'></td><td>{$result['staff_name']}</td><td>{$result['now_date']}</td><td>{$result['comment']}</td></tr>";
    }
    echo "<tr bgcolor='#cccccc'><td colspan='4'><input type='submit' value='Закрыть'></td></tr>";
    echo "</table>";
    echo "</form>";
}

