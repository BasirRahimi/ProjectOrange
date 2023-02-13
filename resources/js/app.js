import '@/main.scss';
import './bootstrap';

// VUE 3
import { createApp } from 'vue/dist/vue.esm-bundler.js'
import helper from './mixins/helper';
const app = createApp({
    /* root component options */
    mixins: [helper]
})

// Components
import globalComponents from './plugins/globalComponents';
app.use(globalComponents);

// Directives
import clickOutside from "./directives/click-ouside.js";
app.directive('click-outside', clickOutside);

// Router
import clientRouter from './clientRouter';
if (clientRouter.inUse) {
    app.use(createRouter(clientRouter.router));
}

// Store
import { createPinia } from 'pinia'
app.use(createPinia());

app.mount('#app');