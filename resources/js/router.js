import { createRouter, createWebHistory } from 'vue-router';

import IFADashboard from './views/IFADashboard.vue';
import SuccessionDesk from './views/IFADashboard/SuccessionDesk.vue';
import ProbateDesk from './views/IFADashboard/ProbateDesk.vue';
import DocumentLibrary from './views/IFADashboard/DocumentLibrary.vue';
import KnowledgeBase from './views/IFADashboard/KnowledgeBase.vue';
import Help from './views/IFADashboard/Help.vue';
import Settings from './views/IFADashboard/Settings.vue';
import Terms from './views/IFADashboard/Terms.vue';

const routes = [
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: IFADashboard,
        children: [
            {
                name: 'SuccessionDesk',
                path: 'succession',
                component: SuccessionDesk
            },
            {
                name: 'ProbateDesk',
                path: 'probate',
                component: ProbateDesk
            },
            {
                name: 'DocumentLibrary',
                path: 'document-library',
                component: DocumentLibrary
            },
            {
                name: 'KnowledgeBase',
                path: 'knowledge-base',
                component: KnowledgeBase
            },
            {
                name: 'Help',
                path: 'help',
                component: Help
            },
            {
                name: 'Settings',
                path: 'settings',
                component: Settings
            },
            {
                name: 'Terms',
                path: 'terms',
                component: Terms
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
