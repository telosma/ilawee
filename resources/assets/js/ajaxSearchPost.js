// $(window).on('hashchange', function() {
//     if (window.location.hash) {
//         var page = window.location.hash.replace('#', '');
//         if (page == Number.NaN || page <= 0) {
//             return false;
//         } else {
//             getPosts(page);
//         }
//     }
// });

$(document).ready(function() {
    $(document).on('click', '.pagination li a', function (e) {
        getPosts($(this).attr('href'));
        e.preventDefault();
    });
});

function getPosts(url) {
    $.ajax({
        url : url,
        dataType: 'json',
    }).done(function (response) {
        $('.box-posts').html(response['postIndexRender']);
        window.history.pushState({}, "Title", "/cau-hoi-phap-luat/search?query=" + response['query'] + '&page=' + response['page']);
    }).fail(function () {
        alert('Không thể load theme câu hỏi');
    });
}

$('#form-posts-search').submit(function() {
    var form = this;
    $(form).find('input[type=submit]').prop('disabled', true);
    // $('#flash-overlay').css('display', 'block');
    var query = $(form).find('input[name=query]').val();
    $.ajax({
        url: $(form).prop('action'),
        method: 'GET',
        data: {
            query: query
        },
        success: function(response) {
            $('.box-posts').html(response['postIndexRender']);
            window.history.pushState({query: query}, "Title", "/cau-hoi-phap-luat/search?query=" + response['query'] + '&page=' + response['page']);
        },
        complete: function() {
            $(form).find('input[type=submit]').prop('disabled', false);
        },
        error: function(xhr, ajaxOption, thrownerror) {
            message('Lỗi tìm kiếm', 'error', 2000);
        }
    });

    return false;
});
