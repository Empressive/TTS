<?php

$item_id = intval($_GET['id']);

include_once('../library/UnionDB.php');
UnionDB::connectDb();

echo "<table class='close_table' border='1'>";
echo "<form method='post' action='scripts/close.php?id={$item_id}'>";
echo "<tr><th colspan='2' bgcolor='#ff8c00'>Информация о заявке №$item_id</th></tr>";
echo "<tr><td align='center'>Статус:</td><td align='center'><select name='status'><option value='2'>Выполнена</option></select></td></tr>";
echo "<tr><td align='center'>Причина:</td><td align='center'><select name='reason'>";

$query = mysql_query("SELECT * FROM reason WHERE reason_id != '0'");

while($resault = mysql_fetch_assoc($query))
{
    $reason = $resault['reason'];
    $value = $resault['reason_id'];
    echo "<option value='$value'>$reason</option>";
}

echo "</select></td></tr>";
echo "<tr><td colspan='2'><input type='submit' value='Сохранить'></td></tr>";
echo "</form>";
echo "</table>";
