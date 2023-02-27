import { createRouter, createWebHistory } from 'vue-router';

import IFADashboard from './views/IFADashboard.vue';
import SuccessionDesk from './components/SuccessionDesk.vue';
import ProbateDesk from './components/ProbateDesk.vue';
const routes = [
    {
        path: '/dashboard',
        component: IFADashboard,
        children: [
            {
                path: 'succession',
                component: SuccessionDesk
            },
            {
                path: 'probate',
                component: ProbateDesk
            }
        ]
    }
];

let router = {
    inUse: false
};

if (!window.location.pathname.match(/^\/clients/)) {
    router = {
        router: createRouter({
            history: createWebHistory(),
            routes: routes
        }),
        inUse: true
    };
}

export default router;
