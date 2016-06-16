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
    
    public function take()
    {
        $this->model->take();
    }
    
    public function login()
    {
        require APP . 'view/templates/headlog.php';
        require APP . 'view/home/login.php';
        require APP . 'view/templates/footer.php';
    }

    public function auth()
    {
        $this->model->login();
    }

    public function out()
    {
        $this->model->out();
    }
}