import '@sass/main.scss';
import './bootstrap';

import.meta.glob(['../images/**/*']);

// VUE 3
import { createApp } from 'vue/dist/vue.esm-bundler.js';
const app = createApp({
    /* root component options */
});

// Components
import globalComponents from './globalComponents';
app.use(globalComponents);

// Directives
import clickOutside from './directives/click-ouside.js';
app.directive('click-outside', clickOutside);

// Store
import { createPinia } from 'pinia';
app.use(createPinia());

// Router
import router from './router';
app.use(router);

app.mount('#app');
