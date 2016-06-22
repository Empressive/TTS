<form action='<?= URL . 'tickets/edit/' . $items['id'] . '/'; ?>' method='post'>
    <script src='<?= RESOURCES . 'js/detail.js' ?>'></script>
    <? if (isset($_COOKIE['status']) && ($_COOKIE['status'] == 'success')): ?>
        <script src='<?= RESOURCES . 'js/success.js' ?>'></script>
    <? endif; ?>
    <table width='30%' align='left' border='1' id='detail_table'>
        <tr>
            <th colspan='2'>Данные по заявке №<?= $items['id'] ?></th>
        </tr>
        <tr>
            <td>Дата выполнения:</td>
            <td><input value='<?= $items['time_date'] ?>' <?= $access ?> id='datepicker' type='text' name='time_date'>
            </td>
        </tr>
        <tr>
            <td>Дата поступления:</td>
            <td><?= $items['now_date'] ?></td>
        </tr>
        <tr>
            <td>Статус заявки:</td>
            <td>
                <select name='status' <? echo $access ?>>
                    <option value='<?= $items['status_id'] ?>'><?= $items['status']; ?></option>
                    <? foreach ($statuses as $status) : ?>
                        <option value='<?= $status['status_id'] ?>'><?= $status['status'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Категория заявки:</td>
            <td>
                <select name='category' <?= $access ?>>
                    <option value='<?= $items['category_id'] ?>'><?= $items['category'] ?></option>
                    <? foreach ($categoryes as $category): ?>
                        <option value='<?= $category['category_id'] ?>'><?= $category['category'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Заявку принял:</td>
            <td><?= $items['staff_name'] ?></td>
        </tr>
        <tr>
            <td>Исполнитель:</td>
            <td>
                <select name='staff_group' <?= $access ?>>
                    <option value='<?= $items['staff_group_id'] ?>'><?= $items['staff_group'] ?></option>
                    <? foreach ($staff_groups as $staff_group): ?>
                        <option
                            value='<?= $staff_group['staff_group_id'] ?>'><?= $staff_group['staff_group'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Номер договора:</td>
            <td><a href='/filter/view/<?= $link ?>/' target='_blank'><?= $items['agreement'] ?></a></td>
        </tr>
        <tr>
            <td>IP адрес:</td>
            <td><?= $items['ip_adress'] ?></td>
        </tr>
        <tr>
            <td>Ф.И.О. клиента:</td>
            <td><?= $items['user_name'] ?></td>
        </tr>
        <tr>
            <td>Населенный пункт:</td>
            <td>
                <select name='location' <?= $access ?>>
                    <option value='<?= $items['location_id'] ?>'><?= $items['location'] ?></option>
                    <? foreach ($locations as $location): ?>
                        <option value='<?= $location['location_id'] ?>'><?= $location['location'] ?></option>
                    <? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Дом:</td>
            <td><input type='text' <?= $access ?> value='<?= $items['house'] ?>' autocomplete='off' name='house'
                       pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
        </tr>
        <tr>
            <td>Подъезд:</td>
            <td><input type='text' <?= $access ?> value='<?= $items['driveway'] ?>' autocomplete='off' name='driveway'
                       pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
        </tr>
        <tr>
            <td>Этаж:</td>
            <td><input type='text' <?= $access ?> value='<?= $items['floor'] ?>' autocomplete='off' name='floor'
                       pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
        </tr>
        <tr>
            <td>Квартира:</td>
            <td><input type='text' <?= $access ?> value='<?= $items['flat'] ?>' autocomplete='off' name='flat'
                       pattern="^[0-9]+[^0-9]*[0-9]*[^0-9]*$"></td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td><input type='text' id='phone' <?= $access ?> value='<?= $items['phone'] ?>' name='phone' required></td>
        </tr>
        <? if ($millwright_rows > 1): ?>
            <tr>
                <td colspan='2' id='td_color'>Монтажники</td>
            </tr>
            <? foreach ($millwrights as $millwright): ?>
                <tr>
                    <td colspan='2'><?= $millwright['staff_name'] ?></td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
        <? if ($millwright_rows == 1): ?>
            <tr>
                <td colspan='2' id='td_color'>Монтажники</td>
            </tr>
            <tr>
                <td colspan='2'><?= $millwrights['staff_name'] ?></td>
            </tr>
        <? endif; ?>
        <tr>
            <td colspan='2' id='td_color'>Текст заявки</td>
        </tr>
        <tr>
            <td colspan='2'><textarea <?= $access ?> name='comment'
                                                     maxlength='500'><?= $items['comment'] ?></textarea></td>
        </tr>
        <tr>
            <td colspan='2'><input type='submit' value='Сохранить' <?= $access ?>></td>
        </tr>
    </table>
</form>
<form action='<? echo URL . 'tickets/comment/' . $items['id'] . '/'; ?>' method='post'>
    <table width='69%' align='right' border='1' id='detail_table2'>
        <tr>
            <th colspan='3'>Информация о заявке</th>
        </tr>
        <tr>
            <td>Дата</td>
            <td>Сотрудник</td>
            <td>Комментарий</td>
        </tr>
        <?
        if ($comment_rows > 1) {
            foreach ($comments as $comment) {
                if ($comment['comment_type_id'] == 2) $color = '#cccccc';
                else $color = null;
                if (strripos($comment['comment'], 0x20) === false && mb_strlen($comment['comment']) > 30) {
                    $comment['comment'] = mb_substr($comment['comment'], 0, 30) . '...';
                }
                echo "<tr bgcolor='$color'><td>{$comment['now_date']}</td><td>{$comment['staff_name']}</td><td>{$comment['comment']}</td></t></tr>";
            }
        } elseif ($comments != null && $comment_rows < 2) {
            if ($comments['comment_type_id'] == 2) $color = '#cccccc';
            else $color = null;
            if (strripos($comments['comment'], 0x20) === false && mb_strlen($comments['comment']) > 30) {
                $comments['comment'] = mb_substr($comments['comment'], 0, 30) . '...';
            }
            echo "<tr bgcolor='$color'><td>{$comments['now_date']}</td><td>{$comments['staff_name']}</td><td>{$comments['comment']}</td></t></tr>";
        }
        ?>
        <tr>
            <td colspan='3' id='td_color'><span id='active'>Комментарий</span></td>
        </tr>
        <tr>
            <td colspan='3'><textarea <?= $access ?> name='comment2' required></textarea></td>
        </tr>
        <tr>
            <td colspan='3'><input <?= $access ?> value='Отправить' type='submit'></td>
        </tr>
    </table>
</form>