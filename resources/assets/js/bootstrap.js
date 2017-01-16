/**
 * A modern JavaScript utility library delivering modularity, performance & extras.
 */

window._ = require('lodash');


// /**
//  * We'll load jQuery and the Bootstrap jQuery plugin which provides support
//  * for JavaScript based Bootstrap features such as modals and tabs. This
//  * code may be modified to fit the specific needs of your application.
//  */

// window.$ = window.jQuery = require('jquery');


/**
 * Parse, validate, manipulate, and display dates in JavaScript.
 */

window.moment = require('moment');

// Set Spanish for momentjs locate
moment.locale('es');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');


/**
 * The plugin for Vue.js provides services for making web requests
 * and handle responses using a XMLHttpRequest or JSONP.
 */

require('vue-resource');

/**
 *@TODO hay un error con la directiva "fields" entre este componente y el panal-table

 * vee-validate is a lightweight plugin for Vue.js that allows you
 * to validate input fields, and display errors.
 *
 * https://github.com/logaretm/vee-validate
 * https://dotdev.co/form-validation-using-vue-js-2-35abd6b18c5d#.8pk69tnas
 */
// window.VeeValidate = require('vee-validate');
// Vue.use(require('vee-validate'));


/**
 *  Events is a var that has a vue instance for haddle events such as emit, on, off
 */
window.Events = new Vue({});

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
  request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;

  next();
});


/**
* Laravel routes
*/

window.Router = require('./routes.js');


/**
* Config
*/

require('./config/index');

/**
* Directives
*/

require('./directives/index');


/**
* Filters
*/

require('./filters/index');

/**
* Mixins
*/

require('./mixins/index');

/**
* Vendors or External Components
*/

require('./vendors');
