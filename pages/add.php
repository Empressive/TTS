<?php include_once('library/UnionDB.php'); ?>
<form method="post" action="../scripts/add.php">
    <table class="add_table" border='1'>
        <tr>
            <th colspan="2">Информация о заявке</th>
        </tr>
        <tr>
            <td class="label">Категория заявки:</td>
            <td class="value"><select
                    name="category"><?php UnionDB::select(category, category, category_id, 'WHERE category_id !=0', 'category_id') ?></select>
            </td>
        </tr>
        <tr>
            <td>Номер договора:</td>
            <td><input type="text" name="agreement" pattern="^[0-9]+[^0-9]*[0-9]*$"></td>
        </tr>
        <tr>
            <td>IP адрес:</td>
            <td><input type="text" name="ip" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}"></td>
        </tr>
        <tr>
            <td>Ф.И.О. пользователя</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td class="label">Населенный пункт:</td>
            <td><select
                    name="location"><?php UnionDB::select(location, location, location_id, '', 'location') ?></select>
            </td>
        </tr>
        <tr>
            <td>Дом:</td>
            <td><input type="text" name="house" pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
        </tr>
        <tr>
            <td>Подъезд:</td>
            <td><input type="text" name="driveway" pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
        </tr>
        <tr>
            <td>Этаж:</td>
            <td><input type="text" name="floor" pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
        </tr>
        <tr>
            <td>Квартира:</td>
            <td><input type="text" name="flat" pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
        </tr>
        <tr>
            <td class="label">Телефон:</td>
            <td><input type="text" id="phone" name="phone" required></td>
        </tr>
        <tr>
            <td class="label">Исполнитель:</td>
            <td><select
                    name="executor"><?php UnionDB::select(staff_group, staff_group, staff_group_id, 'WHERE staff_group_id !=0 and staff_group_id !=1', 'staff_group_id') ?></select>
            </td>
        </tr>
        <tr>
            <td>Дата заявки:
            </th>
            <td><input type="text" name="time_date" id="datepicker"></td>
        </tr>
        <tr>
            <td class="label">Текст заявки:</td>
            <td><textarea class="textarea_style" name="comment" required></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="ОТПРАВИТЬ"></td>
        </tr>
    </table>
</form>
