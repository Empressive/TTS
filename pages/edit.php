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

$query = mysql_query("SELECT id, login, staff_name FROM staff_login");

echo "<table $hide class='union_pointer'>";
echo "<th>ID</th><th>Логин</th><th>Ф.И.О сотрудника</th>";
while ($result = mysql_fetch_assoc($query)) {
    $id = $result['id'];
    $login = $result['login'];
    $staff_name = $result['staff_name'];

    echo "<tr id='staff_edit' onclick=\"location.href='?page=edit&id=$id'\"><td>$id</td><td>$login</td><td>$staff_name</td></tr>";
}
echo "</table>";

if(isset($_GET['id']) && $_GET['id'] != null) {
    include_once ('../library/UnionDB.php');

    $user_id = intval($_GET['id']);

    $query = mysql_query("SELECT id, login, staff_name, staff_group, staff_group_id, access, access_id FROM staff_login INNER JOIN staff_group USING(staff_group_id) INNER JOIN access USING(access_id) WHERE id = {$user_id}");
    $result = mysql_fetch_assoc($query);

    $id = $result['id'];
    $login = $result['login'];
    $staff_name = $result['staff_name'];
    $staff_group = $result['staff_group'];
    $staff_group_id = $result['staff_group_id'];
    $access = $result['access'];
    $access_id = $result['access_id'];

    if(mysql_num_rows($query) > 0){
        echo "<form action='../scripts/access.php' method='post'>";
        echo "<table class='union'>";
        echo "<tr><th colspan='2'>Информация о сотруднике</th></tr>";
        echo "<tr><td>Идентификатор сотрудника</td><td><input name='user_id' type='text' value='$id' hidden>$id</td></tr>";
        echo "<tr><td>Логин сотрудника</td><td><input type='text' value='$login' name='login' required></td></tr>";
        echo "<tr><td>Ф.И.О сотрудника</td><td><input type='text' value='$staff_name' name='staff_name' required></td></tr>";
        echo "<tr><td>Группа сотрудника</td><td><select name='staff_group'><option value='$staff_group_id'>$staff_group</option>";
        UnionDB::select(staff_group,staff_group, staff_group_id,"WHERE staff_group_id != $staff_group_id and staff_group_id != 0 and staff_group_id != 1",'staff_group_id');
        echo "</select></tr>";
        echo "<tr><td>Доступ сотрудника</td><td><select name='access'><option value='$access_id'>$access</option>";
        UnionDB::select(access,access,access_id,"WHERE access_id != $access_id",'access_id');
        echo "</select></tr>";
        echo "<tr><td>Пароль</td><td><input name='passw' type='password' width='100%' height='25px'></td></tr>";
        echo "<tr><td>Повторите пароль</td><td><input name='passw2' type='password'></td></tr>";
        echo "<tr><td colspan='2'><input type='submit' value='Сохранить'></td></tr>";
        echo "</table>";
        echo "</form>";
    }
}