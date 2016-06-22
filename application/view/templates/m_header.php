<html>
<head>
    <meta charset='utf-8'>
    <title>Журнал заявок</title>
    <link rel="shortcut icon" href='<?= RESOURCES . 'img/favicon.png' ?>'/>
    <link href='<?= RESOURCES . 'css/jquery-ui.css'; ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.min.css'; ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.structure.css' ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.structure.min.css'; ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.theme.css'; ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.theme.min.css'; ?>' rel='stylesheet'>
    <link href="<?= RESOURCES . 'css/moder.css'; ?>" rel='stylesheet'>
    <script src='<?= RESOURCES . 'js/jquery-1.12.0.min.js' ?>'></script>
    <script src='<?= RESOURCES . 'js/jquery-ui.js' ?>'></script>
    <script src='<?= RESOURCES . 'js/jquery-ui.min.js' ?>'></script>
    <script src='<?= RESOURCES . 'js/jquery.maskedinput.js' ?>'></script>
    <script type="text/javascript" src="<?= RESOURCES . 'js/noty/packaged/jquery.noty.packaged.min.js' ?>"></script>
</head>
<body>
<div class='scroll'><span>⯅Наверх</span></div>
<div class='page'>
    <div class='navigation'><span onclick="location.href='<?= URL . 'moder/' ?>'" class='logo'>TTS Control Center</span><span class='web' onclick="location.href='<?= URL ?>'">Main Web</span></div>
    <div class='menu'>
        <ul>
            <li><a href='<?= URL . 'moder/ticket/' ?>'>Управление заявками</a></li>
            <li><a href='<?= URL . 'moder/user/' ?>'>Изменение монтажников</a></li>
        </ul>
    </div>