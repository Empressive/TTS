<? if (empty($type)) : ?>
    <table class='mid_table'>
        <tr>
            <th colspan='2'>Редактирование данных</th>
        </tr>
        <tr>
            <td colspan='2'><select onchange="location = this.options[this.selectedIndex].value;">
                    <option disabled selected>Выберите тип данных</option>
                    <option value='/admin/update/location/'>Сегмент</option>
                    <option value='/admin/update/staff_group/'>Исполнителя</option>
                    <option value='/admin/update/reason/'>Причину</option>
                </select></td>
        </tr>
    </table>
<? endif; ?>
<? if (!empty($type) && empty($id)) : ?>
    <table class='mid_table' id='colon'>
        <tr>
            <th colspan='2'>Редактирование данных</th>
        </tr>
        <? foreach ($items as $item) : ?>
            <tr onclick="location.href='<?= URL ?>admin/update/<?= $type ?>/<?= $item[$type . '_id'] ?>/'">
                <td><?= $item[$type . '_id'] ?></td>
                <td><?= $item[$type] ?></td>
            </tr>
        <? endforeach; ?>
    </table>
<? endif; ?>
<? if (!empty($type) && !empty($id)) : ?>
    <form method='post'>
        <table class='mid_table'>
            <tr>
                <th colspan='2'>Редактировани данных <?= $type ?></th>
            </tr>
            <tr>
                <td>Идентификатор</td>
                <td><input type='text' value='<?= $item[$type_id] ?>' disabled></td>
            </tr>
            <tr>
                <td>Значение</td>
                <td><input type='text' value='<?= $item[$type] ?>' name='value'></td>
            </tr>
            <tr>
                <td><input type='submit' value='Удалить' formaction='<?=URL . 'admin/update/' . $type . '/' . $item[$type_id] . '/delete/'?>'></td>
                <td><input type='submit' value='Сохранить' formaction='<?=URL . 'admin/update/' . $type . '/' . $item[$type_id] . '/update/'?>'></td>
            </tr>
        </table>
    </form>
<? endif; ?>
