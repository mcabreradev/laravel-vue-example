(function(name, definition) {
    if (typeof module != 'undefined') {
      module.exports = definition();
    } else if (typeof define == 'function' && typeof define.amd == 'object') {
      define(definition);
    } else {
      this[name] = definition();
    }
  }('Router', function() {
  return {
    routes: [{"uri":"login","name":"auth::login.form"},{"uri":"login","name":"auth::login"},{"uri":"logout","name":"auth::logout"},{"uri":"\/","name":"home"},{"uri":"users\/profile","name":"users.profile.form"},{"uri":"users\/profile","name":"users.profile"},{"uri":"pedidos\/create","name":"pedidos.create"},{"uri":"pedidos\/edit\/{id}","name":"pedidos.edit"},{"uri":"pedidos\/{id}","name":"pedidos.update"},{"uri":"pedidos\/{id}","name":"pedidos.destroy"},{"uri":"pedidos\/{id}\/enviar-email","name":"pedidos.enviar.email"},{"uri":"pedidos","name":"pedidos.store"},{"uri":"pedidos\/{estado?}","name":"pedidos.index"},{"uri":"pedidos-adjuntos","name":"pedidos.adjuntos.store"},{"uri":"pedidos-adjuntos\/{id}","name":"pedidos.adjuntos.destroy"},{"uri":"alertas\/niveles-agua","name":"alertas::niveles-agua.index"},{"uri":"alertas\/niveles-agua","name":"alertas::niveles-agua.store"},{"uri":"alertas\/niveles-agua\/{id}","name":"alertas::niveles-agua.destroy"},{"uri":"alertas\/registros-nivel-agua","name":"alertas::registros-nivel-agua.index"},{"uri":"alertas\/registros-nivel-agua","name":"alertas::registros-nivel-agua.store"},{"uri":"alertas\/registros-nivel-agua\/{id}","name":"alertas::registros-nivel-agua.destroy"},{"uri":"alertas","name":"alertas::index"},{"uri":"alertas\/create","name":"alertas::create"},{"uri":"alertas\/create\/layer","name":"alertas::create.layer"},{"uri":"alertas","name":"alertas::store"},{"uri":"alertas\/edit\/{id}","name":"alertas::edit"},{"uri":"alertas\/edit\/{id}\/layer","name":"alertas::edit.layer"},{"uri":"alertas\/{id}","name":"alertas::destroy"},{"uri":"alertas\/estados","name":"alertas::estados.index"},{"uri":"alertas\/estados","name":"alertas::estados.store"},{"uri":"alertas\/estados\/{id}","name":"alertas::estados.destroy"},{"uri":"turnos","name":"turnos::index"},{"uri":"turnos\/asignados\/{actividadId}","name":"turnos::asignados-por-actividad"},{"uri":"turnos\/vencidos\/{actividadId}","name":"turnos::vencidos-por-actividad"},{"uri":"turnos\/validar-atencion\/{id}","name":"turnos::validar-atencion"},{"uri":"turnos\/{id}","name":"turnos::destroy"},{"uri":"solicitudes\/estados","name":"solicitudes::estados"},{"uri":"solicitudes\/estados\/create","name":"solicitudes::estados.create"},{"uri":"solicitudes\/estados\/edit\/{id}","name":"solicitudes::estados.edit"},{"uri":"solicitudes\/origenes","name":"solicitudes::origenes"},{"uri":"solicitudes\/origenes\/create","name":"solicitudes::origenes.create"},{"uri":"solicitudes\/origenes\/edit\/{id}","name":"solicitudes::origenes.edit"},{"uri":"solicitudes\/prioridades","name":"solicitudes::prioridades"},{"uri":"solicitudes\/prioridades\/create","name":"solicitudes::prioridades.create"},{"uri":"solicitudes\/prioridades\/edit\/{id}","name":"solicitudes::prioridades.edit"},{"uri":"solicitudes\/tipos","name":"solicitudes::tipos"},{"uri":"solicitudes\/tipos\/create","name":"solicitudes::tipos.create"},{"uri":"solicitudes\/tipos\/edit\/{id}","name":"solicitudes::tipos.edit"},{"uri":"solicitudes\/solicitantes","name":"solicitudes::solicitantes"},{"uri":"solicitudes\/solicitantes\/create","name":"solicitudes::solicitantes.create"},{"uri":"solicitudes\/solicitantes\/edit\/{id}","name":"solicitudes::solicitantes.edit"},{"uri":"solicitudes\/solicitantes","name":"solicitudes::solicitantes.store"},{"uri":"solicitudes\/solicitantes\/{id}","name":"solicitudes::solicitantes.update"},{"uri":"solicitudes\/solicitantes\/{id}","name":"solicitudes::solicitantes.destroy"},{"uri":"solicitudes\/solicitudes","name":"solicitudes::solicitudes"},{"uri":"solicitudes\/solicitudes\/create","name":"solicitudes::solicitudes.create"},{"uri":"solicitudes\/solicitudes\/edit\/{id}","name":"solicitudes::solicitudes.edit"},{"uri":"solicitudes\/solicitudes","name":"solicitudes::solicitudes.store"},{"uri":"solicitudes\/solicitudes\/{id}","name":"solicitudes::solicitudes.update"},{"uri":"solicitudes\/solicitudes\/{id}","name":"solicitudes::solicitudes.destroy"},{"uri":"api\/v1\/newsletter\/registrarse","name":"api::v1::"},{"uri":"api\/v1\/alertas\/nivel-agua","name":"api::v1::alertas::nivel.agua"},{"uri":"api\/v1\/alertas\/gacetillas","name":"api::v1::alertas::gacetillas"},{"uri":"api\/v1\/alertas\/estado-servicio","name":"api::v1::alertas::estado-servicio"},{"uri":"api\/v1\/alertas\/hoy\/layer","name":"api::v1::alertas::hoy.layer"},{"uri":"api\/v1\/alertas\/vigentes\/layer","name":"api::v1::alertas::vigentes.layer"},{"uri":"api\/v1\/alertas\/futuras\/layer","name":"api::v1::alertas::futuras.layer"},{"uri":"api\/v1\/oficina-virtual\/libre-deuda","name":"api::v1::oficicina-virtual::pedidos.solicitar.libre-deuda"},{"uri":"api\/v1\/oficina-virtual\/facturas-vencidas","name":"api::v1::oficicina-virtual::pedidos.solicitar.facturas-vencidas"},{"uri":"api\/v1\/oficina-virtual\/boletas-pago","name":"api::v1::oficicina-virtual::boletas-pago.generar"},{"uri":"api\/v1\/turnos","name":"api::v1::turnos::store"},{"uri":"api\/v1\/turnos\/actividades\/{id}","name":"api::v1::turnos::actividades.show"},{"uri":"api\/v1\/turnos\/actividades\/{id}\/turnos-asignados","name":"api::v1::turnos::actividades.turnos-asignados"},{"uri":"api\/v2\/solicitudes\/estados","name":"api.v2.solicitudes.estados.index"},{"uri":"api\/v2\/solicitudes\/estados\/create","name":"api.v2.solicitudes.estados.create"},{"uri":"api\/v2\/solicitudes\/estados","name":"api.v2.solicitudes.estados.store"},{"uri":"api\/v2\/solicitudes\/estados\/{estados}","name":"api.v2.solicitudes.estados.show"},{"uri":"api\/v2\/solicitudes\/estados\/{estados}\/edit","name":"api.v2.solicitudes.estados.edit"},{"uri":"api\/v2\/solicitudes\/estados\/{estados}","name":"api.v2.solicitudes.estados.update"},{"uri":"api\/v2\/solicitudes\/estados\/{estados}","name":"api.v2.solicitudes.estados.destroy"},{"uri":"api\/v2\/solicitudes\/origenes","name":"api.v2.solicitudes.origenes.index"},{"uri":"api\/v2\/solicitudes\/origenes\/create","name":"api.v2.solicitudes.origenes.create"},{"uri":"api\/v2\/solicitudes\/origenes","name":"api.v2.solicitudes.origenes.store"},{"uri":"api\/v2\/solicitudes\/origenes\/{origenes}","name":"api.v2.solicitudes.origenes.show"},{"uri":"api\/v2\/solicitudes\/origenes\/{origenes}\/edit","name":"api.v2.solicitudes.origenes.edit"},{"uri":"api\/v2\/solicitudes\/origenes\/{origenes}","name":"api.v2.solicitudes.origenes.update"},{"uri":"api\/v2\/solicitudes\/origenes\/{origenes}","name":"api.v2.solicitudes.origenes.destroy"},{"uri":"api\/v2\/solicitudes\/prioridades","name":"api.v2.solicitudes.prioridades.index"},{"uri":"api\/v2\/solicitudes\/prioridades\/create","name":"api.v2.solicitudes.prioridades.create"},{"uri":"api\/v2\/solicitudes\/prioridades","name":"api.v2.solicitudes.prioridades.store"},{"uri":"api\/v2\/solicitudes\/prioridades\/{prioridades}","name":"api.v2.solicitudes.prioridades.show"},{"uri":"api\/v2\/solicitudes\/prioridades\/{prioridades}\/edit","name":"api.v2.solicitudes.prioridades.edit"},{"uri":"api\/v2\/solicitudes\/prioridades\/{prioridades}","name":"api.v2.solicitudes.prioridades.update"},{"uri":"api\/v2\/solicitudes\/prioridades\/{prioridades}","name":"api.v2.solicitudes.prioridades.destroy"},{"uri":"api\/v2\/solicitudes\/tipos","name":"api.v2.solicitudes.tipos.index"},{"uri":"api\/v2\/solicitudes\/tipos\/create","name":"api.v2.solicitudes.tipos.create"},{"uri":"api\/v2\/solicitudes\/tipos","name":"api.v2.solicitudes.tipos.store"},{"uri":"api\/v2\/solicitudes\/tipos\/{tipos}","name":"api.v2.solicitudes.tipos.show"},{"uri":"api\/v2\/solicitudes\/tipos\/{tipos}\/edit","name":"api.v2.solicitudes.tipos.edit"},{"uri":"api\/v2\/solicitudes\/tipos\/{tipos}","name":"api.v2.solicitudes.tipos.update"},{"uri":"api\/v2\/solicitudes\/tipos\/{tipos}","name":"api.v2.solicitudes.tipos.destroy"},{"uri":"api\/v2\/solicitudes\/solicitantes","name":"api.v2.solicitudes.solicitantes.index"},{"uri":"api\/v2\/solicitudes\/solicitantes\/create","name":"api.v2.solicitudes.solicitantes.create"},{"uri":"api\/v2\/solicitudes\/solicitantes","name":"api.v2.solicitudes.solicitantes.store"},{"uri":"api\/v2\/solicitudes\/solicitantes\/{solicitantes}","name":"api.v2.solicitudes.solicitantes.show"},{"uri":"api\/v2\/solicitudes\/solicitantes\/{solicitantes}\/edit","name":"api.v2.solicitudes.solicitantes.edit"},{"uri":"api\/v2\/solicitudes\/solicitantes\/{solicitantes}","name":"api.v2.solicitudes.solicitantes.update"},{"uri":"api\/v2\/solicitudes\/solicitantes\/{solicitantes}","name":"api.v2.solicitudes.solicitantes.destroy"},{"uri":"api\/v2\/solicitudes\/solicitudes","name":"api.v2.solicitudes.solicitudes.index"},{"uri":"api\/v2\/solicitudes\/solicitudes\/create","name":"api.v2.solicitudes.solicitudes.create"},{"uri":"api\/v2\/solicitudes\/solicitudes","name":"api.v2.solicitudes.solicitudes.store"},{"uri":"api\/v2\/solicitudes\/solicitudes\/{solicitudes}","name":"api.v2.solicitudes.solicitudes.show"},{"uri":"api\/v2\/solicitudes\/solicitudes\/{solicitudes}\/edit","name":"api.v2.solicitudes.solicitudes.edit"},{"uri":"api\/v2\/solicitudes\/solicitudes\/{solicitudes}","name":"api.v2.solicitudes.solicitudes.update"},{"uri":"api\/v2\/solicitudes\/solicitudes\/{solicitudes}","name":"api.v2.solicitudes.solicitudes.destroy"},{"uri":"_debugbar\/open","name":"debugbar.openhandler"},{"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork"},{"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css"},{"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js"}],
    route: function(name, params) {
      var route = this.searchRoute(name),
          rootUrl = this.getRootUrl(),
          result = "",
          compiled = "";

      if (route) {
        compiled = this.buildParams(route, params);
        result = this.cleanupDoubleSlashes(rootUrl + '/' + compiled);
        result = this.stripTrailingSlash(result);
        return result;
      }

    },
    searchRoute: function(name) {
      for (var i = this.routes.length - 1; i >= 0; i--) {
        if (this.routes[i].name == name) {
          return this.routes[i];
        }
      }
    },
    buildParams: function(route, params) {
      var compiled = route.uri,
          queryParams = {};

      for (var key in params) {
        if (compiled.indexOf('{' + key + '?}') != -1) {
          if (key in params) {
            compiled = compiled.replace('{' + key + '?}', params[key]);
          }
        } else if (compiled.indexOf('{' + key + '}') != -1) {
          compiled = compiled.replace('{' + key + '}', params[key]);
        } else {
          queryParams[key] = params[key];
        }
      }

      compiled = compiled.replace(/\{([^\/]*)\?}/g, "");

      if (!this.isEmptyObject(queryParams)) {
        return compiled + this.buildQueryString(queryParams);
      }

      return compiled;
    },
    getRootUrl: function() {
      return window.location.protocol + '//' + window.location.host;
    },
    buildQueryString: function(params) {
      var ret = [];
      for (var key in params) {
        ret.push(encodeURIComponent(key) + "=" + encodeURIComponent(params[key]));
      }
      return '?' + ret.join("&");
    },
    isEmptyObject: function(obj) {
      var name;
      for (name in obj) {
        return false;
      }
      return true;
    },
    cleanupDoubleSlashes: function(url) {
      return url.replace(/([^:]\/)\/+/g, "$1");
    },
    stripTrailingSlash: function(url) {
      if(url.substr(-1) == '/') {
        return url.substr(0, url.length - 1);
      }
      return url;
    }
  };
}));