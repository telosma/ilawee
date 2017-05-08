var requestRunning = false;
$('#comments-form').on('click', '.comment-actions #btn-cancel-comment', function () {
    $('#comments-form')[0].reset();
});
$('#comments-form').submit(function() {
    var form = this;
    if ($(form).find('textarea[name=content]').val().trim() == '') {
        return false;
    }

    $(form).find('input[type=submit]').prop('disabled', true);
    $.ajax({
        url: $(form).prop('action'),
        method: 'POST',
        data: {
            userId: $(form).find('input[name=userId]').val(),
            postId: $(form).find('input[name=postId]').val(),
            content: $(form).find('textarea[name=content]').val()
        },
        success: function(msg) {
            if (msg['status']) {
                $('#comments').append(msg['commentRender']);
                $(form)[0].reset();
            } else {
                message(msg['message'], 'warning', 2000);
            }
        },
        complete: function() {
            $(form).find('input[type=submit]').prop('disabled', false);
        },
        error: function(xhr, ajaxOption, thrownerror) {
            // location.reload();
            message('Đã có lỗi xảy ra', 'error', 2000);
        }
    });

    return false;
});

// Delete
$('#comments').on('click', '.comment-origin a[data-original-title=Delete]', function($e) {
    $e.preventDefault();

    if (requestRunning) {
        return;
    }

    var del = this;
    requestRunning = true;
    var c = confirm('Xóa bình luận?');
    var commentId = $(del).closest('div[class=comment-origin]').data('id');

    if (c) {
        $.ajax({
            url: $(del).data('actionDelete'),
            method: 'POST',
            data: {
                _method: 'DELETE',
                commentId: commentId
            },
            success: function(msg) {
                if (msg['status']) {
                    $('#comment-' + commentId).remove();
                }
            },
            complete: function(data) {
                requestRunning = false;
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                // location.reload();
                message('Lỗi', 'error', 2000);
            }
        });
    }

    requestRunning = false;
});
