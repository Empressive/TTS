<div id="support_title">Данная страница создана для того, чтобы вы помогли нам улучшить текущий журнал заявок</div>
<div id="support_title2">Вы можете добавить свое предложения нажав на соотвествующую кнопку "Добавить предложение".<br>Ниже вы увидите список всех предложений, наших сотрудников.</div>
<?php if($this->user_access > 2) echo "<form action='/scripts/suggestion.php?admin' method='post'>"; ?>
<table id="suggestion" border="1">
    <?php if($this->user_access > 2) echo "<tr><th></th><th width='10%'>Дата создания</th><th width='20%'>Имя сотрудника</th><th width='20%'>Тема предложения</th><th width='50%'>Предложение</th></tr>";
    else echo "<tr><th width='10%'>Дата создания</th><th width='20%'>Имя сотрудника</th><th width='20%'>Тема предложения</th><th width='50%'>Предложение</th></tr>";

    $query = mysql_query("SELECT suggestion_id, now_date, staff_name, subject, comment, status FROM suggestion INNER JOIN staff_name USING(staff_name_id) INNER JOIN status USING(status_id)");

    while($result = mysql_fetch_assoc($query))
    {
        if ($result['status'] == "Не выполнена") $color = "$default_color";
        if ($result['status'] == "Выполнена") $color = "$close_color";
        if ($result['status'] == "Выполнена частично") $color = "$toch_color";
        if ($result['status'] == "Архив") $color = "$archive_color";

        if($this->user_access > 2) echo "<tr bgcolor='$color'><td class='p_id'><input type='checkbox' name='id[]' value='{$result['suggestion_id']}'></td><td>{$result['now_date']}</td><td>{$result['staff_name']}</td><td>{$result['subject']}</td><td>{$result['comment']}</td></tr>";
        else echo "<tr bgcolor='$color'><td>{$result['now_date']}</td><td>{$result['staff_name']}</td><td>{$result['subject']}</td><td>{$result['comment']}</td></tr>";
    }
    ?>
</table>
<?php if($this->user_access > 2) echo "<div class='button_align'><input type='submit' value='Сменить статус'></div></form>";
else echo "<div class='button_align'><form action='/suggestion/' method='post' id='user'><input type='submit' value='Добавить предложение' form='user'></form></div>"; ?>