$(function () {
    $("#datepicker").datepicker().mask("9999-99-99");

    $(document).ready(function () {
        tickets();
    });

    function tickets() {
        var limit = 50;
        var condition = $('#status').val();
        var agreement = $('#agreement').val();
        var category = $('#category').val();
        var date = $('#datepicker').val();
        var staff_group = $('#staff_group').val();

        $.ajax({
            url: '/home/take',
            method: 'POST',
            data: {
                "agreement": agreement,
                "date": date,
                "category": category,
                "staff_group": staff_group,
                "status": condition,
                "limit": limit,
            },
            success: function (response) {
                $('#result').html(response);
            }
        })
    }
});

