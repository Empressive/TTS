<div id="support_title">Данная страница создана для того, чтобы вы помогли нам улучшить текущий журнал заявок</div>
<div id="support_title2">Вы можете добавить свое предложения нажав на соотвествующую кнопку "Добавить предложение".<br>Ниже вы увидите список всех предложений, наших сотрудников.</div>
<?php if($this->user_access > 2) echo "<form action='scripts/suggestion.php?admin' method='post'>"; ?>
<table id="suggestion" border="1">
    <?php if($this->user_access > 2) echo "<tr><th></th><th width='10%'>Дата создания</th><th width='20%'>Имя сотрудника</th><th width='20%'>Тема предложения</th><th width='50%'>Предложение</th></tr>";
    else echo "<tr><th width='10%'>Дата создания</th><th width='20%'>Имя сотрудника</th><th width='20%'>Тема предложения</th><th width='50%'>Предложение</th></tr>";?>
    <?php
    include_once('library/UnionDB.php');
    include_once('config.php');

    UnionDB::connectDb();

    $query = mysql_query("SELECT suggestion_id, now_date, staff_name, subject, comment, status FROM suggestion INNER JOIN staff_name USING(staff_name_id) INNER JOIN status USING(status_id)");

    while($result = mysql_fetch_assoc($query))
    {
        $id = $result['suggestion_id'];
        $status = $result['status'];
        $now_date = $result['now_date'];
        $staff_name = $result['staff_name'];
        $subject = $result['subject'];
        $comment = $result['comment'];

        if ($status == "Не выполнена") $color = "$default_color";
        if ($status == "Выполнена") $color = "$close_color";
        if ($status == "Выполнена частично") $color = "$toch_color";
        if ($status == "Архив") $color = "$archive_color";

        if($this->user_access > 2) echo "<tr bgcolor='$color'><td class='p_id'><input type='checkbox' name='id[]' value='$id'></td><td>$now_date</td><td>$staff_name</td><td>$subject</td><td>$comment</td></tr>";
        else echo "<tr bgcolor='$color'><td>$now_date</td><td>$staff_name</td><td>$subject</td><td>$comment</td></tr>";
    }
    ?>
</table>
<?php if($this->user_access > 2) echo "<div class='button_align'><input type='submit' value='Сменить статус'></div></form>";
else echo "<div class='button_align'><form action='?page=suggestion' method='post' id='user'><input type='submit' value='Добавить предложение' form='user'></form></div>"; ?>