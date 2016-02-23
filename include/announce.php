<?php
include_once('config.php');
include_once('library/UnionDB.php');

UnionDB::connectDb();

$announce1 = $_COOKIE['announce1'];

$announce2 = $_COOKIE['announce2'];

$announce3 = $_COOKIE['announce3'];

if(isset($announce3) && isset($announce2) && isset($announce1))
{
    $query = mysql_query("SELECT comment, comment_id FROM announcement INNER JOIN staff_name USING (staff_name_id) WHERE comment_type_id = '3' and status_id != '1' and comment_id != {$announce3} and comment_id != {$announce2} and comment_id != {$announce1} ORDER BY comment_id DESC LIMIT 3");

}
elseif(isset($announce1) && isset($announce2) && !isset($announce3))
{
    $query = mysql_query("SELECT comment, comment_id FROM announcement INNER JOIN staff_name USING (staff_name_id) WHERE comment_type_id = '3' and status_id != '1' and comment_id != {$announce2} and comment_id != {$announce1} ORDER BY comment_id DESC LIMIT 3");
}
elseif(isset($announce1) && !isset($announce2) && !isset($announce3))
{
    $query = mysql_query("SELECT comment, comment_id FROM announcement INNER JOIN staff_name USING (staff_name_id) WHERE comment_type_id = '3' and status_id != '1' and comment_id != {$announce1} ORDER BY comment_id DESC LIMIT 3");
}
elseif(!isset($announce1) && !isset($announce2) && !isset($announce3))
{
    $query = mysql_query("SELECT comment, comment_id FROM announcement INNER JOIN staff_name USING (staff_name_id) WHERE comment_type_id = '3' and status_id != '1' ORDER BY comment_id DESC LIMIT 3");

}

if (mysql_num_rows($query) > 0) {

    while($resault = mysql_fetch_assoc($query))
    {
        $comment = $resault['comment'];
        $comment_id = $resault['comment_id'];

        echo "<table border='1' class='announce' id='$comment_id'>";
        echo "<tr><td bgcolor='#ffff66' width='100%'>$comment</td></tr>";
        echo "</table>";
    }
}