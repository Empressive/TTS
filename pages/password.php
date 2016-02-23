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
<form action="scripts/password.php" method="post">
    <table class="user_table">
        <tr><th colspan="2">Форма изменения пароля пользователя</th></tr>
        <tr>
            <td width="50%">Логин пользователя:</td>
            <td width="50%"><input id="user_table" type="text" name="login" required></td>
        <tr>
            <td width="50%">Ф.И.О сотрудника:</td>
            <td width="50%"><input id="user_table" type="text" name="user" required></td>
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
            <td colspan="2"><input type="submit" value="Изменить"></td>
        </tr>
    </table>
</form>