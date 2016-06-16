<html>
<head>
    <meta charset='utf-8'>
    <title>Журнал заявок</title>
    <link href='<?echo RESOURCES . 'css/jquery-ui.css' ;?>' rel='stylesheet'>
    <link href='<?echo RESOURCES . 'css/jquery-ui.min.css' ;?>' rel='stylesheet'>
    <link href='<?echo RESOURCES . 'css/jquery-ui.structure.css' ?>' rel='stylesheet'>
    <link href='<?echo RESOURCES . 'css/jquery-ui.structure.min.css' ;?>' rel='stylesheet'>
    <link href='<?echo RESOURCES . 'css/jquery-ui.theme.css' ;?>' rel='stylesheet'>
    <link href='<?echo RESOURCES . 'css/jquery-ui.theme.min.css' ;?>' rel='stylesheet'>
    <link href="<?echo RESOURCES . 'css/style.css' ;?>" rel='stylesheet'>
    <script src='<?echo RESOURCES . 'js/jquery-1.12.0.min.js'?>'></script>
    <script src='<?echo RESOURCES . 'js/jquery-ui.js'?>'></script>
    <script src='<?echo RESOURCES . 'js/jquery-ui.min.js'?>'></script>
    <script src='<?echo RESOURCES . 'js/jquery.maskedinput.js'?>'></script>
</head>
<body>
<div class='page'>
    <div class='menu' onclick="location.href='<?echo URL ;?>'"><span class='logo'>Intelway</span>
        <ul class='links'>
            <li><a href='<?echo URL ;?>'>Все заявки</a></li>
            <li><a href='<?echo URL ;?>detail/add/'>Добавить заявку</a></li>
            <li><a href='<?echo URL ;?>support/'>Обратная связь</a></li>
        </ul>
        <img src='<?echo RESOURCES . 'img/sad.png' ;?>' onclick="location.href='<?echo URL . 'home/out/' ;?>'">
    </div>