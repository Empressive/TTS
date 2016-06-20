<form action='<?= URL . 'detail/view/' ?>' method='post'>
    <table class="filter">
        <tr>
            <th>Статус</th>
            <th>Категория</th>
            <th>Дата</th>
            <th>Исполнитель</th>
            <th>Заявка</th>
            <th>Договор</th>
        </tr>
        <tr>
            <td>
                <select id='status'>
                    <option value='<?= $account['status_id'] ?>' selected><?= $account['status'] ?></option>
                    <? foreach ($statuses as $status): ?> {
                        <option value='<?= $status['status_id'] ?>'><?= $status['status'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
            <td>
                <select id='category'>
                    <option value='<?= $account['category_id'] ?>' selected><?= $account['category'] ?></option>
                    <? foreach ($categoryes as $category) : ?>
                        <option value='<?= $category['category_id'] ?>'><?= $category['category'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
            <td>
                <input value='<?= $account['time_date'] ?>' id='datepicker' type='text'>
            </td>
            <td>
                <select id='staff_group'>
                    <option value='<?= $account['group_id'] ?>' selected><?= $account['staff_group'] ?></option>
                    <? foreach ($staff_groups as $staff_group) : ?>
                        <option
                            value='<?= $staff_group['staff_group_id'] ?>'><?= $staff_group['staff_group'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
            <td>
                <input name='application' autocomplete='off' onchange='this.form.submit()' type='text'>
            </td>
            <td>
                <input type='text' value='<?= $account['agreement'] ?>' id='agreement'>
            </td>
        </tr>
    </table>
</form>
