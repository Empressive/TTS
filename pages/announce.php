<?php
#Страница управления оповещениями

if (include('config.php'))

{
    if (isset($this->user_access))
    {
        $access = $this->user_access;
        if($access < 2) header("Location: $local");
    }
}
?>
<form action="../scripts/announce.php" method="post">
<?php

include_once ('library/UnionDB.php');

UnionDB::connectDb();

$query = mysql_query("SELECT comment_id, staff_name, now_date, comment, status_id FROM announcement INNER JOIN staff_name USING(staff_name_id)");

if(mysql_num_rows($query) > 0)
{
    echo "<table id='announce_table'>";
    echo "<tr><th width='10%'></th><th width='30%'>Сотрудник</th><th width='25%'>Дата оповещения</th><th>Текст оповещения</th></tr>";

    while($result = mysql_fetch_assoc($query))
    {

        $status_id = $result['status_id'];
        $id = $result['comment_id'];
        $staff_name = $result['staff_name'];
        $now_date = $result['now_date'];
        $comment = $result['comment'];

        if($status_id == 1) {
            echo "<tr bgcolor='#cccccc'><td><input disabled type='checkbox' name='id[]' value='$id'></td><td>$staff_name</td><td>$now_date</td><td>$comment</td></tr>";
        }
        else echo "<tr bgcolor='#66cc66'><td><input type='checkbox' name='id[]' value='$id'></td><td>$staff_name</td><td>$now_date</td><td>$comment</td></tr>";

    }
    echo "<tr bgcolor='#cccccc'><td colspan='4'><input type='submit' value='Закрыть'></td></tr>";
    echo "</table>";;
}
?>
</form>