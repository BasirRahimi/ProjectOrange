import { createRouter, createWebHistory } from 'vue-router';

import IFADashboard from './views/IFADashboard.vue';
import CaseFlows from './views/IFADashboard/Caseflows.vue';
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
                name: 'CaseFlows',
                path: 'cases/:caseType',
                component: CaseFlows,
                props: true
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
