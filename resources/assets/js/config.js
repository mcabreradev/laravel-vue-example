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
window.panal = {};

/**
 * Definicion de lenguajes y traducciones
 */
panal.lang = {

  'datatable': {
    'sProcessing': 'Procesando...',
    'sLengthMenu': 'Mostrar _MENU_ registros',
    'sZeroRecords': 'No se encontraron resultados',
    'sEmptyTable': 'Ningún dato disponible en esta tabla',
    'sInfo': 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
    'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
    'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
    'sInfoPostFix': '',
    'sSearch': 'Buscar:',
    'sUrl': '',
    'sInfoThousands': ',',
    'sLoadingRecords': 'Cargando...',
    'oPaginate': {
      'sFirst': 'Primero',
      'sLast': 'Último',
      'sNext': 'Siguiente',
      'sPrevious': 'Anterior'
    },
    'oAria': {
      'sSortAscending': ': Activar para ordenar la columna de manera ascendente',
      'sSortDescending': ': Activar para ordenar la columna de manera descendente'
    }
  },

  'button': {
    'create': 'Agregar',
    'store': 'Guardar',
    'edit': 'Editar',
    'update': 'Editar',
    'cancel' : 'Cancelar'
  }

}
