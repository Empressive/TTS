<?php
#Форма добавления пользователей(сотрудников) в базу
include_once ('library/UnionDB.php');

if (include('config.php'))
{
    if (isset($this->user_access))
    {
        $access = $this->user_access;

        if($access < 3) header("Location: $local");
    }
}
?>
<form action="scripts/user.php" method="post">
    <table class="user_table">
        <tr><th colspan="2">Форма добавления сотрудников в базу</th></tr>
        <tr>
            <td width="50%">Логин пользователя:</td>
            <td width="50%"><input id="user_table" type="text" name="login" required></td>
        <tr>
            <td width="50%">Ф.И.О сотрудника:</td>
            <td width="50%"><input id="user_table" type="text" name="user" required></td>
        </tr>
        <tr>
            <td width="50%">Группа пользователя:</td>
            <td width="50%"><select id="user_table" name="group">
                    <?php UnionDB::select(staff_group, staff_group, staff_group_id, 'WHERE staff_group_id != 0 and staff_group_id != 1','staff_group_id') ?>
                </select></td>
        </tr>
        <tr>
            <td width="50%">Права пользователя:</td>
            <td width="50%"><select id="user_table" name="access">
                    <?php UnionDB::select(access, access, access_id, '','access_id')?>
                </select></td>
        </tr>
        <tr>
            <td width="50%">Пароль:</td>
            <td width="50%"><input id="user_table" name="passw" type="password" required></td>
        </tr>
        <tr>
            <td width="50%">Подтвердите пароль:</td>
            <td width="50%"><input id="user_table" name="passw2" type="password" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Добавить"></td>
        </tr>
    </table>
</form>
