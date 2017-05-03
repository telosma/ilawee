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
        $('.advanced-search-render-html').html(response['renderHtml']);
        location.hash = page;
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
}
$('#advanced-search-form').submit(function() {
    var form = this;
    $(form).find('input[type=submit]').prop('disabled', true);
    $.ajax({
        url: $(form).prop('action'),
        method: 'GET',
        data: {
            query: $(form).find('input[name=query]').val(),
            match: $(form).find('input[name=match]:checked').val(),
            field: $(form).find('input[name=field]:checked').val(),
            from: $(form).find('input[name=date_from]').val(),
            to: $(form).find('input[name=date_to]').val()
        },
        success: function(response) {
            $('.advanced-search-render-html').html(response['renderHtml']);
        },
        complete: function() {
            $(form).find('input[type=submit]').prop('disabled', false);
        },
        error: function(xhr, ajaxOption, thrownerror) {
            location.reload();
        }
    });

    return false;
});
