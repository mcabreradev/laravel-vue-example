<div class="row">
  <div class="col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <h1>Adjuntos del pedido</h1>
      </div>

      <div class="box-body">
        <ul id="pedido-adjuntos">
          @foreach($pedido->adjuntos as $adjunto)
          <li>
            <a href="{{ url('storage') }}/{{ $adjunto->path }}" target="_blank">
              <span class="fa fa-file-pdf-o fa-lg text-danger"></span> {{ $adjunto->titulo }}
            </a>
            -
            <a class="eliminar-adjunto" href="#" title="Eliminar adjunto" data-adjunto="{{ $adjunto->id }}"><span class="fa fa-trash text-danger"></span></a>
          </li>
          @endforeach
        </ul>
      </div>

      <div class="box-footer">
        <h3>Adjuntar archivos</h3>
        @include('oficina-virtual.pedidos.adjuntos.upload')
      </div>
    </div> <!-- .box -->

  </div>
</div>

@section('body-scripts')
@parent
<script>
  ;(function($, swal, adjuntos) {
    'use strict'

    function elminiarAdjunto($elem) {
      swal({
        title: "¡Cuidado!",
        text: "¿Querés de eliminar el adjunto?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'No, me equivoqué',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si ¡eliminalo!",
        showLoaderOnConfirm: true,
        closeOnConfirm: false
      }, function() {
        var token = '{{ csrf_token() }}';

        $.ajax({
         url: '{{ route('pedidos.adjuntos.destroy', '') }}/' + $elem.data('adjunto'),
         method: 'DELETE',
         data: {
          _token: token
        }
      }).done(function() {
        $elem.parent().remove()
        swal("¡Eliminado!", "El adjunto se elimnó correctamente.", "success");
      }).
      fail(function(){
        swal("Algo salió mal", "No se pudo eliminar el adjunto", "error");
      });
    });
    }

    $('#pedido-adjuntos').on('click', '.eliminar-adjunto', function(event){
      event.preventDefault();
      elminiarAdjunto($(this));
    });
  })(window.jQuery, window.swal);
</script>
@endsection
