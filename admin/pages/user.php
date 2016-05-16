<form action="/admin/scripts/user.php" method="post">
    <table class="user_table">
        <tr><th colspan="2">Добавление сотрудников в базу</th></tr>
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
                    <?php MVdb::select(staff_group, staff_group, staff_group_id, "WHERE staff_group_id != $all_staff_group and staff_group_id != $archive_staff_group",'staff_group_id') ?>
                </select></td>
        </tr>
        <tr>
            <td width="50%">Права пользователя:</td>
            <td width="50%"><select id="user_table" name="access">
                    <?php MVdb::select(access, access, access_id, '','access_id')?>
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
