<?php

class Home extends Controller
{
    public function index()
    {
        $account = $this->model->select("SELECT status, status_id, category, category_id, time_date, agreement, staff_group, group_id FROM staff_login INNER JOIN status USING(status_id) INNER JOIN category USING(category_id) INNER JOIN staff_group ON (staff_group.staff_group_id = staff_login.group_id) WHERE id = '{$_SESSION['user_id']}'");
        $statuses = $this->model->select("SELECT status, status_id FROM status WHERE status_id != '{$account['status_id']}' ORDER BY status_id ASC");
        $categoryes = $this->model->select("SELECT category, category_id FROM category WHERE category_id != '{$account['category_id']}'");
        $staff_groups = $this->model->select("SELECT staff_group, staff_group_id FROM staff_group WHERE staff_group_id != '{$account['group_id']}' and staff_group_id !='1'");

        require APP . 'view/templates/header.php';
        require APP . 'view/home/filter.php';
        require APP . 'view/home/index.php';
        require APP . 'view/templates/footer.php';
    }

    public function login()
    {
        require APP . 'view/templates/headlog.php';
        require APP . 'view/home/login.php';
        require APP . 'view/templates/footer.php';
    }

    public function printed()
    {
        if (isset($_POST['id'])) {
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
            foreach ($_POST['id'] as $key => $value) {
                $result = $this->model->select("SELECT id, location, house, driveway, floor, flat, phone, comment, agreement, ip_adress FROM tickets INNER JOIN location using (location_id) WHERE id='$value'");
                $comments = $this->model->select("SELECT comment FROM comments WHERE comment_id='$value' AND comment_type_id = '2'");
                $rows = $this->model->rows("SELECT comment_id FROM comments WHERE comment_id='$value' AND comment_type_id = '2'");
                if (strripos($result['comment'], 0x20) === false && mb_strlen($result['comment']) > 30) $result['comment'] = mb_substr($result['comment'], 0, 30) . '...';
                echo "<tr>";
                echo "<td>{$result['id']}</td>";
                echo "<td>{$result['agreement']}</td>";
                echo "<td>{$result['phone']}</td>";
                echo "<td>{$result['ip_adress']}</td>";
                echo "<td>{$result['location']}<table style='text-align: center; table-layout: fixed;' width='100%'><tr><td>{$result['house']}</td><td>{$result['driveway']}</td><td>{$result['floor']}</td><td>{$result['flat']}</td></tr></table></td>";
                echo "<td>{$result['comment']}</td>";
                echo "<td><table class='border'>";
                if ($rows > 1) {
                    foreach ($comments as $comment) {
                        if (strripos($comment['comment'], 0x20) === false && mb_strlen($comment['comment']) > 30) $comment['comment'] = mb_substr($comment['comment'], 0, 30) . '...';
                        echo "<tr><td>{$comment['comment']}</td></tr>";
                    }
                } else echo "<tr><td>{$comments['comment']}</td></tr>";
                echo "</table></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else header('Location:' . URL);
    }

    public function tickets() {
        $staff_group_id = $this->model->select("SELECT staff_group_id FROM staff_login WHERE id = '{$_SESSION['user_id']}'");
        $n_date = date('Y-m-d');

        $rows = $this->model->rows("SELECT id FROM tickets WHERE status_id != 0 and status_id != 1 and status_id != 2 and staff_group_id = '{$staff_group_id['staff_group_id']}' and time_date BETWEEN '0000-00-00' and '{$n_date}'");
        $tickets = $this->model->select("SELECT * FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE status_id != 0 and status_id != 1 and status_id != 2 and staff_group_id = '{$staff_group_id['staff_group_id']}' and time_date BETWEEN '0000-00-00' and '{$n_date}'");

        if($tickets != null)
        {
            require APP . 'view/templates/header.php';
            require APP . 'view/home/tickets.php';
            require APP . 'view/templates/footer.php';
        }
        else $this->model->error('Хватит все ломать !');
    }

    public function auth()
    {
        $this->model->login();
        header('Location:' . URL);
    }

    public function out()
    {
        $this->model->out();
        header('Location:' . URL);
    }
}