<form method='post'>
    <table id='close'>
        <tr>
            <th colspan='2'>Информация о заявке №<? echo $id ?></th>
        </tr>
        <tr>
            <td>Статус :</td>
            <td><select name='status'>
                    <option value='2'>Выполнена</option>
                </select></td>
        </tr>
        <tr>
            <td>Причина :</td>
            <td>
                <select name='reason'>
                    <?
                    foreach ($reasons as $reason) {
                        echo "<option value='{$reason['reason_id']}'>{$reason['reason']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type='submit' value='Отмена' formaction='<? echo URL . 'detail/view/' . $id; ?>'></td>
            <td><input type='submit' value='Сохранить' formaction='<? echo URL . 'tickets/close/' . $id; ?>'></td>
        </tr>
    </table>
</form>