<?php

if (include('config.php'))

{
    if (isset($this->user_access))
    {
        $access = $this->user_access;
        if($access < 2) header("Location: $local");
    }
}
?>
<div id="support_title">Форма добавления оповещений</div>
<div id="support_title2">Максимальное число активных оповещений не должно быть больше трех.</div>
<form action="../scripts/announcement.php" method="post">
<table class="union_table">
    <tr><th colspan="2">Ниже укажите текст вашего оповещения</th></tr>
    <tr><td colspan="2"><textarea class="textarea_detail" name="comment"></textarea></td></tr>
    <tr><td colspan="2"><input type="submit" value="Отправить"></td></tr>
</table>
</form>