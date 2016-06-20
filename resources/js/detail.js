$(function () {
    $("#datepicker").datepicker().mask("9999-99-99");
    $("#phone").mask("+7-999-999-99-99");

    $('div[id=modal]').on('click', function () {
        var modal = $('#modal');

        modal.css({'display': 'none'});
    });

    $('span[id=active]').on('click', function () {
        var modal = $('#modal');

        modal.css({'display': 'block'});
    });
});