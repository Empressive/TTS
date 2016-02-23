<html>
<meta charset="utf-8">
<?php

if (isset($_POST['id'])) {

    include_once('../library/UnionDB.php');

    echo "<table width='100%' style='table-layout: fixed; text-align: center; overflow: hidden;' border='1'>";
    echo "<tr>";
    echo "<th width='6%'>Номер заявки</th>";
    echo "<th width='5%'>Договор</th>";
    echo "<th width='10%'>Телефон</th>";
    echo "<th width='8%'>IP адрес</th>";
    echo "<th width='15%'>Адрес<table style='text-align: center; table-layout: fixed;' width='100%'><tr><td>дом</td><td>под.</td><td>эт.</td><td>кв.</td></tr></table></th>";
    echo "<th width='28%'>Текст заявки</th>";
    echo "<th width='28%'>Комментарии</th>";
    echo "<tr>";

    UnionDB::connectDb();

    foreach ($_POST['id'] as $key => $value)

    {
        $query = mysql_query("SELECT id, location, house, driveway, floor, flat, phone, comment, agreement, ip_adress FROM tickets INNER JOIN location using (location_id) WHERE id='$value'");

        $result = mysql_fetch_assoc($query);
        $id = $result['id'];
        $location = $result['location'];
        $house = $result['house'];
        $driveway = $result['driveway'];
        $floor = $result['floor'];
        $flat = $result['flat'];
        $phone = $result['phone'];
        $comment = $result['comment'];
        $agreement = $result['agreement'];
        $ip = $result['ip_adress'];

        $query = mysql_query("SELECT comment FROM comments WHERE comment_id='$value' AND comment_type_id = '2'");

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$agreement</td>";
        echo "<td>$phone</td>";
        echo "<td>$ip</td>";
        echo "<td>$location<table style='text-align: center; table-layout: fixed;' width='100%'><tr><td>$house</td><td>$driveway</td><td>$floor</td><td>$flat</td></tr></table></td>";
        echo "<td>$comment</td>";
        echo "<td><table class='border'>";

        while($result = mysql_fetch_assoc($query))
        {
            $comment = $result['comment'];
            echo "<tr><td>$comment</td></tr>";
        }

        echo "</table></td>";
        echo "</tr>";
    }

    echo "</table>";
}
else if(include_once('config.php')) header("Location: {$local}");
?>
</html>
