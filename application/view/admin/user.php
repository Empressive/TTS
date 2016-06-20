<form action='<?= URL . 'admin/user/edit/' ?>' method='post'>
    <table class='mid_table'>
        <tr>
            <th colspan='2'>Добавление сотрудников в базу</th>
        </tr>
        <tr>
            <td>Логин пользователя</td>
            <td><input type='text' name='login' required></td>
        </tr>
        <tr>
            <td>Ф.И.О сотрудника</td>
            <td><input type='text' name='username' required></td>
        </tr>
        <tr>
            <td>Группа пользователя</td>
            <td>
                <select name='staff_group'>
                    <? foreach ($staff_groups as $staff_group) : ?>
                        <option
                            value='<?= $staff_group['staff_group_id'] ?>'><?= $staff_group['staff_group'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Права пользователя</td>
            <td>
                <select name='access'>
                    <? foreach ($accesses as $access) : ?>
                        <option value='<?= $access['access_id'] ?>'><?= $access['access'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Пароль</td>
            <td><input type='password' name='passw' required></td>
        </tr>
        <tr>
            <td>Пароль</td>
            <td><input type='password' name='passw2' required></td>
        </tr>
        <tr>
            <td colspan='2'><input type='submit' value='Добавить'></td>
        </tr>
    </table>
</form>