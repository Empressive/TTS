<?php

class Tickets extends Controller
{
    public function index()
    {
        $categoryes = $this->model->select("SELECT category, category_id FROM category WHERE category_id != 0");
        $locations = $this->model->select("SELECT location, location_id FROM location ORDER BY location ASC");
        $staff_groups = $this->model->select("SELECT staff_group, staff_group_id FROM staff_group WHERE staff_group_id != 0 and staff_group_id != 1");

        require APP . 'view/templates/header.php';
        require APP . 'view/tickets/index.php';
        require APP . 'view/templates/footer.php';
    }

    public function take()
    {
        $this->model->take();
    }

    public function add()
    {
        if (isset($_POST['category']) && isset($_POST['location']) && isset($_POST['phone']) && isset($_POST['executor']) && isset($_POST['comment'])) {
            $n_date = date('Y-m-d H:i:s');

            foreach ($_POST as $value => $key) {
                $_POST[$value] = htmlspecialchars(trim($key));
            }
            if ($_POST['time_date'] == null) $this->model->insert("INSERT INTO tickets (category_id, agreement, ip_adress, user_name, location_id, house, driveway, floor, flat, phone, staff_group_id, now_date, time_date, comment, staff_name_id) VALUES ('{$_POST['category']}', '{$_POST['agreement']}', '{$_POST['ip']}', '{$_POST['username']}', '{$_POST['location']}', '{$_POST['house']}', '{$_POST['driveway']}', '{$_POST['floor']}', '{$_POST['flat']}', '{$_POST['phone']}', '{$_POST['executor']}', '$n_date', NULL, '{$_POST['comment']}', '{$_SESSION['user_id']}')");
            else $this->model->insert("INSERT INTO tickets (category_id, agreement, ip_adress, user_name, location_id, house, driveway, floor, flat, phone, staff_group_id, now_date, time_date, comment, staff_name_id) VALUES ('{$_POST['category']}', '{$_POST['agreement']}', '{$_POST['ip']}', '{$_POST['username']}', '{$_POST['location']}', '{$_POST['house']}', '{$_POST['driveway']}', '{$_POST['floor']}', '{$_POST['flat']}', '{$_POST['phone']}', '{$_POST['executor']}', '$n_date', '{$_POST['time_date']}', '{$_POST['comment']}', '{$_SESSION['user_id']}')");
        }
        header('Location: ' . URL);
    }

    public function edit($id)
    {
        if (isset($_POST['category']) && isset($_POST['status']) && isset($_POST['location']) && isset($_POST['staff_group']) && isset($_POST['phone']) && isset($_POST['comment'])) {
            $n_date = date('Y-m-d H:i:s');
            foreach ($_POST as $value => $key) {
                $_POST[$value] = htmlspecialchars(trim($key));
            }
            $ticket = $this->model->select("SELECT time_date, category, category_id, staff_group, staff_group_id, location, location_id, phone, comment, status, status_id FROM tickets INNER JOIN category USING (category_id) INNER JOIN staff_group USING (staff_group_id) INNER JOIN location USING (location_id) INNER JOIN status USING (status_id) WHERE id = '{$id}'");
            if ($ticket['time_date'] != $_POST['time_date']) $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', 'Дата: {$ticket['time_date']} -> {$_POST['time_date']}', '1')");
            if ($ticket['category_id'] != $_POST['category']) {
                $future = $this->model->select("SELECT category FROM category WHERE category_id = '{$_POST['category']}'");
                $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', 'Категория: {$ticket['category']} -> {$future['category']}', '1')");
            }
            if ($ticket['location_id'] != $_POST['location']) {
                $future = $this->model->select("SELECT location FROM location WHERE location_id = '{$_POST['location']}'");
                $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', 'Сегмент: {$ticket['location']} -> {$future['location']}', '1')");
            }
            if ($ticket['staff_group_id'] != $_POST['staff_group']) {
                $future = $this->model->select("SELECT staff_group FROM staff_group WHERE staff_group_id = '{$_POST['staff_group']}'");
                $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', 'Исполнитель: {$ticket['staff_group']} -> {$future['staff_group']}', '1')");
            }
            if ($ticket['phone'] != $_POST['phone']) {
                $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', 'Телефон: {$ticket['phone']} -> {$_POST['phone']}', '1')");
            }
            if ($ticket['comment'] != $_POST['comment']) {
                $this->model->insert("INSERT INTO comment_log (log_id, now_date, staff_name_id, o_comment, n_comment) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', '{$ticket['comment']}', '{$_POST['comment']}')");
            }
            if ($_POST['status'] != 2 && ($_POST['status'] != $ticket['status_id'])) {
                $future = $this->model->select("SELECT status FROM status WHERE status_id = '{$_POST['status']}'");
                $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', 'Статус: {$ticket['status']} -> {$future['status']}', '1')");
            }
            if ($_POST['status'] != 2) {
                if ($_POST['time_date'] != null) {
                    $this->model->insert("UPDATE tickets SET time_date = '{$_POST['time_date']}', status_id = '{$_POST['status']}', category_id = '{$_POST['category']}', staff_group_id = '{$_POST['staff_group']}', location_id = '{$_POST['location']}', house = '{$_POST['house']}', driveway = '{$_POST['driveway']}', floor = '{$_POST['floor']}', flat = '{$_POST['flat']}', phone = '{$_POST['phone']}', comment = '{$_POST['comment']}' WHERE id = '{$id}'");
                } else $this->model->insert("UPDATE tickets SET time_date = NULL, status_id = '{$_POST['status']}', category_id = '{$_POST['category']}', staff_group_id = '{$_POST['staff_group']}', location_id = '{$_POST['location']}', house = '{$_POST['house']}', driveway = '{$_POST['driveway']}', floor = '{$_POST['floor']}', flat = '{$_POST['flat']}', phone = '{$_POST['phone']}', comment = '{$_POST['comment']}' WHERE id = '{$id}'");
                setcookie('status', 'success', time() + 1, '/');
                header('Location:' . URL . 'detail/view/' . $id . '/');
            } else {
                if ($_POST['time_date'] != null) {
                    $this->model->insert("UPDATE tickets SET time_date = '{$_POST['time_date']}', category_id = '{$_POST['category']}', staff_group_id = '{$_POST['staff_group']}', location_id = '{$_POST['location']}', house = '{$_POST['house']}', driveway = '{$_POST['driveway']}', floor = '{$_POST['floor']}', flat = '{$_POST['flat']}', phone = '{$_POST['phone']}', comment = '{$_POST['comment']}' WHERE id = '{$id}'");
                } else {
                    $this->model->insert("UPDATE tickets SET time_date = NULL, category_id = '{$_POST['category']}', staff_group_id = '{$_POST['staff_group']}', location_id = '{$_POST['location']}', house = '{$_POST['house']}', driveway = '{$_POST['driveway']}', floor = '{$_POST['floor']}', flat = '{$_POST['flat']}', phone = '{$_POST['phone']}', comment = '{$_POST['comment']}' WHERE id = '{$id}'");
                }
                header('Location:' . URL . 'detail/close/' . $id . '/');
            }
        } else header('Location:' . URL . 'detail/view/' . $id . '/');
    }

    public function comment($id)
    {
        if (isset($_POST['comment2']) && !empty($id) && $_POST['comment2'] != null) {
            $n_date = date('Y-m-d H:i:s');
            $_POST['comment2'] = htmlspecialchars(trim($_POST['comment2']));

            $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', '{$_POST['comment2']}', '2')");
            header('Location: ' . URL . 'detail/view/' . $id . '/');
        } else header('Location:' . URL);
    }

    public function close($id)
    {
        if (!empty($id)) {
            $n_date = date('Y-m-d H:i:s');
            $ticket = $this->model->select("SELECT status_id, status FROM tickets INNER JOIN status USING (status_id) WHERE id = '{$id}'");
            if ($ticket['status_id'] != $_POST['status']) {
                $future = $this->model->select("SELECT status FROM status WHERE status_id = '{$_POST['status']}'");
                $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', 'Статус: {$ticket['status']} -> {$future['status']}', '1')");
            }
            $reason = $this->model->select("SELECT reason FROM reason WHERE reason_id = '{$_POST['reason']}'");
            $this->model->insert("INSERT INTO comments (comment_id, now_date, staff_name_id, comment, comment_type_id) VALUES ('$id', '$n_date', '{$_SESSION['user_id']}', 'Причина закрытия: {$reason['reason']}', '1')");
            $this->model->insert("UPDATE tickets SET status_id = '{$_POST['status']}', reason_id = '{$_POST['reason']}' WHERE id = '{$id}'");

            header('Location:' . URL . 'detail/view/' . $id . '/');
        } else header('Location:' . URL);
    }
}