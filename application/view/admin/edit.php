<? if (isset($all) && !isset($info)) : ?>
    <table class='mid_table' id='colon'>
        <tr>
            <th>Логин</th>
            <th>Ф.И.О сотрудника</th>
            <th>Доступ</th>
        </tr>
        <? foreach ($all as $item): ?>
            <tr onclick="location.href='<?= URL ?>admin/edit/<?= $item['id'] ?>/'">
                <td><?= $item['login'] ?></td>
                <td><?= $item['staff_name'] ?></td>
                <td><?= $item['access'] ?></td>
            </tr>
        <? endforeach; ?>
    </table>
<? endif; ?>
<? if (isset($info) && !isset($all)) : ?>
    <form action='<?= URL . 'admin/edit/' . $info['id'] ?>' method='post'>
        <table class='mid_table'>
            <tr>
                <th colspan='2'>Информация о сотруднике</th>
            </tr>
            <tr>
                <td>Логин пользователя</td>
                <td><input type='text' value='<?= $info['login'] ?>' disabled><input type='text'
                                                                                     value='<?= $info['login'] ?>'
                                                                                     name='login' hidden></td>
            </tr>
            <tr>
                <td>Ф.И.О сотрудника</td>
                <td><input type='text' name='username' value='<?= $info['staff_name'] ?>' required><input type='text' name='old_name' value='<?= $info['staff_name'] ?>' hidden></td>
            </tr>
            <tr>
                <td>Группа пользователя</td>
                <td>
                    <select name='staff_group'>
                        <option value='<?= $info['staff_group_id'] ?>' selected><?= $info['staff_group'] ?></option>
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
                        <option value='<?= $info['access_id'] ?>' selected><?= $info['access'] ?></option>
                        <? foreach ($accesses as $access) : ?>
                            <option value='<?= $access['access_id'] ?>'><?= $access['access'] ?></option>
                        <? endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><input type='password' name='passw'></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><input type='password' name='passw2'></td>
            </tr>
            <tr>
                <td colspan='2'><input type='submit' value='Сохранить'></td>
            </tr>
        </table>
    </form>
<? endif; ?>
