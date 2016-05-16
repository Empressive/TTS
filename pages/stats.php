<table width="60%" style="margin: 30px auto">
    <tr>
        <th>Сегмент</th>
        <th>Статус</th>
        <th>Категория</th>
        <th>Начальная дата</th>
        <th>Конечная дата</th>
    </tr>
    <?php
    #Страница статистики

    echo "<tr><td><select id='location'><option value='0'>Все</option>";
    MVdb::select(location,location,location_id,'','location');
    echo "</select></td>";

    echo "<td><select id='status'>";
    MVdb::select(status,status,status_id,"WHERE status_id != $all_ticket and status_id != $archive_ticket",'status_id');
    echo "</select></td>";

    echo "<td><select id='category'>";
    MVdb::select(category,category,category_id,"WHERE category_id != $all_category",'category_id');
    echo "</select></td>";

    echo "<td><input required class='input_filter' id='datepicker' name='date' autocomplete='off'></td>";
    echo "<td><input required class='input_filter' id='end_date' name='end_date' autocomplete='off'></td></tr>";

    ?>
    <tr>
        <td colspan="5"><input type="submit" id="stats_button"></td>
    </tr>
</table>
<div id="result"></div>
