<?php

if (include('config.php')) {
    if (isset($this->user_access)) {
        $access = $this->user_access;
        if ($access < 2) header("Location: $local");
    }
}
?>
<div class="announce_block">
    <form action="../scripts/announcement.php" method="post">
        <table class="announce_table">
            <tr>
                <th colspan="2">Ниже укажите текст вашего оповещения</th>
            </tr>
            <tr>
                <td colspan="2"><textarea class="textarea_detail" name="comment"></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Отправить"></td>
            </tr>
        </table>
    </form>
</div>