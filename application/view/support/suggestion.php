<div id='support_title'>Форма отправления предложений</div>
<div id='support_title2'>Укажите тему вашего обращения и текст который по вашему мнению описывает суть вашего предложения.</div>
<form method='post' action='<?= URL . 'support/insert/';?>'>
    <div id='support_title'><input autocomplete='off' type='text' placeholder='Тема вашего предложения' maxlength='30' name='subject' required></div>
    <div id='support_title'><textarea class='suggestion_comment' placeholder='Постарайтесь описать суть вашего предложения. Необходимо коротко и точно описать всю суть вашего предложения !' maxlength='500' name='comment' required></textarea></div>
    <input type='submit' id='button' value='Отправить'>
</form>