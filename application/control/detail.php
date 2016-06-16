<?php

class Detail extends Controller
{
    public function index()
    {
        header('Location:' . URL);
    }

    public function add()
    {
        $categoryes = $this->model->select("SELECT category, category_id FROM category WHERE category_id != 0");
        $locations = $this->model->select("SELECT location, location_id FROM location ORDER BY location ASC");
        $staff_groups = $this->model->select("SELECT staff_group, staff_group_id FROM staff_group WHERE staff_group_id != 0 and staff_group_id != 1");

        require APP . 'view/templates/header.php';
        require APP . 'view/detail/add.php';
        require APP . 'view/templates/footer.php';
    }
    
    public function view($id)
    {
        $id = intval($id);
        $items = $this->model->select("SELECT * FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) INNER JOIN staff_name USING(staff_name_id) WHERE id = '$id'");
        if($access = $this->model->select("SELECT access_id FROM staff_login WHERE id = '{$_SESSION['user_id']}'" && ($items['status_id'] == 2 || $items['status_id'] == 1) < 2)) $access = 'disabled';
        else $access = null;
        
        $statuses = $this->model->select("SELECT status, status_id FROM status WHERE status_id != '{$items['status_id']}' and status_id != 0 and status_id != 1");
        $categoryes = $this->model->select("SELECT category, category_id FROM category WHERE category_id != '{$items['category_id']}' and category_id != 0");
        $staff_groups = $this->model->select("SELECT staff_group, staff_group_id FROM staff_group WHERE staff_group_id != '{$items['staff_group_id']}' and staff_group_id != 0 and staff_group_id != 1");
        $locations = $this->model->select("SELECT location, location_id FROM location WHERE location_id != '{$items['location_id']}' ORDER BY location ASC");
        $comments = $this->model->select("SELECT * FROM comments INNER JOIN staff_name USING (staff_name_id) WHERE comment_id = '{$id}'");
        $comment_rows = $this->model->rows("SELECT * FROM comments INNER JOIN staff_name USING (staff_name_id) WHERE comment_id = '{$id}'");

        require APP . 'view/templates/header.php';
        require APP . 'view/detail/index.php';
        require APP . 'view/templates/footer.php';
    }
}