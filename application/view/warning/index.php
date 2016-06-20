<? if (isset($_COOKIE['error'])) : ?>
    <div class='sheet404' style='margin-left: 10%'>
        <div class='img404'><img src='<?= RESOURCES . 'img/403.png' ?>'></div>
        <div class='main404'>
            <div class='title404'>Ошибка !</div>
            <div class='text404'><?= $_COOKIE['error'] ?></div>
        </div>
    </div>
<? endif; ?>