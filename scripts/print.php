<html>
<meta charset="utf-8">
<?php
#Печать выбранных заявок
if (isset($_POST['id'])) {

    include_once('../library/MVdb.php');

    echo "<table width='100%' style='table-layout: fixed; text-align: center; overflow: hidden;' border='1'>";
    echo "<tr>";
    echo "<th width='10%'>Номер заявки</th>";
    echo "<th width='9%'>Договор</th>";
    echo "<th width='14%'>Телефон</th>";
    echo "<th width='12%'>IP адрес</th>";
    echo "<th width='15%'>Адрес<table style='text-align: center; table-layout: fixed;' width='100%'><tr><td>дом</td><td>под.</td><td>эт.</td><td>кв.</td></tr></table></th>";
    echo "<th width='20%'>Текст заявки</th>";
    echo "<th width='20%'>Комментарии</th>";
    echo "<tr>";

    MVdb::connect();

    foreach ($_POST['id'] as $key => $value)

    {
        $query = mysql_query("SELECT id, location, house, driveway, floor, flat, phone, comment, agreement, ip_adress FROM tickets INNER JOIN location using (location_id) WHERE id='$value'");
        $result = mysql_fetch_assoc($query);

        $query = mysql_query("SELECT comment FROM comments WHERE comment_id='$value' AND comment_type_id = '2'");

        echo "<tr>";
        echo "<td>{$result['id']}</td>";
        echo "<td>{$result['agreement']}</td>";
        echo "<td>{$result['phone']}</td>";
        echo "<td>{$result['ip_adress']}</td>";
        echo "<td>{$result['location']}<table style='text-align: center; table-layout: fixed;' width='100%'><tr><td>{$result['house']}</td><td>{$result['driveway']}</td><td>{$result['floor']}</td><td>{$result['flat']}</td></tr></table></td>";
        echo "<td>{$result['comment']}</td>";
        echo "<td><table class='border'>";

        while($result = mysql_fetch_assoc($query))
        {
            echo "<tr><td>{$result['comment']}</td></tr>";
        }

        echo "</table></td>";
        echo "</tr>";
    }

    echo "</table>";
}
else {
    include_once('config.php');

    header("Location: $local/pages/502.html");
}
?>
</html>
