<table id='filter_table'>
    <tr>
        <th width='9%'>Номер заявки</th>
        <th width='10%'>Дата выполнения</th>
        <th width='10%'>Дата принятия</th>
        <th width='12%'>Категория</th>
        <th width='12%'>Исполнитель</th>
        <th width='8%'>Договор</th>
        <th width='15%'>Адрес
            <table class='border' width=100%>
                <tr>
                    <td id='td_color'>дом</td>
                    <td id='td_color'>под.</td>
                    <td id='td_color'>эт.</td>
                    <td id='td_color'>кв.</td>
                </tr>
            </table>
        </th>
        <th width='26%'>Комментарий</th>
    </tr>
    <?
    if ($rows > 1) {
        foreach ($tickets as $ticket) {
            echo "<tr bgcolor='{$ticket['status_color']}'><td id='pointer' onclick=\"location.href='/detail/view/{$ticket['id']}'\">{$ticket['id']}</td><td>{$ticket['time_date']}</td><td>{$ticket['now_date']}</td><td>{$ticket['category']}</td><td>{$ticket['staff_group']}</td><td>{$ticket['agreement']}</td><td>{$ticket['location']}<table class='border' width='100%'><td>{$ticket['house']}</td><td>{$ticket['driveway']}</td><td>{$ticket['floor']}</td><td>{$ticket['flat']}</td></table><td>{$ticket['comment']}</td></tr>";
        }
    } else echo "<tr bgcolor='{$tickets['status_color']}'><td id='pointer' onclick=\"location.href='/detail/view/{$tickets['id']}'\">{$tickets['id']}</td><td>{$tickets['time_date']}</td><td>{$tickets['now_date']}</td><td>{$tickets['category']}</td><td>{$tickets['staff_group']}</td><td>{$tickets['agreement']}</td><td>{$tickets['location']}<table class='border' width='100%'><td>{$tickets['house']}</td><td>{$tickets['driveway']}</td><td >{$tickets['floor']}</td><td>{$tickets['flat']}</td></table><td>{$tickets['comment']}</td></tr>";

    ?>
</table>