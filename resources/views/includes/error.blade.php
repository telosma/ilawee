@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger fade in alert-dismissable clearfix" style="align: center; width: 500px; margin: 10px auto;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> {{ $error }}
        </div>
    @endforeach
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);
    </script>
@endif
