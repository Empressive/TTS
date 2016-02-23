<?php

include_once "library/UnionDB.php";
UnionDB::connectDb();

?>
<div id="reset_button"><button id="res_button"><img id="res_img" src="../img/trash.png"></button></div>
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
        <td><select class="input_filter" name='status'
                    id='status'>
                <?php
                $user_id = $_SESSION['user_id'];

                $query = mysql_query("SELECT status, status_id FROM staff_login INNER JOIN status USING (status_id) WHERE id = {$user_id}");
                $result = mysql_fetch_assoc($query);

                $label = $result['status'];
                $value = $result['status_id'];

                echo "<option selected value='$value'>$label</option>";
                UnionDB::select(status, status, status_id, "WHERE status_id !=$value", 'status_id')
                ?></select></td>
        <td><select class="input_filter" name='category'
                    id='category'>
                <?php
                $query = mysql_query("SELECT category, category_id FROM staff_login INNER JOIN category USING (category_id) WHERE id = {$user_id}");
                $result = mysql_fetch_assoc($query);

                $label = $result['category'];
                $value = $result['category_id'];

                echo "<option selected value='$value'>$label</option>";
                UnionDB::select(category, category, category_id, "WHERE category_id !=$value", 'category_id')
                ?>
            </select>
        </td>
        <td><input class="input_filter" id='datepicker' name='date' autocomplete='off'></td>
        <td><select class="input_filter" name='staffGroup'
                    id='staffGroup'>
                <?php
                $query = mysql_query("SELECT staff_group_id FROM staff_login WHERE id = {$user_id}");
                $result = mysql_fetch_assoc($query);

                $value = $result['staff_group_id'];

                $query = mysql_query("SELECT staff_group FROM staff_group WHERE staff_group_id = {$value}");
                $result = mysql_fetch_assoc($query);

                $label = $result['staff_group'];

                echo "<option selected value='$value'>$label</option>";

                UnionDB::select(staff_group, staff_group, staff_group_id, "WHERE staff_group_id !=$value", 'staff_group_id')
                ?><
            </select>
        </td>
        <td><input class="input_filter" name='application' autocomplete='off' onchange="this.form.submit()">
        </td>
        <td><input class="input_filter" name='agreement' autocomplete='off' id='agreement'></td>
    </tr>
</table>