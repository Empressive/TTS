<?php

class Core
{
    private $user_id = 0;

    private $access_id = 0;

    private $controller = null;

    private $action = null;

    private $param = array();

    public function __construct()
    {
        $this->user_id();
        $this->getUrl();
        $this->result();
    }

    private function user_id()
    {
        if(isset($_SESSION['user_id']) && isset($_SESSION['login']))
        {
            $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $query = $db->query("SELECT id, access_id FROM staff_login WHERE id = '{$_SESSION['user_id']}' and login = '{$_SESSION['login']}'");

            if(!empty($result = mysqli_fetch_array($query)))
            {
                $this->user_id = $result['id'];
                $this->access_id = $result['access_id'];
            }
            else session_destroy();
        }
    }
    
    private function getUrl()
    {
        if (($this->user_id == 0 || $this->access_id == 0) && (!isset($_POST['login']) && !isset($_POST['passw']))) {
            $this->controller = 'home';
            $this->action = 'login';
        } elseif (isset($_GET['url'])) {
            $url = htmlspecialchars(trim($_GET['url'], '/'));
            $url = explode('/', $url);

            $this->controller = isset($url[0]) ? $url[0] : null;
            $this->action = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $this->param = array_values($url);
        }
    }

    private function result()
    {
        if (!$this->controller) {
            require APP . 'control/home.php';
            $page = new Home();
            $page->index();
        } elseif (file_exists(APP . 'control/' . $this->controller . '.php')) {
            require APP . 'control/' . $this->controller . '.php';

            $this->controller = new $this->controller;
            if (method_exists($this->controller, $this->action)) {
                if (!empty($this->param)) {
                    call_user_func_array(array($this->controller, $this->action), $this->param);
                } else {
                    $this->controller->{$this->action}();
                }
            } else {
                if (strlen($this->action) == 0) {
                    $this->controller->index();
                } else header('Location:' . URL);
            }
        } else header('Location:' . URL);
    }
}