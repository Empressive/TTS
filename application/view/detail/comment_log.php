<div id='modal'>
    <table id='modal_table'>
        <tr>
            <th width='10%'>Дата</th>
            <th width='20%'>Оператор</th>
            <th>Текст заявки</th>
            <th>Изменение</th>
        </tr>
        <?
        if ($logs_rows > 1) {
            foreach ($logs as $log) {
                if (strripos($log['o_comment'], 0x20) === false && mb_strlen($log['o_comment']) > 30) {
                    $log['o_comment'] = mb_substr($log['o_comment'], 0, 30) . '...';
                }
                if (strripos($log['n_comment'], 0x20) === false && mb_strlen($log['n_comment']) > 30) {
                    $log['n_comment'] = mb_substr($log['n_comment'], 0, 30) . '...';
                }
                echo "<tr bgcolor='#cccccc'><td>{$log['now_date']}</td><td>{$log['staff_name']}</td><td>{$log['o_comment']}</td><td>{$log['n_comment']}</td></tr>";
            }
        } else {
            if (strripos($logs['o_comment'], 0x20) === false && mb_strlen($logs['o_comment']) > 30) {
                $log['o_comment'] = mb_substr($logs['o_comment'], 0, 30) . '...';
            }
            if (strripos($logs['n_comment'], 0x20) === false && mb_strlen($logs['n_comment']) > 30) {
                $logs['n_comment'] = mb_substr($logs['n_comment'], 0, 30) . '...';
            }
            echo "<tr bgcolor='#cccccc'><td>{$logs['now_date']}</td><td>{$logs['staff_name']}</td><td>{$logs['o_comment']}</td><td>{$logs['n_comment']}</td></tr>";
        }
        ?>
    </table>
</div>