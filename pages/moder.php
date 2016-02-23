<?php
#Главная страница панели администратора

if (include('config.php')) {

    if ($this->user_access > 1) {

        if (isset($_GET['mode'])) {

            $name = htmlspecialchars(trim($_GET['mode']));

            if($name == 'millwright') {
                if ($name == 'millwright') {
                    $label = 'Ф.И.О монтажника';
                }
            }else header("Location: $local");
        } elseif(!isset($_GET['mode'])) $hide = 'hidden';
    } else header("Location: $local");
}
?>
<div class="control_moder">
    <div class="control">
        <ul class='control'>
            <li class='control'><a href='?page=announcement'>Добавить оповещение</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=announce'>Управление оповещениями</a></li>
        </ul>
        <ul class='control'>
            <li class='control'><a href='?page=moder&mode=millwright'>Добавить Ф.И.О монтажника</a></li>
        </ul>
    </div>
</div>
<?php echo "<div $hide class='union'>";
echo "<form action='../scripts/union.php?name=$name' method='post'>"; ?>
<table border="1" class="moder_table">
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