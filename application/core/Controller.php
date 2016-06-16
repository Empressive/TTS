<?php
class Controller
{
    public $db = null;

    public $model = null;

    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
    }

    private function openDatabaseConnection()
    {
        $this->db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->db->set_charset('utf8');
    }

    public function loadModel()
    {
        require APP . 'model/model.php';
        
        $this->model = new Model($this->db);
    }
}