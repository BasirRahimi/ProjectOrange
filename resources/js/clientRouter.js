import { createRouter, createWebHistory } from 'vue-router';

import AboutTheDeceased from '@/components/forms/probate/AboutTheDeceased.vue';
import Executors from '@/components/forms/probate/Executors.vue';
import Section2 from '@/components/forms/probate/Section2.vue';
import Section3 from '@/components/forms/probate/Section3.vue';
import Section4 from '@/components/forms/probate/Section4.vue';
import Section5 from '@/components/forms/probate/Section5.vue';
import Section6 from '@/components/forms/probate/Section6.vue';
import Section7 from '@/components/forms/probate/Section7.vue';
import Section8 from '@/components/forms/probate/Section8.vue';
import Section9 from '@/components/forms/probate/Section9.vue';
import Section10 from '@/components/forms/probate/Section10.vue';
import Section11 from '@/components/forms/probate/Section11.vue';
import Section12 from '@/components/forms/probate/Section12.vue';
import Section13 from '@/components/forms/probate/Section13.vue';
import Section14 from '@/components/forms/probate/Section14.vue';
import Section15 from '@/components/forms/probate/Section15.vue';
import Section16 from '@/components/forms/probate/Section16.vue';
import Section17 from '@/components/forms/probate/Section17.vue';
import Section18 from '@/components/forms/probate/Section18.vue';
import Section19 from '@/components/forms/probate/Section19.vue';
import Section20 from '@/components/forms/probate/Section20.vue';
import Overview from '@/components/forms/probate/Overview.vue';

let clientRoutes = [
    {
        name: 'AboutTheDeceased',
        path: '/clients/:id',
        component: AboutTheDeceased
    },
    {
        name: 'Executors',
        path: '/clients/:id/executors',
        component: Executors
    },
    {
        name: 'Section2',
        path: '/clients/:id/powers-of-attorney',
        component: Section2
    },
    {
        name: 'Section3',
        path: '/clients/:id/will-and-marital-status',
        component: Section3
    },
    {
        name: 'Section4',
        path: '/clients/:id/lifetime-gifts',
        component: Section4
    },
    {
        name: 'Section5',
        path: '/clients/:id/gifts',
        component: Section5
    },
    {
        name: 'Section6',
        path: '/clients/:id/uk-and-british-isles',
        component: Section6
    },
    {
        name: 'Section7',
        path: '/clients/:id/tax-havens',
        component: Section7
    },
    {
        name: 'Section8',
        path: '/clients/:id/nil-rate-band',
        component: Section8
    },
    {
        name: 'Section9',
        path: '/clients/:id/business-interests',
        component: Section9
    },
    {
        name: 'Section10',
        path: '/clients/:id/recieved-inheritence',
        component: Section10
    },
    {
        name: 'Section11',
        path: '/clients/:id/trusts',
        component: Section11
    },
    {
        name: 'Section12',
        path: '/clients/:id/pensions',
        component: Section12
    },
    {
        name: 'Section13',
        path: '/clients/:id/life-assurance',
        component: Section13
    },
    {
        name: 'Section14',
        path: '/clients/:id/joint-held-assets',
        component: Section14
    },
    {
        name: 'Section15',
        path: '/clients/:id/stocks-and-shares',
        component: Section15
    },
    {
        name: 'Section16',
        path: '/clients/:id/bank-and-savings',
        component: Section16
    },
    {
        name: 'Section17',
        path: '/clients/:id/personal-belongings',
        component: Section17
    },
    {
        name: 'Section18',
        path: '/clients/:id/assets',
        component: Section18
    },
    {
        name: 'Section19',
        path: '/clients/:id/liabilities',
        component: Section19
    },
    {
        name: 'Section20',
        path: '/clients/:id/other-information',
        component: Section20
    },
    {
        name: 'Overview',
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
