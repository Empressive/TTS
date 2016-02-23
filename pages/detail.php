<?php
include_once('config.php');
if (isset($_GET['page']) && isset($_GET['id']) && $_GET['id'] != null) {

    $item_id = intval($_GET['id']);

    include_once('library/UnionDB.php');

    UnionDB::connectDb();

    $query = mysql_query("SELECT time_date, now_date, status, status_id, category, category_id, staff_name, staff_group, staff_group_id, ip_adress, user_name, location, house, driveway, floor, flat, phone, comment, agreement FROM tickets INNER JOIN status USING(status_id) INNER JOIN category USING(category_id) INNER JOIN staff_name USING(staff_name_id) INNER JOIN staff_group USING(staff_group_id) INNER JOIN location USING(location_id) WHERE id = {$item_id}");
    $result = mysql_fetch_assoc($query);

    $status = $result['status'];
    $status_id = $result['status_id'];

    $category = $result['category'];
    $category_id = $result['category_id'];

    $staff_group = $result['staff_group'];
    $staff_group_id = $result['staff_group_id'];

    $comment = $result['comment'];

    if ($result['status_id'] == 1 || $result['status_id'] == 2) {
        $disable = 'disabled';
    }

} else header("Location: $local");

echo "<form action='../scripts/edit.php?id={$item_id}' method='post'>"
?>
<table width="30%" align="left" border="1">
    <tr>
        <th colspan="2">Данные по заявке №<?php echo $item_id ?></th>
    </tr>
    <tr>
        <td>Дата выполнения:</td>
        <td><input <?php echo $disable ?> type="text" id="datepicker" value="<?php echo $result['time_date']; ?>"
                                          name="time_date"></td>
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

                echo "<option value='$status_id'>$status</option>";

                UnionDB::select(status, status, status_id, "WHERE status_id != 0 and status_id != 1 and status_id != $status_id", 'status_id');

                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Категория заявки:</td>
        <td>
            <select name="category" <?php echo $disable ?>>
                <?php

                echo "<option value='$category_id'>$category</option>";

                UnionDB::select(category, category, category_id, "WHERE category_id != 0 and category_id != $category_id", 'category_id');

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

                echo "<option value='$staff_group_id'>$staff_group</option>";

                UnionDB::select(staff_group, staff_group, staff_group_id, "WHERE staff_group_id != 0 and staff_group_id != 1 and staff_group_id != $staff_group_id", 'staff_group_id');

                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Номер договора:</td>
        <td><?php echo "<a class='agreement' href='?page=filter&id={$result['agreement']}' target='_blank'>{$result['agreement']}</a>"; ?></td>
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
        <td><?php echo $result['location']; ?></td>
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
        <td><input <?php echo $disable ?> type="text" value="<?php echo $result['phone']; ?>" name="phone" id="phone"></td>
    </tr>
    <?php
    if ($this->user_access >= 2) {
        echo "<tr><td colspan='2' bgcolor='#339999' class='td_color'>Монтажники</td></tr>";
        #Первый селект монтажника
        $query = mysql_query("SELECT staff_name, millwright_1 FROM tickets, millwright WHERE millwright_id = millwright_1 AND id = {$item_id} ORDER  BY staff_name ASC");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            $name = $result['staff_name'];
            $value = $result['millwright_1'];
            echo "<tr><td colspan='2'><select $disable class='millwright' name='millwright1'><option value='$value'>$name</option>";
            $query = mysql_query("SELECT * FROM millwright WHERE millwright_id != $value ORDER  BY staff_name ASC");
            while ($result = mysql_fetch_assoc($query)) {
                $name = $result['staff_name'];
                $value = $result['millwright_id'];
                echo "<option value='$value'>$name</option>";
            }
            echo "</select></td></tr>";
        } else {
            echo "<tr><td colspan='2'><select $disable class='millwright' name='millwright1'><option value='0'>Выберите монтажника</option>";
            $query = mysql_query("SELECT * FROM millwright ORDER  BY staff_name ASC");
            while ($result = mysql_fetch_assoc($query)) {
                $name = $result['staff_name'];
                $value = $result['millwright_id'];
                echo "<option value='$value'>$name</option>";
            }
            echo "</select></td></tr>";
        }
        #Второй селект монтажника
        $query = mysql_query("SELECT staff_name, millwright_2 FROM tickets, millwright WHERE millwright_id = millwright_2 AND id = {$item_id} ORDER  BY staff_name ASC");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            $name = $result['staff_name'];
            $value = $result['millwright_2'];
            echo "<tr><td colspan='2' id='millwright2'><select $disable class='millwright' name='millwright2'><option value='$value'>$name</option>";
            $query = mysql_query("SELECT * FROM millwright WHERE millwright_id != $value ORDER  BY staff_name ASC");
            while ($result = mysql_fetch_assoc($query)) {
                $name = $result['staff_name'];
                $value = $result['millwright_id'];
                echo "<option value='$value'>$name</option>";
            }
            echo "</select></td></tr>";
        } else {
            echo "<tr><td colspan='2' style='display: none' id='millwright2'><select $disable class='millwright' name='millwright2'><option value='0'>Выберите монтажника</option>";
            $query = mysql_query("SELECT * FROM millwright ORDER  BY staff_name ASC");
            while ($result = mysql_fetch_assoc($query)) {
                $name = $result['staff_name'];
                $value = $result['millwright_id'];
                echo "<option value='$value'>$name</option>";
            }
            echo "</select></td></tr>";
        }
        #Третий селект монтажника
        $query = mysql_query("SELECT staff_name, millwright_3 FROM tickets, millwright WHERE millwright_id = millwright_3 AND id = {$item_id} ORDER  BY staff_name ASC");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            $name = $result['staff_name'];
            $value = $result['millwright_3'];
            echo "<tr><td colspan='2' id='millwright3'><select $disable class='millwright' name='millwright3'><option value='$value'>$name</option>";
            $query = mysql_query("SELECT * FROM millwright WHERE millwright_id != $value ORDER  BY staff_name ASC");
            while ($result = mysql_fetch_assoc($query)) {
                $name = $result['staff_name'];
                $value = $result['millwright_id'];
                echo "<option value='$value'>$name</option>";
            }
            echo "</select></td></tr>";
        } else {
            echo "<tr><td style='display: none' id='millwright3' colspan='2'><select $disable class='millwright' name='millwright3'><option value='0'>Выберите монтажника</option>";
            $query = mysql_query("SELECT * FROM millwright ORDER  BY staff_name ASC");
            while ($result = mysql_fetch_assoc($query)) {
                $name = $result['staff_name'];
                $value = $result['millwright_id'];
                echo "<option value='$value'>$name</option>";
            }
            echo "</select></td></tr>";
        }
    } else {
        $query = mysql_query("SELECT staff_name, millwright_id FROM tickets, millwright WHERE millwright_id = millwright_1 AND id = {$item_id} ORDER  BY staff_name ASC");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            $millwright = $result['staff_name'];
            $value = $result['millwright_id'];
            echo "<tr><td colspan='2' bgcolor='#339999' class='td_color'>Монтажники</td></tr>";
            echo "<tr><td colspan='2'><select name='millwright1' hidden><option selected value='$value'>$millwright</option></select>$millwright</td></tr>";
        }
        $query = mysql_query("SELECT staff_name, millwright_id FROM tickets, millwright WHERE millwright_id = millwright_2 AND id = {$item_id}");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            $millwright = $result['staff_name'];
            $value = $result['millwright_id'];
            echo "<tr><td colspan='2'><select name='millwright2' hidden><option selected value='$value'>$millwright</option></select>$millwright</td></tr>";
        }
        $query = mysql_query("SELECT staff_name, millwright_id FROM tickets, millwright WHERE millwright_id = millwright_3 AND id = {$item_id}");
        if (mysql_num_rows($query) > 0) {
            $result = mysql_fetch_assoc($query);
            $millwright = $result['staff_name'];
            $value = $result['millwright_id'];
            echo "<tr><td colspan='2'><select name='millwright3' hidden><option selected value='$value'>$millwright</option></select>$millwright</td></tr>";
        }
    }
    ?>
    <tr>
        <td bgcolor="#339999" colspan="2" class="td_color">Текст заявки</td>
    </tr>
    <tr>
        <td colspan="2"><textarea required <?php echo $disable ?> class="textarea_detail"
                                                         name="comment1"><?php echo $comment; ?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input <?php echo $disable ?> value="Сохранить" type="submit"></td>
    </tr>
</table>
</form>
<?php echo "<form action='../scripts/comment.php?id={$item_id}' method='post'>" ?>
<table width="69%" align="right" border="1">
    <tr>
        <th colspan="3">Информация о заявке</th>
    </tr>
    <tr>
        <td>Дата</td>
        <td>Сотрудник</td>
        <td>Комментарий</td>
    </tr>
    <?php UnionDB::comment("WHERE comment_id = $item_id and comment_type_id != 3") ?>
    <tr>
        <td bgcolor="#339999" colspan="3" class="td_color">Форма отправки комментариев</td>
    </tr>
    <tr>
        <td colspan="3"><textarea <?php echo $disable ?> name="comment2" class="textarea_detail_fix" required></textarea></td>
    </tr>
    <tr>
        <td colspan="3"><input <?php echo $disable ?> value="Отправить" type="submit"></td>
    </tr>
</table>
</form>
