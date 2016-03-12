<?php

class UnionCore
{
    public $user_id = '';

    public $user_access = '';

    public $page = "";

    public static function getInstance()
    {
        $core = new UnionCore();
        $core->authUser();
        $core->loadRequest();
        $core->includeContent();
    }

    public function authUser()
    {
        include_once('library/UnionDB.php');

        UnionDB::connectDb();

        $this->user_id = 0;

        if (isset($_SESSION['user_id'])) {

            $this->user_id = $id = intval($_SESSION['user_id']);

            $query = mysql_query("SELECT access_id FROM staff_login WHERE id = '$id'");
            $result = mysql_fetch_assoc($query);

            $this->user_access = $result['access_id'];
        } elseif (isset($_COOKIE['user_id']) && isset($_COOKIE['token'])) {

            $id = intval($_COOKIE['user_id']);

            $query = mysql_query("SELECT token, access_id FROM staff_login WHERE id = '$id'");
            $result = mysql_fetch_assoc($query);

            $user_token = $result['token'];

            if ($_COOKIE['token'] == $user_token) {

                session_start();

                $this->user_id = $_COOKIE['user_id'];
                $this->user_access = $result['access_id'];
                $_SESSION['user_id'] = $_COOKIE['user_id'];

            }
        }
    }

    public function loadRequest()
    {
        if ($this->user_id !== 0 && $this->user_access > 0) {
            if ($_GET['page']) {

                $request = htmlspecialchars(trim($_GET['page']));
                $page = "pages/$request.php";
                $error = "pages/404.php";

                if (file_exists($page)) $this->page = $page;
                else $this->page = $error;

            } else {

                $tablePage = "pages/table.php";
                $this->page = $tablePage;

            }
        } else $this->page = "pages/log.php";
    }

    public function includeContent()
    {
        session_start();

        include_once('include/header.php');

        if ($this->user_access == 3) {
            if (($_GET['page'] == 'control') || ($_GET['page'] == 'user') || ($_GET['page'] == 'announcement') || ($_GET['page'] == 'edit') || ($_GET['page'] == 'millwright') || ($_GET['page'] == 'announce')) include_once('include/control.php');
        }

        if ($this->user_access == 2) {
            if (($_GET['page'] == 'moder') || ($_GET['page'] == 'announcement') || ($_GET['page'] == 'announce') && $this->user_access == 2) include_once('include/moder.php');
        }


        if (!isset($_GET['page']) && $this->user_id > 0 && $this->user_access > 0) include_once('include/announce.php');

        if (!isset($_GET['page']) && $this->user_id > 0 && $this->user_access > 0) include_once('include/filter.php');

        include_once("$this->page");

        include_once('include/footer.php');
    }
}
