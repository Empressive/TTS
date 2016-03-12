<?php

class UnionDB
{
    public static function connectDb()
    {
        mysql_connect("localhost", "LOGIN", "PASSWORD") or die (mysql_error());
        mysql_query('SET NAMES utf8');
        mysql_select_db("tts_db") or die(mysql_error());
    }

    public static function select($table, $label, $value, $where, $order)
    {
        $query = mysql_query("SELECT {$label}, {$value} FROM {$table} {$where} ORDER BY {$order}");

        while ($resault = mysql_fetch_assoc($query)) {
            $int = $resault["$value"];
            $name = $resault["$label"];
            echo "<option value='$int'>$name</option>";
        }
    }

    public static function comment($where)
    {
        $query = mysql_query("SELECT staff_name, comment, comment_type_id, now_date FROM comments INNER JOIN staff_name USING(staff_name_id) {$where}");

        while($result = mysql_fetch_assoc($query)) {
            $staff_name = $result['staff_name'];
            $comment = $result['comment'];
            $now_date = $result['now_date'];
            $comment_type_id = $result['comment_type_id'];

            if ($comment_type_id == 1)
            {
                $color = "bgcolor='#cccccc'";
            }
            else $color = '';


            echo "<tr $color><td>$now_date</td><td>$staff_name</td><td>$comment</td></tr>";
        }
    }
}
