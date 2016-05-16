<?php
#Развернутая заявка.
if (isset($_GET['page']) && isset($_GET['id']) && $_GET['id'] != null) {

    $item_id = intval($_GET['id']);

    $query = mysql_query("SELECT time_date, now_date, status, status_id, category, category_id, staff_name, staff_group, staff_group_id, ip_adress, user_name, location, location_id, house, driveway, floor, flat, phone, comment, agreement FROM tickets INNER JOIN status USING(status_id) INNER JOIN category USING(category_id) INNER JOIN staff_name USING(staff_name_id) INNER JOIN staff_group USING(staff_group_id) INNER JOIN location USING(location_id) WHERE id = {$item_id}");
    if(mysql_num_rows($query) < 1) header("Location: $local/pages/502.html");
    $result = mysql_fetch_assoc($query);
    
    $agreement = str_replace('/','-',$result['agreement']);

    if ($result['status_id'] == 1 || $result['status_id'] == 2) {
        $disable = 'disabled';
    }
    if($this->user_access > 2) $disable = null;
} else header("Location: $local");

echo "<form action='/scripts/edit.php?id={$item_id}' method='post'>";

if(isset($_COOKIE['status']) && $_COOKIE['status'] == 'success')
{
    echo "<script type='text/javascript' src='/js/detail.js'></script>";
    echo "<input type='text' id='success' value='1' hidden>";
}
?>
<table width="30%" align="left" border="1">
    <tr>
        <th colspan="2">Данные по заявке №<?php echo $item_id ?></th>
    </tr>
    <tr>
        <td>Дата выполнения:</td>
        <td><input <?php echo $disable ?> type="text" id="datepicker" value="<?php echo $result['time_date']; ?>" name="time_date"></td>
    </tr>
    <tr>
        <td>Дата поступления:</td>
        <td><?php echo $result['now_date']; ?></td>
    </tr>
    <tr>
        <td>Статус заявки:</td>
        <td>
            <select name="status" <?php echo $disable ?>>
                <?php

                echo "<option value='{$result['status_id']}'>{$result['status']}</option>";

                MVdb::select(status, status, status_id, "WHERE status_id != $all_ticket and status_id != $archive_ticket and status_id != {$result['status_id']}", 'status_id');

                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Категория заявки:</td>
        <td>
            <select name="category" <?php echo $disable ?>>
                <?php

                echo "<option value='{$result['category_id']}'>{$result['category']}</option>";

                MVdb::select(category, category, category_id, "WHERE category_id != $all_category and category_id != {$result['category_id']}", 'category_id');

                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Заявку принял:</td>
        <td><?php echo $result['staff_name']; ?></td>
    </tr>
    <tr>
        <td>Исполнитель:</td>
        <td>
            <select name="executor" <?php echo $disable ?>>
                <?php

                echo "<option value='{$result['staff_group_id']}'>{$result['staff_group']}</option>";

                MVdb::select(staff_group, staff_group, staff_group_id, "WHERE staff_group_id != $all_staff_group and staff_group_id != $archive_staff_group and staff_group_id != {$result['staff_group_id']}", 'staff_group_id');

                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Номер договора:</td>
        <td><?php echo "<a class='agreement' href='/filter/{$agreement}/' target='_blank'>{$result['agreement']}</a>"; ?></td>
    </tr>
    <tr>
        <td>IP адрес:</td>
        <td><?php echo $result['ip_adress']; ?></td>
    </tr>
    <tr>
        <td>Ф.И.О. клиента:</td>
        <td><?php echo $result['user_name']; ?></td>
    </tr>
    <tr>
        <td>Населенный пункт</td>
        <?php
        echo "<td><select $disable name='location'><option selected value='{$result['location_id']}'>{$result['location']}</option>";
        MVdb::select(location,location,location_id,"WHERE location_id != {$result['location_id']}",'location');
        echo "</select></td>";
        ?>
    </tr>
    <tr>
        <td>Дом:</td>
        <td><input <?php echo $disable ?> type="text" value="<?php echo $result['house']; ?>" name="house" pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
    </tr>
    <tr>
        <td>Подъезд:</td>
        <td><input <?php echo $disable ?> type="text" value="<?php echo $result['driveway']; ?>" name="driveway" pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
    </tr>
    <tr>
        <td>Этаж:</td>
        <td><input <?php echo $disable ?> type="text" value="<?php echo $result['floor']; ?>" name="floor" pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
    </tr>
    <tr>
        <td>Квартира:</td>
        <td><input <?php echo $disable ?> type="text" value="<?php echo $result['flat']; ?>" name="flat" pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
    </tr>
    <tr>
        <td>Телефон:</td>
        <td><input <?php echo $disable ?> type="text" value="<?php echo $result['phone']; ?>" name="phone" id="phone" required></td>
    </tr>
    <?php
    if ($this->user_access >= 2) {
        echo "<tr><td colspan='2' bgcolor='#339999' class='td_color'>Монтажники</td></tr>";
        #Первый селект монтажника
        MVdb::millwright(1, $item_id);
        #Второй селект монтажника
        MVdb::millwright(2, $item_id);
        #Третий селект монтажника
        MVdb::millwright(3, $item_id);
    } else {
        $query = mysql_query("SELECT staff_name, millwright_id FROM tickets, millwright WHERE millwright_id = millwright_1 AND id = {$item_id} ORDER BY staff_name ASC");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            echo "<tr><td colspan='2' bgcolor='#339999' class='td_color'>Монтажники</td></tr>";
            echo "<tr><td colspan='2'><select name='millwright1' hidden><option selected value='{$result['millwright_id']}'>{$result['staff_name']}</option></select>{$result['staff_name']}</td></tr>";
        }
        $query = mysql_query("SELECT staff_name, millwright_id FROM tickets, millwright WHERE millwright_id = millwright_2 AND id = {$item_id}");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            echo "<tr><td colspan='2'><select name='millwright2' hidden><option selected value='{$result['millwright_id']}'>{$result['staff_name']}</option></select>{$result['staff_name']}</td></tr>";
        }
        $query = mysql_query("SELECT staff_name, millwright_id FROM tickets, millwright WHERE millwright_id = millwright_3 AND id = {$item_id}");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            echo "<tr><td colspan='2'><select name='millwright3' hidden><option selected value='{$result['millwright_id']}'>{$result['staff_name']}</option></select>{$result['staff_name']}</td></tr>";
        }
    }
    ?>
    <tr>
        <td bgcolor="#339999" colspan="2" class="td_color">Текст заявки</td>
    </tr>
    <tr>
        <td colspan="2"><textarea required <?php echo $disable ?> class="textarea_detail" name="comment1"><?php echo $result['comment']; ?></textarea></td>
    </tr>
    <tr>
        <td colspan="2"><input <?php echo $disable ?> value="Сохранить" type="submit"></td>
    </tr>
</table>
</form>
<?php echo "<form action='/scripts/comment.php?id={$item_id}' method='post'>" ?>
<table width="69%" align="right" border="1">
    <tr>
        <th colspan="3">Информация о заявке</th>
    </tr>
    <tr>
        <td>Дата</td>
        <td>Сотрудник</td>
        <td>Комментарий</td>
    </tr>
    <?php MVdb::comment("WHERE comment_id = $item_id and comment_type_id != 3") ?>
    <tr>
        <td bgcolor="#339999" colspan="3" class="td_color">Комментарий</td>
    </tr>
    <tr>
        <td colspan="3"><textarea <?php echo $disable ?> name="comment2" class="textarea_detail_fix" required></textarea></td>
    </tr>
    <tr>
        <td colspan="3"><input <?php echo $disable ?> value="Отправить" type="submit"></td>
    </tr>
</table>
</form>
