<?php

class Detail extends Controller
{
    public function index()
    {
        header('Location:' . URL);
    }

    public function view($id)
    {
        if (isset($_POST['application'])) header('Location:' . URL . 'detail/view/' . $_POST['application'] . '/');
        else {
            $id = intval($id);
            if ($this->model->rows("SELECT id FROM tickets WHERE id = {$id}") > 0) {
                $items = $this->model->select("SELECT * FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) INNER JOIN staff_name USING(staff_name_id) WHERE id = '$id'");
                $access = $this->model->select("SELECT access_id FROM staff_login WHERE id = '{$_SESSION['user_id']}'");
                if ($access['access_id'] < 3 && ($items['status_id'] == 2 || $items['status_id'] == 1)) $access = 'disabled';
                else $access = null;

                $link = str_replace('/', '-', $items['agreement']);

                $statuses = $this->model->select("SELECT status, status_id FROM status WHERE status_id != '{$items['status_id']}' and status_id != 0 and status_id != 1");
                $categoryes = $this->model->select("SELECT category, category_id FROM category WHERE category_id != '{$items['category_id']}' and category_id != 0");
                $staff_groups = $this->model->select("SELECT staff_group, staff_group_id FROM staff_group WHERE staff_group_id != '{$items['staff_group_id']}' and staff_group_id != 0 and staff_group_id != 1");
                $locations = $this->model->select("SELECT location, location_id FROM location WHERE location_id != '{$items['location_id']}' ORDER BY location ASC");
                $comments = $this->model->select("SELECT * FROM comments INNER JOIN staff_name USING (staff_name_id) WHERE comment_id = '{$id}'");
                $comment_rows = $this->model->rows("SELECT comment_id FROM comments INNER JOIN staff_name USING (staff_name_id) WHERE comment_id = '{$id}'");
                $logs = $this->model->select("SELECT * FROM comment_log INNER JOIN staff_name USING (staff_name_id) WHERE log_id = '{$id}' ORDER BY now_date DESC limit 5");
                $logs_rows = $this->model->rows("SELECT log_id FROM comment_log INNER JOIN staff_name USING (staff_name_id) WHERE log_id = '{$id}'");

                require APP . 'view/templates/header.php';
                require APP . 'view/detail/index.php';
                require APP . 'view/detail/comment_log.php';
                require APP . 'view/templates/footer.php';
            }
            else $this->model->error('Мне кажется, ты пытаешься что-то сломать o_O');
        }
    }

    public function close($id)
    {
        if (!empty($id)) {
            if ($this->model->rows("SELECT id FROM tickets WHERE id = {$id} and status_id != 1 and status_id != 2") > 0) {
                $reasons = $this->model->select("SELECT * FROM reason WHERE reason_id != 0");
                require APP . 'view/templates/header.php';
                require APP . 'view/detail/close.php';
                require APP . 'view/templates/footer.php';
            } else $this->model->error('Ну вот, ты опять все сломал !');
        } else $this->model->error('Мне кажется, ты пытаешься что-то сломать o_O');
    }
}