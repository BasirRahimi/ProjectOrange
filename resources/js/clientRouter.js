import { createRouter, createWebHistory } from 'vue-router';

import Section1 from './components/client-form/sections/section1.vue';
import Section2 from './components/client-form/sections/section2.vue';
import Section3 from './components/client-form/sections/section3.vue';
import Section4 from './components/client-form/sections/section4.vue';
import Section5 from './components/client-form/sections/section5.vue';
import Section6 from './components/client-form/sections/section6.vue';
import Section7 from './components/client-form/sections/section7.vue';
import Section8 from './components/client-form/sections/section8.vue';
import Section9 from './components/client-form/sections/section9.vue';
import Section10 from './components/client-form/sections/section10.vue';
import Section11 from './components/client-form/sections/section11.vue';
import Section12 from './components/client-form/sections/section12.vue';
import Section13 from './components/client-form/sections/section13.vue';
import Section14 from './components/client-form/sections/section14.vue';
import Section15 from './components/client-form/sections/section15.vue';
import Section16 from './components/client-form/sections/section16.vue';
import Section17 from './components/client-form/sections/section17.vue';
import Section18 from './components/client-form/sections/section18.vue';
import Section19 from './components/client-form/sections/section19.vue';
import Section20 from './components/client-form/sections/section20.vue';
import Section21 from './components/client-form/sections/section21.vue';
import Overview from './components/client-form/overview.vue';

let clientRoutes = [
    {
        path: '/clients/:id',
        name: 'section1',
        component: Section1,
        children: [
            {
                name: 'section2',
                path: 'executors',
                component: Section2
            },
            {
                name: 'section3',
                path: 'powers-of-attorney',
                component: Section3
            },
            {
                name: 'section4',
                path: 'will-and-marital-status',
                component: Section4
            },
            {
                name: 'section5',
                path: 'lifetime-gifts',
                component: Section5
            },
            {
                name: 'section6',
                path: 'gifts',
                component: Section6
            },
            {
                name: 'section7',
                path: 'uk-and-british-isles',
                component: Section7
            },
            {
                name: 'section8',
                path: 'tax-havens',
                component: Section8
            },
            {
                name: 'section9',
                path: 'nil-rate-band',
                component: Section9
            },
            {
                name: 'section10',
                path: 'business-interests',
                component: Section10
            },
            {
                name: 'section11',
                path: 'recieved-inheritence',
                component: Section11
            },
            {
                name: 'section12',
                path: 'trusts',
                component: Section12
            },
            {
                name: 'section13',
                path: 'pensions',
                component: Section13
            },
            {
                name: 'section14',
                path: 'life-assurance',
                component: Section14
            },
            {
                name: 'section15',
                path: 'joint-held-assets',
                component: Section15
            },
            {
                name: 'section16',
                path: 'stocks-and-shares',
                component: Section16
            },
            {
                name: 'section17',
                path: 'bank-and-savings',
                component: Section17
            },
            {
                name: 'section18',
                path: 'personal-belongings',
                component: Section18
            },
            {
                name: 'section19',
                path: 'assets',
                component: Section19
            },
            {
                name: 'section20',
                path: 'liabilities',
                component: Section20
            },
            {
                name: 'section21',
                path: 'other-information',
                component: Section21
            },
            {
                name: 'overview',
                path: 'overview',
                component: Overview
            }
        ]
    }
];

let router = {
    inUse: false
};

if (window.location.pathname.match(/^\/clients/)) {
    router = {
        router: createRouter({
            history: createWebHistory(),
            routes: clientRoutes,
            scrollBehavior(to, from, savedPosition) {
                return { x: 0, y: 0 };
            }
        }),
        inUse: true
    };
}

export default router;
