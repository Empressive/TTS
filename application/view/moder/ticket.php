<? if (isset($tickets) && empty($id)) : ?>
    <table class='big_table'>
        <tr>
            <th width='9%'>ID</th>
            <th width='15%'>Категория</th>
            <th>Адрес
                <table class='border' width='100%'>
                    <tr>
                        <td id='td_color'>дом</td>
                        <td id='td_color'>под</td>
                        <td id='td_color'>эт.</td>
                        <td id='td_color'>кв.</td>
                    </tr>
                </table>
            </th>
            <th>Комментарий</th>
        </tr>
        <? if ($rows > 1) : ?>
            <? foreach ($tickets as $ticket): ?>
                <? $ticket['comment'] = mb_substr($ticket['comment'], 0, 30) . '...' ?>
                <tr>
                    <td id='pointer'
                        onclick="location.href='<?= URL ?>moder/ticket/<?= $ticket['id'] ?>/'"><?= $ticket['id'] ?></td>
                    <td><?= $ticket['category'] ?></td>
                    <td><?= $ticket['location'] ?>
                        <table class='border' width='100%'>
                            <tr>
                                <td class='td_color'><?= $ticket['house'] ?></td>
                                <td class='td_color'><?= $ticket['driveway'] ?></td>
                                <td class='td_color'><?= $ticket['floor'] ?></td>
                                <td class='td_color'><?= $ticket['flat'] ?></td>
                            </tr>
                        </table>
                    </td>
                    <td><?= $ticket['comment'] ?></td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
        <? if ($rows == 1) : ?>
            <tr>
                <td id='pointer'
                    onclick="location.href='<?= URL ?>moder/ticket/<?= $tickets['id'] ?>/'"><?= $tickets['id'] ?></td>
                <td><?= $tickets['category'] ?></td>
                <td><?= $tickets['location'] ?>
                    <table class='border' width='100%'>
                        <tr>
                            <td class='td_color'><?= $tickets['house'] ?></td>
                            <td class='td_color'><?= $tickets['driveway'] ?></td>
                            <td class='td_color'><?= $tickets['floor'] ?></td>
                            <td class='td_color'><?= $tickets['flat'] ?></td>
                        </tr>
                    </table>
                </td>
                <td><?= $tickets['comment'] ?></td>
            </tr>
        <? endif; ?>
    </table>
<? endif; ?>
<? if (!empty($id) && !empty($millwrights)): ?>
    <script src='<?= RESOURCES . 'js/millwright.js' ?>'></script>
    <? if ($rows > 1) : ?>
        <table class='mid_table' id='delete_table'>
            <tr>
                <th colspan='2'>Монтажники к заявке №<?= $id ?><input type='text' id='ticket_id' value='<?= $id ?>'
                                                                      hidden>
                </th>
            </tr>
            <? foreach ($items as $item) : ?>
                <tr id='pointer'>
                    <td id='<?= $item['millwright_id'] ?>' colspan='2'><?= $item['staff_name'] ?></td>
                </tr>
            <? endforeach; ?>
        </table>
    <? endif; ?>
    <? if ($rows == 1) : ?>
        <table class='mid_table' id='delete_table'>
            <tr>
                <th colspan='2'>Монтажники к заявке №<?= $id ?><input type='text' id='ticket_id' value='<?= $id ?>'
                                                                      hidden></th>
            </tr>
            <tr id='pointer'>
                <td id='<?= $items['millwright_id'] ?>'
                    colspan='2'><?= $items['staff_name'] ?></td>
            </tr>
        </table>
    <? endif; ?>
    <? if (!empty($millwrights) && !empty($id)) : ?>
        <table class='mid_table' id='insert_table'>
            <tr>
                <th colspan='2'>Список доступных монтажников<input type='text' id='ticket_id' value='<?= $id ?>'
                                                                   hidden></th>
            </tr>
            <? foreach ($millwrights as $millwright) : ?>
                <tr id='pointer'>
                    <td colspan='2' id='<?= $millwright['millwright_id'] ?>'><?= $millwright['staff_name'] ?></td>
                </tr>
            <? endforeach; ?>
        </table>
    <? endif; ?>
<? endif; ?>