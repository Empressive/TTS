<html>
<head>
    <meta charset='utf-8'>
    <title>Журнал заявок</title>
    <link rel="shortcut icon" href='<?= RESOURCES . 'img/favicon.png'?>'/>
    <link href='<?= RESOURCES . 'css/jquery-ui.css' ;?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.min.css' ;?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.structure.css' ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.structure.min.css' ;?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.theme.css' ;?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.theme.min.css' ;?>' rel='stylesheet'>
    <link href="<?= RESOURCES . 'css/style.css' ;?>" rel='stylesheet'>
    <script src='<?= RESOURCES . 'js/jquery-1.12.0.min.js'?>'></script>
    <script src='<?= RESOURCES . 'js/jquery-ui.js'?>'></script>
    <script src='<?= RESOURCES . 'js/jquery-ui.min.js'?>'></script>
    <script src='<?= RESOURCES . 'js/jquery.maskedinput.js'?>'></script>
    <script type="text/javascript" src="<?= RESOURCES . 'js/noty/packaged/jquery.noty.packaged.min.js'?>"></script>
</head>
<body>
<div class='scroll'><span>⯅Наверх</span></div>
<div class='page'>
    <div class='menu'><span onclick="location.href='<?= URL ;?>'" class='logo'>Intelway</span>
        <ul class='links'>
            <li><a href='<?= URL ;?>'>Все заявки</a></li>
            <li><a href='<?= URL ;?>tickets/'>Добавить заявку</a></li>
            <li><a href='<?= URL ;?>support/'>Обратная связь</a></li>
        </ul>
        <img onclick="location.href='<?= URL . 'home/out/'?>'" src='<?= RESOURCES . 'img/sad.png' ?>'>
    </div>