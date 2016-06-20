<?php
class Controller
{
    public $db = null;

    public $model = null;
    
    public $access_id = null;

    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
        $this->access();
    }

    private function openDatabaseConnection()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db->set_charset('utf8');
    }

    public function loadModel()
    {
        require APP . 'model/model.php';
        
        $this->model = new Model($this->db);
    }
    
    public function access()
    {
        $access = $this->model->select("SELECT access_id FROM staff_login WHERE id = '{$_SESSION['user_id']}'");
        $this->access_id = $access['access_id'];
    }
}