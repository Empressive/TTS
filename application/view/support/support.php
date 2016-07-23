<div id='support_title'>Данная страница создана для того, чтобы вы помогли нам улучшить текущий журнал заявок</div>
<div id='support_title2'>Вы можете добавить свое предложения нажав на соотвествующую кнопку "Добавить предложение".<br>Ниже
    вы увидите список всех предложений, наших сотрудников.
</div>
<? if ($rows > 0): ?>
    <table id='suggestion' border='1'>
        <tr>
            <th width='10%'>Дата создания</th>
            <th width='20%'>Имя сотрудника</th>
            <th width='20%'>Тема предложения</th>
            <th width='50%'>Предложение</th>
        </tr>
        <? if ($rows > 1): ?>
            <? foreach ($suggestions as $suggestion): ?>
                <tr bgcolor='<?= $suggestion['status_color']; ?>'>
                    <td><?= $suggestion['now_date']; ?></td>
                    <td><?= $suggestion['staff_name']; ?></td>
                    <td><?= $suggestion['subject']; ?></td>
                    <td><?= $suggestion['comment']; ?></td>
                </tr>
            <? endforeach; ?>
        <? else : ?>
            <tr bgcolor='<?= $suggestions['status_color']; ?>'>
                <td><?= $suggestions['now_date']; ?></td>
                <td><?= $suggestions['staff_name']; ?></td>
                <td><?= $suggestions['subject']; ?></td>
                <td><?= $suggestions['comment']; ?></td>
            </tr>
        <? endif; ?>
    </table>
<? endif; ?>
<input type='submit' value='Добавить предложение' id='button' onclick="location.href='<?= URL . 'support/add/'; ?>'">