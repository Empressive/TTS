<?php
#Главная страница панели администратора

if (include('config.php')) {

    if ($this->user_access > 2) {

        if (isset($_GET['mode'])) {

            $name = htmlspecialchars(trim($_GET['mode']));

            if($name == 'location' || $name == 'staff_group' || $name == 'status' || $name == 'category' || $name == 'reason' || $name == 'millwright') {
                if ($name == 'location') {
                    $label = 'сегмент';
                } elseif ($name == 'staff_group') {
                    $label = 'исполнителя';
                } elseif ($name == 'status') {
                    $label = 'статус';
                } elseif ($name == 'category') {
                    $label = 'категорию';
                } elseif ($name == 'reason') {
                    $label = 'причину';
                }
                elseif ($name == 'millwright') {
                    $label = 'Ф.И.О монтажника';
                }
            }else $hide = 'hidden';
        } elseif(!isset($_GET['mode'])) $hide = 'hidden';
    } else header("Location: $local");
}
?>
<div class="control_admin">
    <div class="control">
        <ul class='control'>
            <li class='control'><a href='?page=announcement'>Добавить оповещение</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=user'>Добавить пользователя</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=password'>Редактировать пароль</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=announce'>Управление оповещениями</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=control&mode=location'>Добавить сегмент</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=control&mode=staff_group'>Добавить исполнителя</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=control&mode=status'>Добавить статус заявки</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=control&mode=category'>Добавить категорию заявки</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=control&mode=reason'>Добавить причину закрытия заявки</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=control&mode=millwright'>Добавить Ф.И.О монтажника</a></li>
        </ul>
    </div>
</div>
<?php echo "<div $hide class='union'>";
echo "<form action='../scripts/union.php?name=$name' method='post'>"; ?>
<table border="1" class="union_table">
    <tr>
        <th colspan="2">Форма добавления данных в базу</th>
    </tr>
    <tr>
        <td align='right' width='50%'><?php echo "Введите $label:" ?></td>
        <td align='left' width='50%'><input type="text" name='value' required></td>
    <tr>
        <td align='right' width='50%'><?php echo "Повторите $label:" ?></td>
        <td align='left' width='50%'><input type="text" name='value2' required></td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" value="Добавить">
        </td>
    </tr>
</table>
</form>
</div>
