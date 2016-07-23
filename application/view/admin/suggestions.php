<? if (isset($suggestions)): ?>
    <form method='post' action='<?= URL; ?>admin/suggestion/'>
        <table class='big_table'>
            <tr>
                <th width='5%'></th>
                <th width='10%'>Дата создания</th>
                <th width='20%'>Имя сотрудника</th>
                <th>Тема предложения</th>
                <th>Текст предложения</th>
            </tr>
            <? if ($rows > 1): ?>
                <? foreach ($suggestions as $suggestion): ?>
                    <tr bgcolor='<?= $suggestion['status_color']; ?>'>
                        <td><input type='checkbox' name='id[]' value='<?= $suggestion['suggestion_id']; ?>'></td>
                        <td><?= $suggestion['now_date']; ?></td>
                        <td><?= $suggestion['staff_name']; ?></td>
                        <td><?= $suggestion['subject']; ?></td>
                        <td><?= $suggestion['comment']; ?></td>
                    </tr>
                <? endforeach; ?>
            <? else: ?>
                <tr bgcolor='<?= $suggestions['status_color']; ?>'>
                    <td><input type='checkbox' name='id[]' value='<?= $suggestions['suggestion_id']; ?>'></td>
                    <td><?= $suggestions['now_date']; ?></td>
                    <td><?= $suggestions['staff_name']; ?></td>
                    <td><?= $suggestions['subject']; ?></td>
                    <td><?= $suggestions['comment']; ?></td>
                </tr>
            <? endif; ?>
        </table>
        <input type='submit' value='Сменить статус' id='button'>
    </form>
<? endif; ?>
