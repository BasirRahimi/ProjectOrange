<template>
    <div class="client-form" :class="{ 'nav-collaped': navCollapsed }">
        <!-- <client-form-navigation @toggleNav="toggleNav"></client-form-navigation>
        <client-form-widgets></client-form-widgets> -->
        <div class="router-view">
            <router-view></router-view>
        </div>

        <!-- <client-form-utility-bar
            @toggleNav="toggleNav"
            @toggleWidgets=""></client-form-utility-bar> -->
    </div>
</template>

<script>
import ClientFormNavigation from './client-form/ClientFormNavigation.vue';
import ClientFormWidgets from './client-form/ClientFormWidgets.vue';
import ClientFormUtilityBar from './client-form/ClientFormUtilityBar.vue';
import { useClientStore } from '@/stores/client.js';

export default {
    name: 'ClientForm',
    setup() {
        const store = useClientStore();
        return { store };
    },
    components: {
        ClientFormNavigation,
        ClientFormWidgets,
        ClientFormUtilityBar
    },
    props: {
        client: {}
    },
    data() {
        return {
            navCollapsed: false,
            widgetsHidden: false
        };
    },
    beforeMount() {
        this.store.updateClient(this.client);
        if (window.innerWidth < 992) {
            this.widgetsHidden = true;
            this.navCollapsed = true;
        }
    },
    methods: {
        toggleNav(val) {
            this.navCollapsed = val ? val : !this.navCollapsed;
        }
    }
};
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.client-form {
    position: relative;
    padding-top: 60px;
    transition: 0.25s;
}

.form-content {
    width: 100%;
    padding-top: 64px;
    padding-left: 24px;
    padding-right: 24px;
}

@include media-breakpoint-down(md) {
    .client-form {
        padding-bottom: 56px;
    }
}
</style>
