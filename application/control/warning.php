<?php
class Warning extends Controller
{
    public function index()
    {
        if(isset($_COOKIE['error']))
        {
            require APP . 'view/templates/headlog.php';
            require APP . 'view/warning/index.php';
            require APP . 'view/templates/footer.php';
        }
        else $this->model->error('Да чего тебе нужно ??? У тебя нет причин находиться здесь !');
    }
}