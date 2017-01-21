/**
 * Shortcut for !_.isUndefined
 *
 * @param {mixed} e Item to be tested
 * @return {boolean}
 */
_.mixin({
  'isDefined': function (e) {
    return !_.isUndefined(e);
  }
});

/**
 * MaybeNull
 * devuelve la ejecucion de operador ternario
 *
 * var nombre = 'Panal'
 * _.maybeNull(nombre);
 * -> Panal
 *
 * @param  {String|Int|Array|Object} variable a estudiar
 */
_.mixin({
  'maybeNull': function (e) {
    return _.isNull(e) ? null : e;
  }
});

/**
 * Devuelve en una collection a traves de una key y sus diferentes valores
 *
 * _.findByValues(Object, "id", [1,3,4]);
 *
 * @param
 * @return
 */
_.mixin({
  'findByValues': function (collection, property, values) {
    return _.filter(collection, function (item) {
      return _.contains(values, item[property]);
    });
  }
});


/**
 *	Busca en un Collections mediante la condicion dada en objetos
 *
 * _.findByFilters(collections, {'nombre': 'pedro', 'edad':10, 'activo':true});
 *
 * @param  {[type]} {
 * @return {[type]}   [description]
 */
_.mixin({
  'findByFilters': function (data, filters) {
    // si no hay filtros, devuelve la data en crudo sin filtrar
    if (Object.keys(filters).length < 1) {
      return data;
    }

    // crea un array con objetos
    var filtered = [filters];

    var result = _.flatten(_.map(filtered, function (filter) {
      return _.where(data, filter);
    }));

    return result;
  }
});
