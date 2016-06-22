$(function () {
    $('table[id=delete_table]').on('click', function (e) {
        var millwright_id = e.target.id;
        var ticket_id = $('#ticket_id').val();

        if (millwright_id > 0) {
            remove(millwright_id, ticket_id);
        }
    });

    $('table[id=insert_table]').on('click', function (e) {
        var millwright_id = e.target.id;
        var ticket_id = $('#ticket_id').val();

        if (millwright_id > 0) {
            insert(millwright_id, ticket_id);
        }
    });
    
    function remove(millwright_id, ticket_id) {
        $.ajax({
            url: '/moder/millwright/delete/',
            method: 'POST',
            data: {
                'ticket_id': ticket_id,
                'millwright_id': millwright_id
            },
            success: function () {
                location.href = '/moder/ticket/' + ticket_id + '/'
            }
        });
    }
    
    function insert(millwright_id, ticket_id) {
        $.ajax({
            url: '/moder/millwright/insert/',
            method: 'POST',
            data: {
                'ticket_id': ticket_id,
                'millwright_id': millwright_id
            },
            success: function () {
                location.href = '/moder/ticket/' + ticket_id + '/'
            }
        });
    }
});