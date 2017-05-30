
// $(window).on('hashchange', function() {
//     if (window.location.hash) {
//         var page = window.location.hash.replace('#', '');
//         if (page == Number.NaN || page <= 0) {
//             return false;
//         } else {
//             getLaws(page);
//         }
//     }
// });

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
        // window.location = url;
        $('.home-content').html(response['renderHtml']);
    }).fail(function () {
        message('Có lỗi xảy ra, không thể trả về kết quả', 'error', 2000);
    });
}
$('#normal-search-form').submit(function() {
    var form = this;
    $(form).find('input[type=submit]').prop('disabled', true);
    $('#flash-overlay').css('display', 'block');
    $.ajax({
        url: $(form).prop('action'),
        method: 'GET',
        data: {
            query: $(form).find('input[name=query]').val()
        },
        success: function(response) {
            if (response['flash_message']) {
                message(response['flash_message'], response['flash_level_key'], 2000);
            } else {
                $('.home-content').html(response['renderHtml']);
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
