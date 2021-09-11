/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

// package for notifications
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';
Vue.use(VueIziToast);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/BrandComponent.vue -> <example-component></example-component>
 */
Vue.component('brand-component', require('./components/BrandComponent.vue').default);
Vue.component('model-component', require('./components/ModelComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

// check if the user is admin
Vue.prototype.$isAdmin = document.querySelector("meta[name='is_admin']").getAttribute('content');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
});
