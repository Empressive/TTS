<?php
#Форма добавления пользователей(сотрудников) в базу
include_once('library/UnionDB.php');

if (include('config.php')) {
    if (isset($this->user_access)) {
        $access = $this->user_access;

        if ($access < 3) header("Location: $local/pages/403.html");
    }
}

if(isset($_GET['id']) && $_GET['id'] != null) $hide = 'hidden';

$query = mysql_query("SELECT millwright_id, staff_name, millwright_status FROM millwright INNER JOIN millwright_status USING (millwright_status_id)");

echo "<table $hide class='union_pointer'>";
echo "<th>ID</th><th>Ф.И.О. сотрудника</th><th>Статус</th>";
while ($result = mysql_fetch_assoc($query)) {
    $id = $result['millwright_id'];
    $staff_name = $result['staff_name'];
    $status = $result['millwright_status'];
    echo "<tr id='staff_edit' onclick=\"location.href='?page=millwright&id=$id'\"><td>$id</td><td>$staff_name</td><td>$status</td></tr>";
}
echo "</table>";

if(isset($_GET['id']) && $_GET['id'] != null) {

    $id = intval($_GET['id']);

    $query = mysql_query("SELECT millwright_id, staff_name, millwright_status, millwright_status_id FROM millwright INNER JOIN millwright_status USING (millwright_status_id) WHERE millwright_id = $id");

    if(mysql_num_rows($query) > 0)
    {
    $result = mysql_fetch_assoc($query);

    $staff_name = $result['staff_name'];
    $status = $result['millwright_status'];
    $status_id = $result['millwright_status_id'];

        echo "<form action='../scripts/millwright.php' method='post'>";
        echo "<table class='union'>";
        echo "<tr><th colspan='2'>Информация о сотруднике</th></tr>";
        echo "<tr><td>Идентификатор сотрудника</td><td><input name='user_id' type='text' value='$id' hidden>$id</td></tr>";
        echo "<tr><td>Ф.И.О сотрудника</td><td><input type='text' value='$staff_name' name='staff_name' required></td></tr>";
        echo "<tr><td>Статус сотрудника</td><td><select name='status'><option value='$status_id'>$status</option>";

        UnionDB::select(millwright_status,millwright_status,millwright_status_id,"WHERE millwright_status_id != $status_id",'millwright_status_id');

        echo "</select></tr>";
        echo "<tr><td colspan='2'><input type='submit' value='Сохранить'></td></tr>";
        echo "</table>";
        echo "</form>";
     }
}
