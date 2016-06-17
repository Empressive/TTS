<?php
class Support extends Controller
{
    public function index()
    {
        $suggestions = $this->model->select("SELECT now_date, staff_name, subject, comment, status_color FROM suggestion INNER JOIN staff_name USING (staff_name_id) INNER JOIN status USING (status_id) ORDER BY suggestion_id DESC LIMIT 20");
        $rows = $this->model->select("SELECT suggestion_id FROM suggestion ORDER BY suggestion_id DESC LIMIT 20");
        require APP . 'view/templates/header.php';
        require APP . 'view/support/support.php';
        require APP . 'view/templates/footer.php';
    }

    public function add()
    {
        require APP . 'view/templates/header.php';
        require APP . 'view/support/suggestion.php';
        require APP . 'view/templates/footer.php';
    }
    
    public function insert()
    {
        if(isset($_POST['subject']) && isset($_POST['comment']))
        {
            $subject = htmlspecialchars(trim($_POST['subject']));
            $comment = htmlspecialchars(trim($_POST['comment']));
            $n_date = date('Y-m-d H:i:s');
            $this->model->insert("INSERT INTO suggestion (now_date, staff_name_id, subject, comment) VALUES ('$n_date', '{$_SESSION['user_id']}', '$subject', '$comment')");
        }
        header('Location: ' . URL . 'support/');
    }
}