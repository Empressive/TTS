<table width="60%" style="margin: 30px auto">
    <tr>
        <th>Сегмент</th>
        <th>Статус</th>
        <th>Категория</th>
        <th>Начальная дата</th>
        <th>Конечная дата</th>
    </tr>
    <?php
    include_once ('../library/UnionDB.php');

    echo "<tr><td><select id='location'><option value='0'>Все</option>";
    UnionDB::select(location,location,location_id,'','location');
    echo "</select></td>";

    echo "<td><select id='status'>";
    UnionDB::select(status,status,status_id,"WHERE status_id !=0 and status_id !=1",'status_id');
    echo "</select></td>";

    echo "<td><select id='category'>";
    UnionDB::select(category,category,category_id,"WHERE category_id !=0",'category_id');
    echo "</select></td>";

    echo "<td><input required class='input_filter' id='datepicker' name='date' autocomplete='off'></td>";
    echo "<td><input required class='input_filter' id='end_date' name='end_date' autocomplete='off'></td></tr>";

    ?>
    <tr>
        <td colspan="5"><input type="submit" id="stats_button"></td>
    </tr>
</table>
<div id="result"></div>
