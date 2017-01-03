/**
 * Define el endpoint
 */
window.API = 'api.v2';

/**
 * Mostrar Errores y Warings
 */
Vue.config.silent = false;

/**
 * Para hacer mas facil y comoda la redireccion
 */
window.Redirect = function (url) {
  if (!url) {
    return;
  }
  window.location.replace(url);
};

/**
 * Declaracion de variable objeto para listas configuraciones
 */
window.PanalConf = {};

/**
 * Definicion del prefijo de API
 */
PanalConf.api = 'api.v2';

/**
 * Definicion de lenguajes y traducciones
 */
PanalConf.lang         = {

  'datatable':           {
    'sProcessing':       'Procesando...',
    'sLengthMenu':       'Mostrar _MENU_ items',
    'sZeroRecords':      'No se encontraron resultados',
    'sEmptyTable':       'Ningún dato disponible en esta tabla',
    'sInfo':             'Mostrando items del _START_ al _END_ de un total de _TOTAL_ items',
    'sInfoEmpty':        'Mostrando items del 0 al 0 de un total de 0 items',
    'sInfoFiltered':     '(filtrado de un total de _MAX_ items)',
    'sInfoPostFix':      '',
    'sSearch':           'Buscar:',
    'sUrl':              '',
    'sInfoThousands':    ',',
    'sLoadingRecords':   'Cargando...',
    'oPaginate':         {
      'sFirst':          'Primero',
      'sLast':           'Último',
      'sNext':           'Siguiente',
      'sPrevious':       'Anterior'
    },
    'oAria':             {
      'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
      'sSortDescending': ': Activar para ordenar la columna de manera descendente'
    }
  },

  'button':              {
    'create':            'Nuevo',
    'store':             'Guardar',
    'edit':              'Editar',
    'update':            'Editar',
    'cancel':            'Cancelar'
  }

}
