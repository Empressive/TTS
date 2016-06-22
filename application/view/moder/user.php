<? if (empty($id)): ?>
    <table class='mid_table' id='colon'>
        <tr>
            <th>Ф.И.О сотрудника</th>
            <th>Доступ</th>
        </tr>
        <? foreach ($millwrights as $millwright) : ?>
            <tr onclick="location.href='<?= URL ?>moder/user/<?= $millwright['millwright_id'] ?>/'">
                <td><?= $millwright['staff_name'] ?></td>
                <td><?= $millwright['millwright_status'] ?></td>
            </tr>
        <? endforeach; ?>
    </table>
<? endif; ?>
<? if (!empty($id) && !empty($items)): ?>
    <form action='<?=URL . 'moder/millwright/edit/'?>' method='post'>
        <table class='mid_table'>
            <tr>
                <th colspan='2'>Изменение сотрудника</th>
            </tr>
            <tr>
                <td>Ф.И.О сотрудника</td>
                <td><input type='text' value='<?= $items['staff_name'] ?>' disabled><input type='text' value='<?=$id?>' name='staff_id' hidden></td>
            </tr>
            <tr>
                <td>Доступ</td>
                <td>
                    <select name='access'>
                        <option
                            value='<?= $items['millwright_status_id'] ?>'><?= $items['millwright_status'] ?></option>
                        <option
                            value='<?= $status['millwright_status_id'] ?>'><?= $status['millwright_status'] ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan='2'><input type='submit' value='Сохранить'></td>
            </tr>
        </table>
    </form>
<? endif; ?>
