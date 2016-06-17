<script src='<? echo RESOURCES . 'js/detail.js' ?>'></script>
<form method='post' action='<? echo URL . 'tickets/add/'; ?>'>
    <table class='add_table' border='1'>
        <tr>
            <th colspan='2'>Информация о заявке</th>
        </tr>
        <tr>
            <td class='label'>Категория заявки:</td>
            <td>
                <select name='category'>
                    <?
                    foreach ($categoryes as $category) {
                        echo "<option value='{$category['category_id']}'>{$category['category']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Номер договора:</td>
            <td><input type='text' name='agreement' pattern='^[0-9]+[^0-9]*[0-9]*$' maxlength='8'></td>
        </tr>
        <tr>
            <td>IP адрес:</td>
            <td><input type='text' name='ip' pattern='\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}'></td>
        </tr>
        <tr>
            <td>Ф.И.О. пользователя</td>
            <td><input type='text' name='username'></td>
        </tr>
        <tr>
            <td class='label'>Населенный пункт:</td>
            <td>
                <select name='location'>
                    <?
                    foreach ($locations as $location) {
                        echo "<option value='{$location['location_id']}'>{$location['location']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Дом:</td>
            <td><input type='text' name='house' pattern='^[0-9]+[^0-9]*[0-9]*[^0-9]*$'></td>
        </tr>
        <tr>
            <td>Подъезд:</td>
            <td><input type='text' name='driveway' pattern='^[0-9]+[^0-9]*[0-9]*[^0-9]*$'></td>
        </tr>
        <tr>
            <td>Этаж:</td>
            <td><input type='text' name='floor' pattern='^[0-9]+[^0-9]*[0-9]*[^0-9]*$'></td>
        </tr>
        <tr>
            <td>Квартира:</td>
            <td><input type='text' name='flat' pattern='^[0-9]+[^0-9]*[0-9]*[^0-9]*$'></td>
        </tr>
        <tr>
            <td class='label'>Телефон:</td>
            <td><input type='text' id='phone' name='phone' required></td>
        </tr>
        <tr>
            <td class='label'>Исполнитель:</td>
            <td>
                <select name='executor'>
                    <?
                    foreach ($staff_groups as $staff_group) {
                        echo "<option value='{$staff_group['staff_group_id']}'>{$staff_group['staff_group']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Дата заявки:</td>
            <td><input type='text' name='time_date' id='datepicker'></td>
        </tr>
        <tr>
            <td class='label'>Текст заявки:</td>
            <td><textarea class='textarea_style' name='comment' required></textarea></td>
        </tr>
        <tr>
            <td colspan='2'><input type='submit' value='ОТПРАВИТЬ'></td>
        </tr>
    </table>
</form>