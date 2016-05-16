<?php
if (isset($_GET['id'])) {

    $name = htmlspecialchars(trim($_GET['id']));

    if ($name == 'location' || $name == 'staff_group' || $name == 'status' || $name == 'category' || $name == 'reason') {
        if ($name == 'location') {
            $label = 'сегмент';
        } elseif ($name == 'staff_group') {
            $label = 'исполнителя';
        } elseif ($name == 'status') {
            $label = 'статус';
        } elseif ($name == 'category') {
            $label = 'категорию';
        } elseif ($name == 'reason') {
            $label = 'причину';
        }
    } else $hide = 'hidden';
} else $hide = 'hidden';

if (isset($_GET['id']) && $_GET['id'] == 'add') {
    echo "<table class='union' border='1'>";
    echo "<tr><th colspan='2'>Добавление данных в базу</th></tr>";
    echo "<tr><td colspan='2'><select onchange=\"location = this.options[this.selectedIndex].value;\"><option disabled selected>Выберите тип данных</option><option value='/admin/control/location/'>Сегмент</option><option value='/admin/control/staff_group/'>Исполнителя</option><option value='/admin/control/status/'>Статус</option><option value='/admin/control/category/'>Категорию</option><option value='/admin/control/reason/'>Причину</option></select></td></tr>";
    echo "</table>";
}


echo "<div $hide class='union'>";
echo "<form action='/admin/scripts/union.php?name=$name' method='post'>";
?>
<table border="1" class="union_table">
    <tr>
        <th colspan="2">Добавление данных в базу</th>
    </tr>
    <tr>
        <td align='right' width='50%'><?php echo "Введите $label:" ?></td>
        <td align='left' width='50%'><input type="text" name='value' required></td>
    <tr>
        <td align='right' width='50%'><?php echo "Повторите $label:" ?></td>
        <td align='left' width='50%'><input type="text" name='value2' required></td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" value="Добавить">
        </td>
    </tr>
</table>
</form>
</div>
