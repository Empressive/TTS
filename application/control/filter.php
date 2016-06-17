<?php
class Filter extends Controller
{
    public function view($id)
    {
        if(!empty($id))
        {
            $rows = $this->model->rows("SELECT id FROM tickets WHERE agreement = {$id}");
            $tickets = $this->model->select("SELECT * FROM tickets INNER JOIN category using(category_id) INNER JOIN location using(location_id) INNER JOIN staff_group using(staff_group_id) INNER JOIN status using(status_id) WHERE agreement = '{$id}' ORDER BY id DESC limit 50");
            
            require APP . 'view/templates/header.php';
            require APP . 'view/filter/index.php';
            require APP . 'view/templates/footer.php';
        }
    }
}