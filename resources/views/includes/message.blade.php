@if ((!empty(config('common.flash_message'))) && (!empty(config('common.flash_level_key'))))
    <div class="flash-notification flash-notification-{!! Session::get(config('common.flash_level_key')) !!}">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get(config('common.flash_message')) !!}
    </div>
    <script>
        function close2() {
          $('.flash-notification').fadeOut('slow');
        }
        window.setTimeout(function() {
            $('.flash-notification').slideDown('slow');
            window.setTimeout(close2, 5000);
        }, 1000);
    </script>
@endif
