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
import DashboardSideNav from './views/Dashboard/SideNav.vue';
import CasesSideNav from './views/Cases/SideNav.vue';

const routes = [
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard,
        children: [
            {
                name: 'CaseFlows',
                path: 'cases/:caseType',
                components: {
                    default: CaseFlows,
                    LeftSideBar: DashboardSideNav
                },
                props: true
            },
            {
                name: 'DocumentLibrary',
                path: 'document-library',
                components: {
                    default: DocumentLibrary,
                    LeftSideBar: DashboardSideNav
                }
            },
            {
                name: 'KnowledgeBase',
                path: 'knowledge-base',
                components: {
                    default: KnowledgeBase,
                    LeftSideBar: DashboardSideNav
                }
            },
            {
                name: 'Help',
                path: 'help',
                components: {
                    default: Help,
                    LeftSideBar: DashboardSideNav
                }
            },
            {
                name: 'Settings',
                path: 'settings',
                components: {
                    default: Settings,
                    LeftSideBar: DashboardSideNav
                }
            },
            {
                name: 'Terms',
                path: 'terms',
                components: {
                    default: Terms,
                    LeftSideBar: DashboardSideNav
                }
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
                components: {
                    default: NewCase,
                    LeftSideBar: CasesSideNav
                }
            },
            {
                name: 'EditCase',
                path: ':id/:section',
                components: {
                    default: EditCase,
                    LeftSideBar: CasesSideNav
                },
                props: {
                    default: (route) => ({
                        ...route.params,
                        id: parseInt(route.params.id)
                    })
                } 
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
