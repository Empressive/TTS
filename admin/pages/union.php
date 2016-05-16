<?php
#Страница редактирования данных в базе(причины, категории...)

if (isset($_GET['id'])) {

    $name = htmlspecialchars(trim($_GET['id']));

    if($name == 'location' || $name == 'staff_group' || $name == 'status' || $name == 'category' || $name == 'reason') {
        if ($name == 'location') {
            $label = 'location';
            $value = 'location_id';
        } elseif ($name == 'staff_group') {
            $label = 'staff_group';
            $value = 'staff_group_id';
        } elseif ($name == 'status') {
            $label = 'status';
            $value = 'status_id';
        } elseif ($name == 'category') {
            $label = 'category';
            $value = 'category_id';
        } elseif ($name == 'reason') {
            $label = 'reason';
            $value = 'reason_id';
        }
    }else $hide = 'hidden';
}else $hide = 'hidden';

if(isset($_GET['number']) && $_GET['number'] != null)
{
    $id = intval($_GET['number']);

    $query = mysql_query("SELECT $value, $label FROM $label WHERE $value = $id");
    $result = mysql_fetch_assoc($query);

    if(mysql_num_rows($query) > 0)
    {
        echo "<form method='post'>";
        echo "<table class='union' border='1'>";
        echo "<input type='text' hidden name='db' value=\"$label\">";
        echo "<input type='text' hidden name='db_value' value=\"$value\">";
        echo "<tr><th colspan='2'>Редактирование данных</th></tr>";
        echo "<tr><td>ID</td><td><input type='text' value=\"$result[$value]\" name='value' hidden>$result[$value]</td></tr>";
        echo "<tr><td>Значение</td><td><input type='text' value=\"$result[$label]\" name='label'></td></tr>";
        echo "<tr><td><input type='submit' value='Удалить' formaction='/admin/scripts/delete.php'></td><td><input type='submit' value='Сохранить' formaction='/admin/scripts/values.php'></td>";
        echo "</table>";
        echo "</form>";
    };
}
elseif(!isset($_GET['number']) && $_GET['number'] == null && $_GET['id'] != 'edit')
{
    $query = mysql_query("SELECT $label, $value FROM $label");

    echo "<div class='union' id='display'>";
    echo "<table border='1' class='union_table'>";
    echo "<tr><th>ID</th><th>Значение</th></tr>";
    while($result = mysql_fetch_assoc($query))
    {
        echo "<tr id='staff_edit' onclick=\"location.href='/admin/union/$label/{$result[$value]}/'\"><td>{$result[$value]}</td><td>{$result[$label]}</td></tr>";
    }
    echo "</table>";
    echo "</div>";
}

if(isset($_GET['id']) && $_GET['id'] == 'edit')
{
    echo "<table class='union' border='1'>";
    echo "<tr><th colspan='2'>Редактирование данных</th></tr>";
    echo "<tr><td colspan='2'><select onchange=\"location = this.options[this.selectedIndex].value;\"><option disabled selected>Выберите тип данных</option><option value='/admin/union/location/'>Сегмент</option><option value='/admin/union/staff_group/'>Исполнителя</option><option value='/admin/union/status/'>Статус</option><option value='/admin/union/category/'>Категорию</option><option value='/admin/union/reason/'>Причину</option></select></td></tr>";
    echo "</table>";
}