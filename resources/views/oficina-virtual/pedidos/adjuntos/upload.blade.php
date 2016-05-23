<form method="POST" action="{{ route('pedidos.adjuntos.store') }}" class="dropzone" enctype="multipart/form-data">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input type="hidden" name="pedido" value="{{ $pedido->id }}">

    <div class="fallback">
        <input name="file" type="file" multiple />
    </div>

    <div class="dz-message">
        Arrastrá los archivos que querés subir<br>
        <span class="note">(o podés hacer click y buscarlos)</span>
    </div>

</form>

@section('body-scripts')
    @parent

    <!-- dropzone -->
    <link rel="stylesheet" type="text/css" href="{{ asset('compiled/js/dropzone/dropzone.min.css') }}">
    <script src="{{ asset('compiled/js/dropzone/dropzone.min.js') }}"></script>

    <script>
        ;(function(Dropzone, $){
            'use strict'
            
            // Disabling autoDiscover, otherwise Dropzone will try to attach twice.
            Dropzone.autoDiscover = false;
        
            new Dropzone("form.dropzone", {
                acceptedFiles: 'application/pdf',
                dictInvalidFileType: 'Sólo podés subir archivos PDF'
            });

        })(window.Dropzone, window.jquery);
    </script>
@endsection
