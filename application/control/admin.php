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

                    if ($_POST['staff_group'] == 4) {
                        $this->model->insert("INSERT INTO millwright (staff_name) VALUES ('{$_POST['username']}')");
                    }

                    header('Location:' . URL . 'admin/user/');
                } else {
                    $this->model->error('Пользователь с таким логином уже существует.');
                }
            } else {
                $this->model->error('Пароли не совпадают.');
            }
        } else {
            $this->model->error('Не передан обязательный идентификатор.');
        }
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
                $all = $this->model->select("SELECT login, staff_name, access, id FROM staff_login INNER JOIN access USING (access_id) ORDER BY access_id DESC");
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

                if ($_POST['staff_group'] == 4) {
                    $this->model->insert("UPDATE millwright SET staff_name = '{$_POST['username']}' WHERE staff_name = '{$_POST['old_name']}'");
                }

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
        } else {
            $this->model->error('Ты пытаешься найти то, чего не нет.');
        }
    }

    public function add($type)
    {
        if (!empty($type) && empty($_POST)) {
            if ($type == 'location' || $type == 'staff_group' || $type == 'reason') {
                require APP . 'view/templates/a_header.php';
                require APP . 'view/admin/union/add.php';
                require APP . 'view/templates/footer.php';
            } else {
                $this->model->error('Ты пыташься найти то, чего нет.');
            }
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

    public function update($type, $id, $action)
    {
        if (!empty($type) && empty($_POST) && empty($action)) {
            if ($type == 'location' || $type == 'staff_group' || $type == 'reason') {
                if ($type == 'staff_group') $group = "WHERE staff_group_id != 0 and staff_group_id != 1";
                else $group = null;
                if (!empty($id)) {
                    $type_id = $type . '_id';
                    $item = $this->model->select("SELECT * FROM {$type} WHERE $type_id = '{$id}'");
                } else $items = $this->model->select("SELECT * FROM {$type} {$group}");
                require APP . 'view/templates/a_header.php';
                require APP . 'view/admin/union/edit.php';
                require APP . 'view/templates/footer.php';
            } else {
                $this->model->error('Ты пытаешься найти то, чего нет.');
            }
        } elseif (!empty($type) && !empty($id) && !empty($_POST) && !empty($action)) {
            $_POST['value'] = htmlspecialchars(trim($_POST['value']));
            $type_id = $type . '_id';

            if ($action == 'delete') {
                $this->model->insert("DELETE FROM {$type} WHERE $type_id = '{$id}'");
                header('Location:' . URL . 'admin/update/' . $type);
            } elseif ($action == 'update') {
                $this->model->insert("UPDATE {$type} SET {$type} = '{$_POST['value']}' WHERE $type_id = '{$id}'");
                header('Location:' . URL . 'admin/update/' . $type);
            } else $this->model->error('Ты пытаешься найти то, чего нет.');
        } else header('Location:' . URL . 'admin/');
    }

    public function suggestion()
    {
        if (empty($_POST)) {
            $rows = $this->model->rows("SELECT suggestion_id FROM suggestion");
            $suggestions = $this->model->select("SELECT suggestion_id, now_date, staff_name, subject, comment, status_color FROM suggestion INNER JOIN status USING (status_id) INNER JOIN staff_login ON (staff_name_id = id) ORDER BY suggestion.status_id ASC");

            if ($suggestions != null) {
                require APP . 'view/templates/a_header.php';
                require APP . 'view/admin/suggestions.php';
                require APP . 'view/templates/footer.php';
            } else $this->model->error('Извини, но пока нет ни одного предложения :(');
        } elseif (!empty($_POST['id'])) {
            foreach ($_POST['id'] as $key => $value) {
                $status = $this->model->select("SELECT status_id FROM suggestion WHERE suggestion_id = '{$value}'");
                if ($status['status_id'] == 2) $this->model->insert("UPDATE suggestion SET status_id = 3 WHERE suggestion_id = '$value'");
                elseif ($status['status_id'] == 3) $this->model->insert("UPDATE suggestion SET status_id = 4 WHERE suggestion_id = '$value'");
                elseif ($status['status_id'] == 4) $this->model->insert("UPDATE suggestion SET status_id = 2 WHERE suggestion_id = '$value'");
                header('Location:' . URL . 'admin/suggestion/');
            }
        }
    }
}
