<?php
class Warning extends Controller
{
    public function index()
    {
        require APP . 'view/templates/headlog.php';
        require APP . 'view/warning/index.php';
        require APP . 'view/templates/footer.php';
    }
}