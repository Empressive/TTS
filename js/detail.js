$(document).ready(function () {
    var success = document.getElementById('success').value;

    if(success > 0)
    {
        noty({
            text: "<div class='alert'>Изменения сохранены !</div>",
            textAlign: "center",
            layout: 'topRight',
            type: 'success',
            timeout: '1000'
        });
    }
});
