import { createRouter, createWebHistory } from 'vue-router';

import Dashboard from './views/Dashboard.vue';
import CaseFlows from './views/Dashboard/Caseflows.vue';
import DocumentLibrary from './views/Dashboard/DocumentLibrary.vue';
import KnowledgeBase from './views/Dashboard/KnowledgeBase.vue';
import Help from './views/Dashboard/Help.vue';
import Settings from './views/Dashboard/Settings.vue';
import Terms from './views/Dashboard/Terms.vue';
import NewCase from './views/Cases/NewCase.vue';
import EditCase from './views/Cases/EditCase.vue';

const routes = [
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard,
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
    },
    {
        name: 'Cases',
        path: '/cases',
        component: Dashboard,
        children: [
            {
                name: 'NewCase',
                path: 'new-case',
                component: NewCase
            },
            {
                name: 'EditCase',
                path: ':id/:section',
                component: EditCase,
                props: true
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
