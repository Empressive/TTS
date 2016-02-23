$(function () {
    $("#datepicker").datepicker();
});

$(function($){
    $("#phone").mask("+7-999-999-99-99");
});

$(function () {

    var i;
    var limit = 50;
    var offset = limit;
    var Progress = false;

    function Ajax() {

        var condition = document.getElementById('status').value;
        var agreement = document.getElementById('agreement').value;
        var category = document.getElementById('category').value;
        var date = document.getElementById('datepicker').value;
        var staffGroup = document.getElementById('staffGroup').value;

        $.ajax({
            url: 'scripts/ajax.php',
            method: 'POST',
            data: {
                "agreement": agreement,
                "date": date,
                "category": category,
                "staffGroup": staffGroup,
                "status": condition,
                "limit": limit
            },
            success: function (response) {
                $('#result').html(response);
            }
        });
    }

    $('button[id=res_button]').on('click', function () {
        $('select[id=status]').val("0");
        $('select[id=category]').val("0");
        $('select[id=staffGroup]').val("0");
        $('input[id=datepicker]').val('');
        $('input[id=agreement]').val('');
        Ajax();
    });

    $(document).ready(function () {
        Ajax();
    });

    $('select[name=status]').on('change', function () {
        Ajax();
    });

    $('select[name=category]').on('change', function () {
        offset = limit;
        Ajax();
    });
    $('select[name=staffGroup]').on('change', function () {
        offset = limit;
        Ajax();
    });

    $('input[name=date]').on('change', function () {
        offset = limit;
        Ajax();
    });
    $('input[name=agreement]').on('change', function () {
        offset = limit;
        Ajax();
    });

    $('input[id=more]').on('click', function () {

        if (Progress == false) {
            Progress = true;
            var condition = document.getElementById('status').value;
            var agreement = document.getElementById('agreement').value;
            var category = document.getElementById('category').value;
            var date = document.getElementById('datepicker').value;
            var staffGroup = document.getElementById('staffGroup').value;

            $.ajax({
                url: 'scripts/ajax_complete.php',
                method: 'POST',
                data: {
                    "agreement": agreement,
                    "date": date,
                    "category": category,
                    "staffGroup": staffGroup,
                    "status": condition,
                    "limit": limit,
                    "offset": offset
                }
            }).done(function (data) {

                data = $.parseJSON(data);

                $.each(data, function (index, data) {

                    if (data.status == 'Не выполнена') i = '#ff9933';
                    if (data.status == 'Выполнена') i = '#66cc66';
                    if (data.status == 'Выполнена частично') i = '#ffff66';
                    if (data.status == 'Архив') i = '#cccccc';

                    $("#main_table").append("<tr bgcolor='" + i + "'>" + "<td><input id='checkbox' type='checkbox' name='id[]' value='" + data.id + "'></td><td id='cursor' onclick=\"location.href='?page=detail&id=" + data.id + "'\">" + data.id + "</td><td>" + data.now_date + "</td><td>" + data.time_date + "</td><td>" + data.category + "</td><td>" + data.staff_group + "</td><td>" + data.agreement + "</td><td>" + data.location + "<table class='border' width=100%'>" + "<tr><td class='border'>" + data.house + "</td><td class='border'>" + data.driveway + "</td><td class='border'>" + data.floor + "</td><td class='border'>" + data.flat + "</td></tr></table></td><td>" + data.comment + "</td>");
                });
                offset += limit;
                Progress = false;
            });
        }
    });
});

$(function () {
    var millwrigt2 = document.getElementById('millwright2');
    var millwrigt3 = document.getElementById('millwright3');

    $('select[name=millwright1]').on('change', function () {
        millwrigt2.style.display = 'block';
    });
    $('select[name=millwright2]').on('change', function () {
        millwrigt3.style.display = 'block';
    });
});

$(function () {
    $(window).scroll(function () {
        var scroll = document.getElementById('scroll');

        if ($(window).scrollTop() > 800) {
            scroll.style.display = 'block';
        }
        else {
            scroll.style.display = 'none';
        }
    });
    $('#scroll').click(function () {
        $('html,body').animate({scrollTop: 0}, 500);
    })
});

$(function () {
    $('div[id=result]').on('click', function () {

        var count;

        var check;

        var print = document.getElementById('print_button');

        count = $('input[id=checkbox]:checked').length;

        if (count > 0) {
            print.style.display = 'block';
        }
        else print.style.display = 'none';

        check = $('input[id=check]:checked').length;
        
        if(check > 0) {
           $("input[type=checkbox]").prop('checked', true);
          
           print.style.display = 'block';
        }
    });
});

$(function () {
    $('.announce').on('click', function () {

        var id = this.id;

        var item = document.getElementById(id);

        item.style.display = 'none';

        $.ajax({
            url: 'scripts/cookie.php',
            method: 'POST',
            data: {
                "cookie": id
            }
        });

    });
});

