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
import UserManagement from './views/Dashboard/UserManagement.vue';
import { useUserStore } from './stores/user';

const routes = [
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard,
        beforeEnter: async (to, from) => {
            const userStore = useUserStore();
            await userStore.fetchUser(false);

            if (
                userStore.user.role_name == 'superadmin' &&
                to.name == 'Dashboard'
            ) {
                return { name: 'UserManagement' };
            }
        },
        children: [
            {
                name: 'UserManagement',
                path: 'manage-users',
                components: {
                    default: UserManagement,
                    LeftSideBar: DashboardSideNav
                }
            },
            {
                name: 'CaseFlows',
                path: 'cases/:caseType?',
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
                    LeftSideBar: DashboardSideNav
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

export default createRouter({
    history: createWebHistory(),
    routes: routes
});
