
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

let bootbox = require('bootbox');
 
require.config({
 paths: {
 "jquery": "//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery",
 "bootstrap": "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min",
 "bootbox": "//cdn.jsdelivr.net/bootbox/4.3.0/bootbox"
 },
 shim : {
 "bootstrap" : { "deps" :['jquery'] }
 }
});

window.Vue = require('vue');
// window.bootbox = require('bootbox')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
