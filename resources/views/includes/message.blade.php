@if (Session::has(config('common.flash_message'), config('common.flash_level_key')))
    <div class="notification notification-{!! Session::get(config('common.flash_level_key')) !!}">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get(config('common.flash_message')) !!}
    </div>
    <script>
        function close2() {
          $('.notification').fadeOut('slow');
        }
        window.setTimeout(function() {
            $('.notification').slideDown('slow');
            window.setTimeout(close2, 5000);
        }, 1000);
    </script>
@endif
