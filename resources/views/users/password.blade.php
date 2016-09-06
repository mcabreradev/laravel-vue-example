<div class="panel panel-default">
    <div class="panel-heading">Tu contraseña</div>
    <div class="panel-body">

        <!-- change-password -->
        <div class="form-group col-xs-12">
            <!-- if not checked this value is submitted -->
            <input type="hidden" name="change-password" value="0">
            
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="change-password" name="change-password" value="1"> Cambiar contraseña
                </label>
            </div>
        </div>

        <!-- password Field -->
        <div class="form-group col-xs-12">
            <label for="password">Nueva contraseña</label>
            <input class="form-control password" type="password" id="password" name="password" disabled>
        </div>

        <!-- confirm-password Field -->
        <div class="form-group col-xs-12">
            <label for="confirm-password">Confirmar nueva contraseña</label>
            <input class="form-control password" type="password" id="confirm-password" name="confirm-password" disabled>
        </div>
    </div>
</div>

@section('body-scripts')
    <script>
        ;(function($){
            $('#change-password').on('click', function(){
                if (this.checked) {
                    $('.password').removeAttr('disabled');
                } else {
                    $('.password').attr('disabled', 'disabled');
                }
            });
        })(window.jQuery);
    </script>
@endsection