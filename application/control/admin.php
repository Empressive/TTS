<?php

class Admin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->access_id != 3) header('Location:' . URL);
    }

    public function index()
    {
        require APP . 'view/templates/a_header.php';
        require APP . 'view/templates/footer.php';
    }

    public function user($edit)
    {
        if (empty($edit)) {
            $staff_groups = $this->model->select("SELECT * FROM staff_group WHERE staff_group_id != 0 and staff_group_id != 1");
            $accesses = $this->model->select("SELECT * FROM access");

            require APP . 'view/templates/a_header.php';
            require APP . 'view/admin/user.php';
            require APP . 'view/templates/footer.php';
        } elseif (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['staff_group']) && isset($_POST['access']) && isset($_POST['passw']) && isset($_POST['passw2'])) {
            foreach ($_POST as $value => $key) {
                $_POST[$value] = htmlspecialchars(trim($key));
            }
            if ($_POST['passw'] === $_POST['passw2']) {
                if ($this->model->rows("SELECT id FROM staff_login WHERE login = '{$_POST['login']}'") == 0) {
                    $_POST['passw'] = password_hash($_POST['passw'], PASSWORD_BCRYPT);

                    $this->model->insert("INSERT INTO staff_login (login, staff_name, staff_group_id, token, access_id) VALUES ('{$_POST['login']}', '{$_POST['username']}', '{$_POST['staff_group']}', '{$_POST['passw']}', '{$_POST['access']}')");
                    $this->model->insert("INSERT INTO staff_name (staff_name) VALUES ('{$_POST['username']}')");

                    if($_POST['staff_group'] == 4)
                    {
                        $this->model->insert("INSERT INTO millwright (staff_name) VALUES ('{$_POST['username']}')");
                    }

                    header('Location:' . URL . 'admin/user/');
                } else header('Location:' . URL . 'admin/user/');
            } else {
                header('Location:' . URL . 'admin/');
            }
        } else header('Location:' . URL . 'admin/user/');
    }

    public function edit($id)
    {
        if (empty($_POST)) {
            if (!empty($id)) {
                $rows = $this->model->rows("SELECT id FROM staff_login WHERE id = '{$id}'");
                if ($rows > 0) {
                    $info = $this->model->select("SELECT login, staff_name, staff_group_id, staff_group, access_id, access, id FROM staff_login INNER JOIN staff_group USING (staff_group_id) INNER JOIN access USING (access_id) WHERE id = '{$id}'");
                    $accesses = $this->model->select("SELECT * FROM access WHERE access_id != '{$info['access_id']}'");
                    $staff_groups = $this->model->select("SELECT * FROM staff_group WHERE staff_group_id != 0 and staff_group_id != 1 and staff_group_id != '{$info['staff_group_id']}'");
                }
            } else {
                $all = $this->model->select("SELECT login, staff_name, access, id FROM staff_login INNER JOIN access USING (access_id) ORDER BY login ASC");
            }
            require APP . 'view/templates/a_header.php';
            require APP . 'view/admin/edit.php';
            require APP . 'view/templates/footer.php';
        }
        if (!empty($_POST) && !empty($id)) {
            if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['staff_group']) && isset($_POST['access'])) {
                foreach ($_POST as $value => $key) {
                    $_POST[$value] = htmlspecialchars(trim($key));
                }

                $this->model->insert("UPDATE staff_login SET login = '{$_POST['login']}', staff_name = '{$_POST['username']}', staff_group_id = '{$_POST['staff_group']}', access_id = '{$_POST['access']}' WHERE id = '{$id}'");
                $this->model->insert("UPDATE staff_login SET staff_name = '{$_POST['username']}' WHERE id = '{$id}'");

                if (!empty($_POST['passw']) && !empty($_POST['passw2'])) {
                    if ($_POST['passw'] === $_POST['passw2']) {
                        $_POST['passw'] = password_hash($_POST['passw'], PASSWORD_BCRYPT);
                        $this->model->insert("UPDATE staff_login SET token = '{$_POST['passw']}'");
                    }
                }
                header('Location:' . URL . 'admin/edit/');
            }
        }
    }

    public function union($action)
    {
        if ($action == 'edit') {
            require APP . 'view/templates/a_header.php';
            require APP . 'view/admin/union/edit.php';
            require APP . 'view/templates/footer.php';
        } elseif ($action == 'add') {
            require APP . 'view/templates/a_header.php';
            require APP . 'view/admin/union/add.php';
            require APP . 'view/templates/footer.php';
        }
    }

    public function add($type)
    {
        if (!empty($type) && empty($_POST)) {
            if ($type == 'location' || $type == 'staff_group' || $type == 'reason') {
                require APP . 'view/templates/a_header.php';
                require APP . 'view/admin/union/add.php';
                require APP . 'view/templates/footer.php';
            } else header('Location:' . URL . 'admin/union/add/');
        } elseif (empty($type) && !empty($_POST)) {
            foreach ($_POST as $value => $key) {
                $_POST[$value] = htmlspecialchars(trim($key));
            }
            if ($_POST['value'] === $_POST['value2']) {
                $this->model->insert("INSERT INTO {$_POST['type']} ({$_POST['type']}) VALUES ('{$_POST['value']}')");
            }
            header('Location:' . URL . 'admin/');
        }
    }
}
