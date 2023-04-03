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

// Router
// import clientRouter from './clientRouter';
// router to replace clientRouter after clients refactored to cases
// if (clientRouter.inUse) {
//     app.use(clientRouter.router);
// }
import router from './router';
if (router.inUse) {
    app.use(router.router);
}

// Store
import { createPinia } from 'pinia';
app.use(createPinia());

app.mount('#app');
