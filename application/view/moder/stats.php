<? if (!empty($id) and $staff_name != null): ?>
    <table class='mid_table'>
        <tr>
            <th colspan='2'>
                <?= $staff_name['staff_name']; ?>
            </th>
        </tr>
        <tr>
            <td>Активность</td>
            <td><?= $active; ?></td>
        </tr>
        <tr>
            <td>Выполненных</td>
            <td><?= $closed; ?></td>
        </tr>
        <tr>
            <td>Не выполненных</td>
            <td><?= $default; ?></td>
        </tr>
        <tr>
            <td>Выполненных частично</td>
            <td><?= $touched; ?></td>
        </tr>
    </table>
<? endif; ?>
<? if (empty($id) && !empty($millwrights)): ?>
    <table class='mid_table' id='colon'>
        <tr>
            <th>
                Статистика с <?= $s_date; ?> по <?= $e_date; ?>
            </th>
        </tr>
        <? foreach ($millwrights as $millwright): ?>
            <tr onclick="location.href='<?= URL ?>moder/stats/<?= $millwright['millwright_id'] ?>/'">
                <td><?=$millwright['staff_name']?></td>
            </tr>
        <? endforeach; ?>
    </table>
<? endif; ?>
