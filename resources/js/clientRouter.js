import { createRouter, createWebHistory } from 'vue-router';

import Section1 from '@/components/client-form/sections/Section1.vue';
import Section2 from '@/components/client-form/sections/Section2.vue';
import Section3 from '@/components/client-form/sections/Section3.vue';
import Section4 from '@/components/client-form/sections/Section4.vue';
import Section5 from '@/components/client-form/sections/Section5.vue';
import Section6 from '@/components/client-form/sections/Section6.vue';
import Section7 from '@/components/client-form/sections/Section7.vue';
import Section8 from '@/components/client-form/sections/Section8.vue';
import Section9 from '@/components/client-form/sections/Section9.vue';
import Section10 from '@/components/client-form/sections/Section10.vue';
import Section11 from '@/components/client-form/sections/Section11.vue';
import Section12 from '@/components/client-form/sections/Section12.vue';
import Section13 from '@/components/client-form/sections/Section13.vue';
import Section14 from '@/components/client-form/sections/Section14.vue';
import Section15 from '@/components/client-form/sections/Section15.vue';
import Section16 from '@/components/client-form/sections/Section16.vue';
import Section17 from '@/components/client-form/sections/Section17.vue';
import Section18 from '@/components/client-form/sections/Section18.vue';
import Section19 from '@/components/client-form/sections/Section19.vue';
import Section20 from '@/components/client-form/sections/Section20.vue';
import Section21 from '@/components/client-form/sections/Section21.vue';
import Overview from '@/components/client-form/sections/Overview.vue';

let clientRoutes = [
    {
        name: 'section1',
        path: '/clients/:id',
        component: Section1
    },
    {
        name: 'section2',
        path: '/clients/:id/executors',
        component: Section2
    },
    {
        name: 'section3',
        path: '/clients/:id/powers-of-attorney',
        component: Section3
    },
    {
        name: 'section4',
        path: '/clients/:id/will-and-marital-status',
        component: Section4
    },
    {
        name: 'section5',
        path: '/clients/:id/lifetime-gifts',
        component: Section5
    },
    {
        name: 'section6',
        path: '/clients/:id/gifts',
        component: Section6
    },
    {
        name: 'section7',
        path: '/clients/:id/uk-and-british-isles',
        component: Section7
    },
    {
        name: 'section8',
        path: '/clients/:id/tax-havens',
        component: Section8
    },
    {
        name: 'section9',
        path: '/clients/:id/nil-rate-band',
        component: Section9
    },
    {
        name: 'section10',
        path: '/clients/:id/business-interests',
        component: Section10
    },
    {
        name: 'section11',
        path: '/clients/:id/recieved-inheritence',
        component: Section11
    },
    {
        name: 'section12',
        path: '/clients/:id/trusts',
        component: Section12
    },
    {
        name: 'section13',
        path: '/clients/:id/pensions',
        component: Section13
    },
    {
        name: 'section14',
        path: '/clients/:id/life-assurance',
        component: Section14
    },
    {
        name: 'section15',
        path: '/clients/:id/joint-held-assets',
        component: Section15
    },
    {
        name: 'section16',
        path: '/clients/:id/stocks-and-shares',
        component: Section16
    },
    {
        name: 'section17',
        path: '/clients/:id/bank-and-savings',
        component: Section17
    },
    {
        name: 'section18',
        path: '/clients/:id/personal-belongings',
        component: Section18
    },
    {
        name: 'section19',
        path: '/clients/:id/assets',
        component: Section19
    },
    {
        name: 'section20',
        path: '/clients/:id/liabilities',
        component: Section20
    },
    {
        name: 'section21',
        path: '/clients/:id/other-information',
        component: Section21
    },
    {
        name: 'overview',
        path: '/clients/:id/overview',
        component: Overview
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
