$(function () {
    var offset = 0;
    var limit = 50;

    $('#datepicker').datepicker().mask('9999-99-99');

    $(document).ready(function () {
        tickets();
    });

    $(window).scroll(function () {
        var scroll = $('.scroll');

        if ($(window).scrollTop() > 400) {
            scroll.css({'display': 'block'});
        }
        else {
            scroll.css({'display': 'none'});
        }
    });

    $('.scroll').click(function () {
        $('html,body').animate({scrollTop: 0}, 500);
    });

    $('select[id=status]').on('change', function () {
        offset = 0;
        tickets();
    });

    $('select[id=category]').on('change', function () {
        offset = 0;
        tickets();
    });
    $('select[id=staff_group]').on('change', function () {
        offset = 0;
        tickets();
    });

    $('input[id=datepicker]').on('change', function () {
        offset = 0;
        tickets();
    });
    $('input[id=agreement]').on('change', function () {
        offset = 0;
        tickets();
    });

    $('input[id=more]').on('click', function () {
        load();
    });

    $('div[id=result]').on('click', function (e) {
        var checkbox = $('input[type=checkbox]:checked').length;
        var button = $('button[id=fix_button]');

        if (e.target.id == 'check') {
            var check = $('input[id=check]:checked').length;
            if (check > 0) {
                $('input[id=checkbox]').prop('checked', true);
                button.css({'display': 'block'});
            }
            else {
                $('input[id=checkbox]').prop('checked', false);
                button.css({'display': 'none'});
            }
        }
        else if (e.target.id == 'checkbox') {
            if (checkbox > 0) {
                button.css({'display': 'block'});
            }
            else button.css({'display': 'none'});
        }
        else if (e.target.id == 'reset') {
            $('select[id=status]').val('0');
            $('select[id=category]').val('0');
            $('select[id=staff_group]').val('0');
            $('input[id=datepicker]').val('');
            $('input[id=agreement]').val('');
            offset = 0;
            tickets();
        }
    });

    function tickets() {
        var condition = $('#status').val();
        var agreement = $('#agreement').val();
        var category = $('#category').val();
        var date = $('#datepicker').val();
        var staff_group = $('#staff_group').val();

        $.ajax({
            url: '/tickets/take',
            method: 'POST',
            data: {
                'agreement': agreement,
                'date': date,
                'category': category,
                'staff_group': staff_group,
                'status': condition,
                'limit': limit,
                'offset': offset
            },
            success: function (response) {
                $('#result').html(response);
            }
        });
        offset += limit;
    }

    function load() {
        var condition = $('#status').val();
        var agreement = $('#agreement').val();
        var category = $('#category').val();
        var date = $('#datepicker').val();
        var staff_group = $('#staff_group').val();

        $.ajax({
            url: '/tickets/take',
            method: 'POST',
            data: {
                'agreement': agreement,
                'date': date,
                'category': category,
                'staff_group': staff_group,
                'status': condition,
                'limit': limit,
                'offset': offset,
                'json': true
            }
        }).success(function (data) {

            data = $.parseJSON(data);

            $.each(data, function (index, data) {

                if (data.time_date == null) data.time_date = '';
                if (data.agreement == null) data.agreement = '';

                var html = "<tr bgcolor='" + data.status_color + "'>" + "<td><input id='checkbox' type='checkbox' name='id[]' value='" + data.id + "'></td><td id='pointer' onclick=\"location.href='/detail/view/" + data.id + "/'\">" + data.id + "</td><td>" + data.now_date + "</td><td>" + data.time_date + "</td><td>" + data.category + "</td><td>" + data.staff_group + "</td><td>" + data.agreement + "</td><td>" + data.location + "<table class='border' width=100%'>" + "<tr><td class='border'>" + data.house + "</td><td class='border'>" + data.driveway + "</td><td class='border'>" + data.floor + "</td><td class='border'>" + data.flat + "</td></tr></table></td><td><div class='ajax_comment'>" + data.comment + "</div></td>";

                $('#main_table').append(html);

            });
        });
        offset += limit;
    }
});

