/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');

import globalComponents from "./argon/plugins/globalComponents";
import globalDirectives from "./argon/plugins/globalDirectives";
import VueLazyload from "vue-lazyload";
Vue.use(globalComponents);
Vue.use(globalDirectives);
Vue.use(VueLazyload);

import { ModalPlugin } from 'bootstrap-vue';
Vue.use(ModalPlugin);

import { CollapsePlugin } from 'bootstrap-vue';
Vue.use(CollapsePlugin)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('client-form', require('./components/ClientForm.vue').default);
Vue.component('user-dashboard', require('./components/UserDashboard.vue').default);
Vue.component('app-header', require('./components/AppHeader.vue').default);
Vue.component('content-box', require('./components/client-form/ContentBox.vue').default);
Vue.component('request-access', require('./components/auth/RequestAccess.vue').default);

Vue.mixin({
    methods: {
        validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email); 
        },
        async saveSectionData(data, clientId) {
            let result;
            await axios.patch(`/clients/${clientId}`, data).then(response=>{
                result = [true, response];
            }).catch(response=>{
                result = [false, response];
            })
            return result;
        },
        flashLabel() {
            let label = $('.flashit');
            label.css('background-color', '#FB952C');
            setTimeout(() => {
                label.css('transition', 'all .9s');
                label.css('background-color', 'transparent');
            }, 100);
        },
        routerPush(section) {
            this.$router.push({name:section});
        },
        saveData(sectionName) {
            let data = {};
            data[sectionName] = JSON.stringify(this.formData);
            this.saveSectionData(data, this.$store.state.client.id).then(response=>{
                console.log(response)
            });
        }
    }
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from './router';
import store from './vuex';

const app = new Vue({
    el: '#app',
    router,
    store
});