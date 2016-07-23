<?php

class Model
{
    function __construct($db)
    {
        $this->db = $db;
    }

    public function login()
    {
        if (isset($_POST['login']) && isset($_POST['passw'])) {
            $login = htmlspecialchars(trim($_POST['login']));

            $query = $this->db->query("SELECT id, token, login FROM staff_login WHERE login = '$login'");
            if (!empty($result = mysqli_fetch_array($query))) {

                if (password_verify($_POST['passw'], $result['token'])) {
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['login'] = $result['login'];
                }
            }
        }
    }

    public function select($query)
    {
        $result = $this->db->query($query);
        if (mysqli_num_rows($result) > 1) {
            while ($item = mysqli_fetch_array($result)) {
                $items[] = $item;
            }
        } else {
            $items = mysqli_fetch_array($result);
        }
        return $items;
    }

    public function insert($query)
    {
        $this->db->query($query);
    }

    public function rows($query)
    {
        $result = $this->db->query($query);
        return mysqli_num_rows($result);
    }

    public function out()
    {
        session_destroy();
    }

    public function error($text)
    {
        setcookie('error', $text, time() + 1, '/');
        header('Location:' . URL . 'warning/');
    }

    public function take()
    {
        if (isset($_POST['agreement']) && isset($_POST['date']) && isset($_POST['category']) && isset($_POST['staff_group']) && isset($_POST['status']) && isset($_POST['limit']) && isset($_POST['offset'])) {
            $limit = intval($_POST['limit']);
            $offset = intval($_POST['offset']);
            $status = intval($_POST['status']);
            $category = intval($_POST['category']);
            $date = htmlspecialchars(trim($_POST['date']));
            $staff_group = intval($_POST['staff_group']);
            $agreement = htmlspecialchars(trim($_POST['agreement']));

            if ($date != null) $this->db->query("UPDATE staff_login SET status_id = '{$status}', category_id = '{$category}', time_date = '{$date}', group_id = '{$staff_group}', agreement = '{$agreement}' WHERE id = '{$_SESSION['user_id']}'");
            else $this->db->query("UPDATE staff_login SET status_id = '{$status}', category_id = '{$category}', time_date = NULL, group_id = '{$staff_group}', agreement = '{$agreement}'");


            if ($status == 0) $status = "status_id = ANY(SELECT status_id FROM tickets)";
            else $status = "status_id = '$status'";
            if ($category == 0) $category = null;
            else $category = "and category_id = '$category'";
            if ($date == 0) $date = null;
            else $date = "and time_date = '$date'";
            if ($staff_group == 0) $staff_group = null;
            else $staff_group = "and staff_group_id = '$staff_group'";
            if ($agreement == 0) $agreement = null;
            else $agreement = "and agreement = '$agreement'";

            $query = $this->db->query("SELECT id FROM tickets WHERE {$status} {$category} {$date} {$staff_group} {$agreement}");
            $result = mysqli_num_rows($query);

            $query = $this->db->query("SELECT * FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE {$status} {$category} {$date} {$staff_group} {$agreement} ORDER BY id DESC limit {$offset}, {$limit}");

            $staff_group_id = $this->db->query("SELECT staff_group_id FROM staff_login WHERE id = '{$_SESSION['user_id']}'");
            $staff_group_id = mysqli_fetch_array($staff_group_id);

            $n_date = date('Y-m-d');
            $tickets = $this->db->query("SELECT id FROM tickets WHERE status_id != 0 and status_id != 1 and status_id != 2 and staff_group_id = '{$staff_group_id['staff_group_id']}' and time_date BETWEEN '0000-00-00' and '{$n_date}'");
            $tickets = mysqli_num_rows($tickets);

            if (empty($_POST['json'])) {
                echo "<table class='main_table' id='main_table' border='1'>";
                if ($tickets > 0) {
                    echo "<tr><th colspan='9'>Количество заявок: <span id='reset'>$result</span><div class='index' onclick=\"location.href= 'home/tickets/'\"><span>$tickets</span></div></th></tr>";
                } else {
                    echo "<tr><th colspan='9'>Количество заявок: <span id='reset'>$result</span></th></tr>";

                }
                echo "<tr bgcolor='#339999'>";
                echo "<td width='3%'><input type='checkbox' id='check'></td>";
                echo "<td width='8%' id='td_color'>Номер заявки</td>";
                echo "<td width='10%' id='td_color'>Дата принятия</td>";
                echo "<td width='10%' id='td_color'>Дата выполнения</td>";
                echo "<td width='12%' id='td_color'>Категория</td>";
                echo "<td width='11%' id='td_color'>Исполнитель</td>";
                echo "<td width='8%' id='td_color'>Договор</td>";
                echo "<td width='15%' id='td_color'>Адрес<table class='border' width=100%><tr><td id='td_color'>дом</td><td id='td_color'>под.</td><td id='td_color'>эт.</td><td id='td_color'>кв.</td></tr></table></td>";
                echo "<td width='23%' id='td_color'>Комментарий</td>";
                echo "</tr>";

                while ($result = mysqli_fetch_array($query)) {
                    if (strripos($result['comment'], 0x20) === false && mb_strlen($result['comment']) > 30) {
                        mb_internal_encoding("UTF-8");
                        $result['comment'] = mb_substr($result['comment'], 0, 30) . '...';
                    }
                    if (strripos($result['agreement'], 0x20) === false && mb_strlen($result['comment']) > 6) {
                        $result['agreement'] = mb_substr($result['agreement'], 0, 7);
                    }
                    echo "<tr bgcolor='{$result['status_color']}'><td><input id='checkbox' type='checkbox' name='id[]' value='{$result['id']}'></td><td id='pointer' onclick=\"location.href= 'detail/view/{$result['id']}/'\">{$result['id']}</td><td>{$result['now_date']}</td><td>{$result['time_date']}</td><td>{$result['category']}</td><td>{$result['staff_group']}</td><td>{$result['agreement']}</td><td>{$result['location']}<table class='border' width=100%><tr><td>{$result['house']}</td></td><td>{$result['driveway']}</td><td>{$result['floor']}</td><td>{$result['flat']}</td></tr></table></td><td>{$result['comment']}</td></tr>";
                }
                echo "<table>";
            } else {
                $items = array();
                while ($result = mysqli_fetch_array($query)) {
                    if (strripos($result['comment'], 0x20) === false && mb_strlen($result['comment']) > 30) {
                        mb_internal_encoding("UTF-8");
                        $result['comment'] = mb_substr($result['comment'], 0, 30) . '...';
                    }
                    if (strripos($result['agreement'], 0x20) === false && mb_strlen($result['comment']) > 6) {
                        $result['agreement'] = mb_substr($result['agreement'], 0, 7);
                    }
                    $items[] = $result;
                }
                echo json_encode($items);
            }
        }
    }
}