<?php

class Moder extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->access_id < 2) header('Location:' . URL);
    }

    public function index()
    {
        require APP . 'view/templates/m_header.php';
        require APP . 'view/templates/footer.php';
    }

    public function ticket($id)
    {
        if (empty($id)) {
            $n_date = date('Y-m-d');
            $rows = $this->model->rows("SELECT id FROM tickets WHERE staff_group_id = 4 and time_date = '{$n_date}' and status_id != 2 and status_id != 1");
            $tickets = $this->model->select("SELECT id, category, location, house, floor, flat, driveway, comment FROM tickets INNER JOIN location USING (location_id) INNER JOIN category USING (category_id) WHERE staff_group_id = 4 and time_date = '{$n_date}' and status_id != 2 and status_id != 1");
        } else {
            $ticket = $this->model->rows("SELECT id FROM tickets WHERE id = '{$id}'");
            if ($ticket == 1) {
                $rows = $this->model->rows("SELECT millwright_id FROM millwright_list WHERE ticket_id = '{$id}'");
                $items = $this->model->select("SELECT millwright_id, staff_name FROM millwright_list INNER JOIN millwright USING (millwright_id) WHERE ticket_id = '{$id}'");
                $millwrights = $this->model->select("SELECT millwright_id, staff_name FROM millwright WHERE millwright_status_id != 2");
            } else $this->model->error('Кажется ты пытаешься меня обмануть !');
        }
        require APP . 'view/templates/m_header.php';
        require APP . 'view/moder/ticket.php';
        require APP . 'view/templates/footer.php';
    }

    public function user($id)
    {
        if (empty($id))
        {
            $millwrights = $this->model->select("SELECT millwright_id, staff_name, millwright_status FROM millwright INNER JOIN millwright_status USING (millwright_status_id) ORDER BY millwright_status_id ASC");
        }
        else {
            $rows = $this->model->rows("SELECT millwright_id FROM millwright WHERE millwright_id = '{$id}'");
            if($rows > 0) {
                $items = $this->model->select("SELECT staff_name, millwright_status_id, millwright_status FROM millwright INNER JOIN millwright_status USING (millwright_status_id) WHERE millwright_id = '{$id}'");
                $status = $this->model->select("SELECT * FROM millwright_status WHERE millwright_status_id != '{$items['millwright_status_id']}'");
            }
        }
        require APP . 'view/templates/m_header.php';
        require APP . 'view/moder/user.php';
        require APP . 'view/templates/footer.php';
    }

    public function millwright($action)
    {
        if ($action == 'delete' && !empty($_POST['millwright_id']) && !empty($_POST['ticket_id'])) {
            $this->model->insert("DELETE FROM millwright_list WHERE millwright_id = '{$_POST['millwright_id']}' and ticket_id = '{$_POST['ticket_id']}'");
        }

        elseif ($action == 'insert' && !empty($_POST['millwright_id']) && !empty($_POST['ticket_id'])) {
            $rows = $this->model->rows("SELECT millwright_id FROM millwright_list WHERE ticket_id = '{$_POST['ticket_id']}' and millwright_id = '{$_POST['millwright_id']}'");

            if ($rows == 0) {
                $this->model->insert("INSERT INTO millwright_list (ticket_id, millwright_id) VALUES ('{$_POST['ticket_id']}', '{$_POST['millwright_id']}')");
            }
        }
        elseif ($action == 'edit' && !empty($_POST['staff_id']) && !empty($_POST['access']))
        {
            $this->model->insert("UPDATE millwright SET millwright_status_id = '{$_POST['access']}' WHERE millwright_id = '{$_POST['staff_id']}'");
            header('Location:' . URL . 'moder/user/');
        }
        else $this->model->error('Опять ты ?????');
    }
}