$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getLaws(page);
        }
    }
});

$(document).ready(function() {
    $(document).on('click', '.pagination li a', function (e) {
        getLaws($(this).attr('href'));
        e.preventDefault();
    });
});

function getLaws(url) {
    $.ajax({
        url : url,
        dataType: 'json',
    }).done(function (response) {
        $('.advanced-search-render-html').html(response['renderHtml']);
        location.hash = page;
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
}
$('#advanced-search-form').submit(function() {
    var form = this;
    $(form).find('input[type=submit]').prop('disabled', true);
    $('#flash-overlay').css('display', 'block');
    $.ajax({
        url: $(form).prop('action'),
        method: 'GET',
        data: {
            query: $(form).find('input[name=query]').val(),
            match: $(form).find('input[name=match]:checked').val(),
            field: $(form).find('input[name=field]:checked').val(),
            from: $(form).find('input[name=from]').val(),
            to: $(form).find('input[name=to]').val()
        },
        success: function(response) {
            if (response['flash_message']) {
                message(response['flash_message'], response['flash_level_key'], 2000);
                // console.log(response['flash_message']);
            } else {
                $('.advanced-search-render-html').html(response['renderHtml']);
            }
        },
        complete: function() {
            $(form).find('input[type=submit]').prop('disabled', false);
            $('#flash-overlay').hide();
        },
        error: function(xhr, ajaxOption, thrownerror) {
            message('Có lỗi xảy ra', 'warning', 2000);
            // location.reload();
        }
    });

    return false;
});
