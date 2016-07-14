<div class="table-responsive">
  <table class="table">
    <thead>
      <th>Creado el</th>
      <th>Código</th>
      <th>Tipo</th>
      <th>Origen</th>
      <th>Titular</th>
      <th>Forma de entrega</th>
      <th>Acciones</th>
    </thead>
    <tbody id="pedidos-table-body">
      @foreach($pedidos as $pedido)
      <tr class="{{ ($pedido->prioritario ? 'danger' : '') }}">
        <td>{{ date('d/m/Y H:i:s', strtotime($pedido->created_at)) }}</td>
        <td>{{ $pedido->id }}</td>
        <td>{{ $pedido->getTipoMostrable() }}</td>
        <td>{{ $pedido->getOrigenMostrable() }}</td>
        <td>{{ $pedido->usuario->getNombreCompleto() }}</td>
        <td>{{ $pedido->getMetodoEntregaMostrable() }}</td>
        <td>

          <div class='btn-group'>
            <form method="POST" action="{{ route('pedidos.destroy', $pedido->id) }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="DELETE">

              <a href="{{ route('pedidos.edit', ['id' => $pedido->id]) }}" class='btn btn-success btn-sm' title="Editar">
                <span class="fa fa-pencil"></span>
              </a>

              @if( in_array($pedido->estado, ['generado', 'entregado']) )
              <a href="#" class='btn btn-primary btn-sm' title="Enviar por email">
                <span class="fa fa-paper-plane"></span>
              </a>
              @endif

              @if($pedido->estado !== 'cancelado')
              <button class="btn btn-danger btn-sm" type="submit" title="Cancelar">
                <span class="fa fa-times"></span>
              </button>

              <input type="hidden" name="motivo_cancelacion" />
              @endif
            </form>
          </div>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@section('body-scripts')
@parent

<script>
  ;(function($, swal){
    'use strict'

    // cancelar pedido
    $('#pedidos-table-body').on('submit', 'form', function(event){
      event.preventDefault();

      var $motivo = $($(this).children('input[name=motivo_cancelacion]')[0]);
      var target  = event.target;

      swal({
        title: "¿Querés cancelar el pedido?",
        text: "Ingresá el motivo:",
        type: "input",
        showCancelButton: true,
        cancelButtonText: 'Me equivoqué',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Cancelar el pedido',
        closeOnConfirm: false
      },
      function(inputValue) {
        if (inputValue === false) {
          return false;
        } else if (inputValue === "") {
          swal.showInputError("Tenés que ingresar un motivo");
          return false;
        } else {
          $motivo.val(inputValue);
          target.submit();
        }
      });
    });
  })(window.jQuery, window.swal);
</script>
@endsection
