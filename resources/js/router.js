import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    {
      name: 'section1',
      path: '/about',
      component: require('./components/client-form/sections/section1.vue').default
    },
    {
      name: 'section2',
      path: '/executors',
      component: require('./components/client-form/sections/section2.vue').default
    },
    {
      name: 'section3',
      path: '/powers-of-attorney',
      component: require('./components/client-form/sections/section3.vue').default
    },
    {
      name: 'section4',
      path: '/will-and-marital-status',
      component: require('./components/client-form/sections/section4.vue').default
    },
    {
      name: 'section5',
      path: '/lifetime-gifts',
      component: require('./components/client-form/sections/section5.vue').default
    },
    {
      name: 'section6',
      path: '/gifts',
      component: require('./components/client-form/sections/section6.vue').default
    },
    {
      name: 'section7',
      path: '/uk-and-british-isles',
      component: require('./components/client-form/sections/section7.vue').default
    },
    {
      name: 'section8',
      path: '/tax-havens',
      component: require('./components/client-form/sections/section8.vue').default
    },
    {
      name: 'section9',
      path: '/nil-rate-band',
      component: require('./components/client-form/sections/section9.vue').default
    },
    {
      name: 'section10',
      path: '/business-interests',
      component: require('./components/client-form/sections/section10.vue').default
    },
    {
      name: 'section11',
      path: '/recieved-inheritence',
      component: require('./components/client-form/sections/section11.vue').default
    },
    {
      name: 'section12',
      path: '/trusts',
      component: require('./components/client-form/sections/section12.vue').default
    },
    {
      name: 'section13',
      path: '/pensions',
      component: require('./components/client-form/sections/section13.vue').default
    },
    {
      name: 'section14',
      path: '/life-assurance',
      component: require('./components/client-form/sections/section14.vue').default
    },
    {
      name: 'section15',
      path: '/joint-held-assets',
      component: require('./components/client-form/sections/section15.vue').default
    },
    {
      name: 'section16',
      path: '/stocks-and-shares',
      component: require('./components/client-form/sections/section16.vue').default
    },
    {
      name: 'section17',
      path: '/bank-and-savings',
      component: require('./components/client-form/sections/section17.vue').default
    },
    {
      name: 'section18',
      path: '/personal-belongings',
      component: require('./components/client-form/sections/section18.vue').default
    },
    {
      name: 'section19',
      path: '/assets',
      component: require('./components/client-form/sections/section19.vue').default
    },
    {
      name: 'section20',
      path: '/liabilities',
      component: require('./components/client-form/sections/section20.vue').default
    },
    {
      name: 'section21',
      path: '/other-information',
      component: require('./components/client-form/sections/section21.vue').defaul
     }
  ],
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  }
});