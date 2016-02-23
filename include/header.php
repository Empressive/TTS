<html>
<head>
    <meta charset="utf-8">
    <title>Журнал заявок</title>
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.structure.css">
    <link rel="stylesheet" href="../css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.theme.css">
    <link rel="stylesheet" href="../css/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/add.css">
    <link rel="stylesheet" href="../css/filter.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/detail.css">
    <link rel="shortcut icon" href="../img/favicon.png"/>
    <script src="../js/jquery-1.12.0.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/jquery.maskedinput.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/scripts.js"></script>
</head>
</html>
<body>
<div id="scroll"><div id="scroll_text">▲ Наверх</div></div>
<div class="page">
    <div class="menu">
        <?php include('config.php');
        echo "<div class='logo'><a href='$local'>IntelWay</a></div>";
        if($this->user_access > 2) echo $admin;
        elseif($this->user_access == 2) echo $moder;
        elseif($this->user_access == 1) echo $user;
        ?>
    </div>