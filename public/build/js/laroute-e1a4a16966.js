(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"auth::login.form","action":"App\Http\Controllers\Auth\AuthController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":"auth::login","action":"App\Http\Controllers\Auth\AuthController@login"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"auth::logout","action":"App\Http\Controllers\Auth\AuthController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/profile","name":"users.profile.form","action":"App\Http\Controllers\Admin\UserController@profile"},{"host":null,"methods":["PUT"],"uri":"users\/profile","name":"users.profile","action":"App\Http\Controllers\Admin\UserController@saveProfile"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/permisos","name":"admin::permissions","action":"App\Http\Controllers\Admin\PermissionController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/permisos\/list","name":"admin::permissions.list","action":"App\Http\Controllers\Admin\PermissionController@main"},{"host":null,"methods":["POST"],"uri":"admin\/permisos","name":"admin::permissions.store","action":"App\Http\Controllers\Admin\PermissionController@store"},{"host":null,"methods":["PUT"],"uri":"admin\/permisos\/{id}","name":"admin::permissions.update","action":"App\Http\Controllers\Admin\PermissionController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/permisos\/{id}","name":"admin::permissions.destroy","action":"App\Http\Controllers\Admin\PermissionController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/roles","name":"admin::roles","action":"App\Http\Controllers\Admin\RoleController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/roles\/list","name":"admin::roles.list","action":"App\Http\Controllers\Admin\RoleController@main"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/roles\/create","name":"admin::roles.create","action":"App\Http\Controllers\Admin\RoleController@create"},{"host":null,"methods":["POST"],"uri":"admin\/roles","name":"admin::roles.store","action":"App\Http\Controllers\Admin\RoleController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/roles\/edit\/{id}","name":"admin::roles.edit","action":"App\Http\Controllers\Admin\RoleController@edit"},{"host":null,"methods":["PUT"],"uri":"admin\/roles\/{id}","name":"admin::roles.update","action":"App\Http\Controllers\Admin\RoleController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/roles\/{id}","name":"admin::roles.destroy","action":"App\Http\Controllers\Admin\RoleController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"pedidos\/create","name":"pedidos.create","action":"App\Http\Controllers\OficinaVirtual\PedidoController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"pedidos\/edit\/{id}","name":"pedidos.edit","action":"App\Http\Controllers\OficinaVirtual\PedidoController@edit"},{"host":null,"methods":["PUT"],"uri":"pedidos\/{id}","name":"pedidos.update","action":"App\Http\Controllers\OficinaVirtual\PedidoController@update"},{"host":null,"methods":["DELETE"],"uri":"pedidos\/{id}","name":"pedidos.destroy","action":"App\Http\Controllers\OficinaVirtual\PedidoController@destroy"},{"host":null,"methods":["DELETE"],"uri":"pedidos\/{id}\/enviar-email","name":"pedidos.enviar.email","action":"App\Http\Controllers\OficinaVirtual\PedidoController@enviarEmail"},{"host":null,"methods":["POST"],"uri":"pedidos","name":"pedidos.store","action":"App\Http\Controllers\OficinaVirtual\PedidoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"pedidos\/{estado?}","name":"pedidos.index","action":"App\Http\Controllers\OficinaVirtual\PedidoController@index"},{"host":null,"methods":["POST"],"uri":"pedidos-adjuntos","name":"pedidos.adjuntos.store","action":"App\Http\Controllers\OficinaVirtual\PedidoAdjuntoController@store"},{"host":null,"methods":["DELETE"],"uri":"pedidos-adjuntos\/{id}","name":"pedidos.adjuntos.destroy","action":"App\Http\Controllers\OficinaVirtual\PedidoAdjuntoController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"alertas\/niveles-agua","name":"alertas::niveles-agua.index","action":"App\Http\Controllers\Alertas\NivelAguaController@index"},{"host":null,"methods":["POST"],"uri":"alertas\/niveles-agua","name":"alertas::niveles-agua.store","action":"App\Http\Controllers\Alertas\NivelAguaController@store"},{"host":null,"methods":["DELETE"],"uri":"alertas\/niveles-agua\/{id}","name":"alertas::niveles-agua.destroy","action":"App\Http\Controllers\Alertas\NivelAguaController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"alertas\/registros-nivel-agua","name":"alertas::registros-nivel-agua.index","action":"App\Http\Controllers\Alertas\NivelAguaRegistroController@index"},{"host":null,"methods":["POST"],"uri":"alertas\/registros-nivel-agua","name":"alertas::registros-nivel-agua.store","action":"App\Http\Controllers\Alertas\NivelAguaRegistroController@store"},{"host":null,"methods":["DELETE"],"uri":"alertas\/registros-nivel-agua\/{id}","name":"alertas::registros-nivel-agua.destroy","action":"App\Http\Controllers\Alertas\NivelAguaRegistroController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"alertas","name":"alertas::index","action":"App\Http\Controllers\Alertas\AlertaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"alertas\/create","name":"alertas::create","action":"App\Http\Controllers\Alertas\AlertaController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"alertas\/create\/layer","name":"alertas::create.layer","action":"App\Http\Controllers\Alertas\AlertaController@createLayer"},{"host":null,"methods":["POST"],"uri":"alertas","name":"alertas::store","action":"App\Http\Controllers\Alertas\AlertaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"alertas\/edit\/{id}","name":"alertas::edit","action":"App\Http\Controllers\Alertas\AlertaController@edit"},{"host":null,"methods":["GET","HEAD"],"uri":"alertas\/edit\/{id}\/layer","name":"alertas::edit.layer","action":"App\Http\Controllers\Alertas\AlertaController@editLayer"},{"host":null,"methods":["DELETE"],"uri":"alertas\/{id}","name":"alertas::destroy","action":"App\Http\Controllers\Alertas\AlertaController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"alertas\/estados","name":"alertas::estados.index","action":"App\Http\Controllers\Alertas\EstadoController@index"},{"host":null,"methods":["POST"],"uri":"alertas\/estados","name":"alertas::estados.store","action":"App\Http\Controllers\Alertas\EstadoController@store"},{"host":null,"methods":["DELETE"],"uri":"alertas\/estados\/{id}","name":"alertas::estados.destroy","action":"App\Http\Controllers\Alertas\EstadoController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"turnos","name":"turnos::index","action":"App\Http\Controllers\Turnos\TurnoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"turnos\/asignados\/{actividadId}","name":"turnos::asignados-por-actividad","action":"App\Http\Controllers\Turnos\TurnoController@asignadosPorActividad"},{"host":null,"methods":["GET","HEAD"],"uri":"turnos\/vencidos\/{actividadId}","name":"turnos::vencidos-por-actividad","action":"App\Http\Controllers\Turnos\TurnoController@vencidosPorActividad"},{"host":null,"methods":["PUT"],"uri":"turnos\/validar-atencion\/{id}","name":"turnos::validar-atencion","action":"App\Http\Controllers\Turnos\TurnoController@validarAtencion"},{"host":null,"methods":["DELETE"],"uri":"turnos\/{id}","name":"turnos::destroy","action":"App\Http\Controllers\Turnos\TurnoController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/estados","name":"solicitudes::estados","action":"App\Http\Controllers\Solicitudes\EstadosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/estados\/list","name":"solicitudes::estados.list","action":"App\Http\Controllers\Solicitudes\EstadosController@main"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/estados\/create","name":"solicitudes::estados.create","action":"App\Http\Controllers\Solicitudes\EstadosController@create"},{"host":null,"methods":["POST"],"uri":"solicitudes\/estados","name":"solicitudes::estados.store","action":"App\Http\Controllers\Solicitudes\EstadosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/estados\/edit\/{id}","name":"solicitudes::estados.edit","action":"App\Http\Controllers\Solicitudes\EstadosController@edit"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/estados\/{id}","name":"solicitudes::estados.update","action":"App\Http\Controllers\Solicitudes\EstadosController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/estados\/{id}","name":"solicitudes::estados.destroy","action":"App\Http\Controllers\Solicitudes\EstadosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/origenes","name":"solicitudes::origenes","action":"App\Http\Controllers\Solicitudes\OrigenesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/origenes\/list","name":"solicitudes::origenes.list","action":"App\Http\Controllers\Solicitudes\OrigenesController@main"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/origenes\/create","name":"solicitudes::origenes.create","action":"App\Http\Controllers\Solicitudes\OrigenesController@create"},{"host":null,"methods":["POST"],"uri":"solicitudes\/origenes","name":"solicitudes::origenes.store","action":"App\Http\Controllers\Solicitudes\OrigenesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/origenes\/edit\/{id}","name":"solicitudes::origenes.edit","action":"App\Http\Controllers\Solicitudes\OrigenesController@edit"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/origenes\/{id}","name":"solicitudes::origenes.update","action":"App\Http\Controllers\Solicitudes\OrigenesController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/origenes\/{id}","name":"solicitudes::origenes.destroy","action":"App\Http\Controllers\Solicitudes\OrigenesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/prioridades","name":"solicitudes::prioridades","action":"App\Http\Controllers\Solicitudes\PrioridadesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/prioridades\/list","name":"solicitudes::prioridades.list","action":"App\Http\Controllers\Solicitudes\PrioridadesController@main"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/prioridades\/create","name":"solicitudes::prioridades.create","action":"App\Http\Controllers\Solicitudes\PrioridadesController@create"},{"host":null,"methods":["POST"],"uri":"solicitudes\/prioridades","name":"solicitudes::prioridades.store","action":"App\Http\Controllers\Solicitudes\PrioridadesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/prioridades\/edit\/{id}","name":"solicitudes::prioridades.edit","action":"App\Http\Controllers\Solicitudes\PrioridadesController@edit"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/prioridades\/{id}","name":"solicitudes::prioridades.update","action":"App\Http\Controllers\Solicitudes\PrioridadesController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/prioridades\/{id}","name":"solicitudes::prioridades.destroy","action":"App\Http\Controllers\Solicitudes\PrioridadesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/tipos","name":"solicitudes::tipos","action":"App\Http\Controllers\Solicitudes\TiposController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/tipos\/list","name":"solicitudes::tipos.list","action":"App\Http\Controllers\Solicitudes\TiposController@main"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/tipos\/create","name":"solicitudes::tipos.create","action":"App\Http\Controllers\Solicitudes\TiposController@create"},{"host":null,"methods":["POST"],"uri":"solicitudes\/tipos","name":"solicitudes::tipos.store","action":"App\Http\Controllers\Solicitudes\TiposController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/tipos\/edit\/{id}","name":"solicitudes::tipos.edit","action":"App\Http\Controllers\Solicitudes\TiposController@edit"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/tipos\/{id}","name":"solicitudes::tipos.update","action":"App\Http\Controllers\Solicitudes\TiposController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/tipos\/{id}","name":"solicitudes::tipos.destroy","action":"App\Http\Controllers\Solicitudes\TiposController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/calles\/{nombre}","name":"solicitudes::calles.busqueda","action":"App\Http\Controllers\Solicitudes\SolicitudesController@buscarCalles"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/solicitudes","name":"solicitudes::","action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/solicitudes\/estado\/{estado?}","name":"solicitudes::solicitudes","action":"App\Http\Controllers\Solicitudes\SolicitudesController@main"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes","name":"solicitudes::index","action":"App\Http\Controllers\Solicitudes\SolicitudesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/solicitudes\/create","name":"solicitudes::solicitudes.create","action":"App\Http\Controllers\Solicitudes\SolicitudesController@create"},{"host":null,"methods":["POST"],"uri":"solicitudes\/solicitudes","name":"solicitudes::solicitudes.store","action":"App\Http\Controllers\Solicitudes\SolicitudesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/solicitudes\/{id}","name":"solicitudes::show","action":"App\Http\Controllers\Solicitudes\SolicitudesController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/solicitudes\/edit\/{id}","name":"solicitudes::solicitudes.edit","action":"App\Http\Controllers\Solicitudes\SolicitudesController@edit"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/solicitudes\/{id}","name":"solicitudes::solicitudes.update","action":"App\Http\Controllers\Solicitudes\SolicitudesController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/solicitudes\/{id}","name":"solicitudes::solicitudes.destroy","action":"App\Http\Controllers\Solicitudes\SolicitudesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/solicitudes\/{id}\/timeline","name":"solicitudes::solicitudes.timeline","action":"App\Http\Controllers\Solicitudes\SolicitudesController@timeline"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/solicitudes\/{id}\/imprimir","name":"solicitudes::solicitudes.imprimir","action":"App\Http\Controllers\Solicitudes\SolicitudesController@imprimir"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/solicitudes\/{id}\/orden-trabajo","name":"solicitudes::solicitudes.orden-trabajo","action":"App\Http\Controllers\Solicitudes\SolicitudesController@imprimirOrdenTrabajo"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/areas","name":"solicitudes::areas","action":"App\Http\Controllers\Solicitudes\AreasController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/areas\/list","name":"solicitudes::areas.list","action":"App\Http\Controllers\Solicitudes\AreasController@main"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/areas\/create","name":"solicitudes::areas.create","action":"App\Http\Controllers\Solicitudes\AreasController@create"},{"host":null,"methods":["POST"],"uri":"solicitudes\/areas","name":"solicitudes::areas.store","action":"App\Http\Controllers\Solicitudes\AreasController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/areas\/edit\/{id}","name":"solicitudes::areas.edit","action":"App\Http\Controllers\Solicitudes\AreasController@edit"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/areas\/{id}","name":"solicitudes::areas.update","action":"App\Http\Controllers\Solicitudes\AreasController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/areas\/{id}","name":"solicitudes::areas.destroy","action":"App\Http\Controllers\Solicitudes\AreasController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/agentes","name":"solicitudes::agentes","action":"App\Http\Controllers\Solicitudes\AgentesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/agentes\/list","name":"solicitudes::agentes.list","action":"App\Http\Controllers\Solicitudes\AgentesController@main"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/agentes\/create","name":"solicitudes::agentes.create","action":"App\Http\Controllers\Solicitudes\AgentesController@create"},{"host":null,"methods":["POST"],"uri":"solicitudes\/agentes","name":"solicitudes::agentes.store","action":"App\Http\Controllers\Solicitudes\AgentesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/agentes\/edit\/{id}","name":"solicitudes::agentes.edit","action":"App\Http\Controllers\Solicitudes\AgentesController@edit"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/agentes\/{id}","name":"solicitudes::agentes.update","action":"App\Http\Controllers\Solicitudes\AgentesController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/agentes\/{id}","name":"solicitudes::agentes.destroy","action":"App\Http\Controllers\Solicitudes\AgentesController@destroy"},{"host":null,"methods":["POST"],"uri":"solicitudes\/derivaciones","name":"solicitudes::derivaciones.store","action":"App\Http\Controllers\Solicitudes\DerivacionesController@store"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/derivaciones\/{id}","name":"solicitudes::derivaciones.update","action":"App\Http\Controllers\Solicitudes\DerivacionesController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/derivaciones\/{id}","name":"solicitudes::derivaciones.destroy","action":"App\Http\Controllers\Solicitudes\DerivacionesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/derivaciones\/{solicitudId}","name":"solicitudes::derivaciones.por-solicitud","action":"App\Http\Controllers\Solicitudes\DerivacionesController@porSolicitud"},{"host":null,"methods":["POST"],"uri":"solicitudes\/seguimientos","name":"solicitudes::seguimientos.store","action":"App\Http\Controllers\Solicitudes\SeguimientosController@store"},{"host":null,"methods":["PUT"],"uri":"solicitudes\/seguimientos\/{id}","name":"solicitudes::seguimientos.update","action":"App\Http\Controllers\Solicitudes\SeguimientosController@update"},{"host":null,"methods":["DELETE"],"uri":"solicitudes\/seguimientos\/{id}","name":"solicitudes::seguimientos.destroy","action":"App\Http\Controllers\Solicitudes\SeguimientosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitudes\/seguimientos\/{solicitudId}","name":"solicitudes::seguimientos.por-solicitud","action":"App\Http\Controllers\Solicitudes\SeguimientosController@porSolicitud"},{"host":null,"methods":["OPTIONS"],"uri":"api\/{all}","name":null,"action":"Closure"},{"host":null,"methods":["POST"],"uri":"api\/v1\/newsletter\/registrarse","name":"api::v1::","action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/alertas\/nivel-agua","name":"api::v1::alertas::nivel.agua","action":"App\Http\Controllers\Alertas\NivelAguaRegistroController@nivelAguaActual"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/alertas\/gacetillas","name":"api::v1::alertas::gacetillas","action":"App\Http\Controllers\Alertas\AlertaController@gacetillas"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/alertas\/estado-servicio","name":"api::v1::alertas::estado-servicio","action":"App\Http\Controllers\Alertas\AlertaController@getEstadoServicio"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/alertas\/hoy\/layer","name":"api::v1::alertas::hoy.layer","action":"App\Http\Controllers\Alertas\AlertaController@hoyLayer"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/alertas\/vigentes\/layer","name":"api::v1::alertas::vigentes.layer","action":"App\Http\Controllers\Alertas\AlertaController@vigentesLayer"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/alertas\/futuras\/layer","name":"api::v1::alertas::futuras.layer","action":"App\Http\Controllers\Alertas\AlertaController@futurasLayer"},{"host":null,"methods":["POST"],"uri":"api\/v1\/oficina-virtual\/libre-deuda","name":"api::v1::oficicina-virtual::pedidos.solicitar.libre-deuda","action":"App\Http\Controllers\OficinaVirtual\PedidoController@solicitarLibreDeuda"},{"host":null,"methods":["POST"],"uri":"api\/v1\/oficina-virtual\/facturas-vencidas","name":"api::v1::oficicina-virtual::pedidos.solicitar.facturas-vencidas","action":"App\Http\Controllers\OficinaVirtual\PedidoController@solicitarFacturasVencidas"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/oficina-virtual\/boletas-pago","name":"api::v1::oficicina-virtual::boletas-pago.generar","action":"App\Http\Controllers\OficinaVirtual\BoletaPagoController@generar"},{"host":null,"methods":["POST"],"uri":"api\/v1\/turnos","name":"api::v1::turnos::store","action":"App\Http\Controllers\Turnos\TurnoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/turnos\/actividades\/{id}","name":"api::v1::turnos::actividades.show","action":"App\Http\Controllers\Turnos\ActividadController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/turnos\/actividades\/{id}\/turnos-asignados","name":"api::v1::turnos::actividades.turnos-asignados","action":"App\Http\Controllers\Turnos\ActividadController@turnosAsignados"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

