<? if (!isset($type)) : ?>
    <table class='mid_table'>
        <tr>
            <th colspan='2'>Добавление данных</th>
        </tr>
        <tr>
            <td colspan='2'>
                <select onchange="location = this.options[this.selectedIndex].value;">
                    <option disabled selected>Выберите тип данных</option>
                    <option value='/admin/add/location/'>Сегмент</option>
                    <option value='/admin/add/staff_group/'>Исполнителя</option>
                    <option value='/admin/add/reason/'>Причину</option>
                </select>
            </td>
        </tr>
    </table>
<? endif; ?>
<? if (isset($type)) : ?>
    <form action='<?= URL . 'admin/add/' ?>' method='post'>
        <table class='small_table'>
            <tr>
                <th colspan='2'>Добавление <?= $type ?> в базу <input type='text' value='<?= $type ?>' name='type' hidden></th>
            </tr>
            <tr>
                <td>Введите параментр</td>
                <td><input type='text' name='value'></td>
            </tr>
            <tr>
                <td>Повторите параментр</td>
                <td><input type='text' name='value2'></td>
            </tr>
            <tr>
                <td colspan='2'><input type='submit' value='Добавить'></td>
            </tr>
        </table>
    </form>
<? endif; ?>
