jQuery(function($) {
    var form = $('#job_offers_search_form');
    var action = form.attr('action');
    var page = 1;

    function paginationLisener() {
        $('.search-pagination').click(function(e) {
            page = e.target.dataset.page;
            submit_form();
            page = 1;
        })
    }

    function submit_form() {
        $.ajax({
            url: action,
            data: form.serialize() + '&page=' + page,
            type: form.attr('method'),
            beforeSend: function(xhr) {},
            success: function(data) {
                $('#job_offers_search_result').html(data);
                paginationLisener()
            }
        });
        return false;
    }
    $('#where').keyup(function() {
        submit_form()
    })
    form.change(submit_form)
    form.submit(function(e) {
        e.preventDefault()
        submit_form()
    })
});


jQuery(function($) {
    var form = $('#searchform');
    var action = form.attr('action');

    function submit_form() {
        $.ajax({
            url: action,
            data: form.serialize(),
            type: form.attr('method'),
            success: function(data) {
                console.log(data)
                $('#searchformBlock').html(data);
            }
        });
        return false;
    }
    $('#s').keyup(function() {
        submit_form()
    })
    form.submit(function(e) {
        e.preventDefault()
        submit_form()
    })
});