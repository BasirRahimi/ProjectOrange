import './bootstrap';

import Vue from 'vue';

import globalComponents from "./argon/plugins/globalComponents";
import globalDirectives from "./argon/plugins/globalDirectives";
Vue.use(globalComponents);
Vue.use(globalDirectives);

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
import ClientForm from './components/ClientForm.vue';
import UserDashboard from './components/UserDashboard.vue'
import GrantAccess from './components/GrantAccess.vue';
import AppHeader from './components/AppHeader.vue';
import ContentBox from './components/client-form/ContentBox.vue';
import RequestAccess from './components/auth/RequestAccess.vue';
Vue.component('client-form', ClientForm);
Vue.component('user-dashboard', UserDashboard);
Vue.component('grant-access', GrantAccess);
Vue.component('app-header', AppHeader);
Vue.component('content-box', ContentBox);
Vue.component('request-access', RequestAccess);

Vue.mixin({
    methods: {
        validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        },
        async saveSectionData(data, clientId) {
            let result;
            await axios.patch(`/clients/${clientId}`, data).then(response => {
                result = [true, response];
            }).catch(response => {
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
            this.$router.push({ name: section });
        },
        saveData() {
            let data = {};
            data[this.section] = JSON.stringify(this.formData);
            this.saveSectionData(data, this.$store.state.client.id).then(response => {
                if (response[0]) {
                    console.log(response)
                    this.$store.commit('updateClient', response[1].data);
                }
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