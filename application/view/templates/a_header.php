<html>
<head>
    <meta charset='utf-8'>
    <title>Журнал заявок</title>
    <link rel="shortcut icon" href='<?= RESOURCES . 'img/favicon.png'?>'/>
    <link href='<?= RESOURCES . 'css/jquery-ui.css'; ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.min.css'; ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.structure.css' ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.structure.min.css'; ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.theme.css'; ?>' rel='stylesheet'>
    <link href='<?= RESOURCES . 'css/jquery-ui.theme.min.css'; ?>' rel='stylesheet'>
    <link href="<?= RESOURCES . 'css/admin.css'; ?>" rel='stylesheet'>
    <script src='<?= RESOURCES . 'js/jquery-1.12.0.min.js' ?>'></script>
    <script src='<?= RESOURCES . 'js/jquery-ui.js' ?>'></script>
    <script src='<?= RESOURCES . 'js/jquery-ui.min.js' ?>'></script>
    <script src='<?= RESOURCES . 'js/jquery.maskedinput.js' ?>'></script>
    <script type="text/javascript" src="<?= RESOURCES . 'js/noty/packaged/jquery.noty.packaged.min.js' ?>"></script>
</head>
<body>
<div class='scroll'><span>⯅Наверх</span></div>
<div class='page'>
    <div class='navigation'><span onclick="location.href='<?= URL . 'admin/'?>'" class='logo'>TTS Control Center</span><span class='suggestion' onclick="location.href='<?= URL ?>admin/suggestion/'">Suggestion</span><span class='web' onclick="window.open('<?= URL ?>', target='_blank')">Main Web</span></div>
    <div class='menu'>
        <ul>
            <li><a href='<?= URL . 'admin/user/' ?>'>Добавить сотрудника</a></li>
            <li><a href='<?= URL . 'admin/edit/' ?>'>Редактировать сотрудника</a></li>
            <li><a href='<?= URL . 'admin/union/add/' ?>'>Добавление данных</a></li>
            <li><a href='<?= URL . 'admin/union/edit/' ?>'>Редактирование данных</a></li>
        </ul>
    </div>


 