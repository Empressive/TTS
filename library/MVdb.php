<?php

class MVdb
{
    public static function connect()
    {
        mysql_connect("localhost", "", "") or die (mysql_error());
        mysql_query('SET NAMES utf8');
        mysql_select_db("tts_db") or die(mysql_error());
    }

    public static function select($table, $label, $value, $where, $order)
    {
        $query = mysql_query("SELECT {$label}, {$value} FROM {$table} {$where} ORDER BY {$order}");

        while ($result = mysql_fetch_assoc($query)) {
            echo "<option value='{$result["$value"]}'>{$result["$label"]}</option>";
        }
    }

    public static function comment($where)
    {
        $query = mysql_query("SELECT staff_name, comment, comment_type_id, now_date FROM comments INNER JOIN staff_name USING(staff_name_id) {$where}");

        while($result = mysql_fetch_assoc($query)) {

            if ($result['comment_type_id']== 1)
            {
                $color = "bgcolor='#cccccc'";
            }
            else $color = '';


            echo "<tr $color><td>{$result['now_date']}</td><td>{$result['staff_name']}</td><td>{$result['comment']}</td></tr>";
        }
    }

    public static function millwright($mw_number, $item_id)
    {
        $css_id = "millwright$mw_number";
        $mw_number = "millwright_$mw_number";
        $item_id = intval($item_id);

        $query = mysql_query("SELECT staff_name, millwright_1 FROM tickets, millwright WHERE millwright_id = {$mw_number} AND id = {$item_id} ORDER BY staff_name ASC");

        if(mysql_num_rows($query) > 0)
        {
            $result = mysql_fetch_assoc($query);
            echo "<tr><td colspan='2'><select class='millwright' id='{$css_id}' name='{$css_id}'><option value='{$result[$mw_number]}'>{$result['staff_name']}</option>";

            $query = mysql_query("SELECT * FROM millwright WHERE millwright_id != {$result[$mw_number]} and millwright_status_id !=2 ORDER BY staff_name ASC");
            while($result = mysql_fetch_assoc($query))
            {
                echo "<option value='{$result['millwright_id']}'>{$result['staff_name']}</option>";
            }
            echo "</select></td></tr>";
        }
        else {
            echo "<tr><td colspan='2'><select class='millwright' id='{$css_id}' name='{$css_id}'><option value='0'>Выберите монтажника</option>";
            $query = mysql_query("SELECT * FROM millwright WHERE millwright_status_id !=2 ORDER  BY staff_name ASC");
            while ($result = mysql_fetch_assoc($query)) {
                echo "<option value='{$result['millwright_id']}'>{$result['staff_name']}</option>";
            }
            echo "</select></td></tr>";
        }
    }
}
