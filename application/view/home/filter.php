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
                <option value='<? echo $account['status_id']; ?>' selected><? echo $account['status']; ?></option>
                <?
                foreach ($statuses as $status) {
                    echo "<option value='{$status['status_id']}'>{$status['status']}</option>";
                }
                ?>
            </select>
        </td>
        <td>
            <select id='category'>
                <option value='<? echo $account['category_id']; ?>' selected><? echo $account['category']; ?></option>
                <?
                foreach ($categoryes as $category) {
                    echo "<option value='{$category['category_id']}'>{$category['category']}</option>";
                }
                ?>
            </select>
        </td>
        <td>
            <input value='<? echo $account['time_date']; ?>' id='datepicker' type='text'>
        </td>
        <td>
            <select id='staff_group'>
                <option value='<? echo $account['group_id']; ?>' selected><? echo $account['staff_group']; ?></option>
                <?
                foreach ($staff_groups as $staff_group) {
                    echo "<option value='{$staff_group['staff_group_id']}'>{$staff_group['staff_group']}</option>";
                }
                ?>
            </select>
        </td>
        <td>
            <input type='text'>
        </td>
        <td>
            <input type='text' value='<? echo $account['agreement']; ?>' id='agreement'>
        </td>
    </tr>
</table>