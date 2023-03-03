<template>
    <AppHeader :app-side-nav-width="appSideNavWidth" />
    <AppSideNav :app-header-height="appHeaderHeight" />
    <main
        :style="{
            'margin-left': `${appSideNavWidth}px`,
            'padding-top': `${paddingTop}px`
        }">
        <div class="container">
            <RouterView v-slot="{ Component }">
                <Transition>
                    <component :is="Component" />
                </Transition>
            </RouterView>
        </div>
    </main>
</template>

<script setup>
import AppHeader from '@/views/layout/AppHeader.vue';
import AppSideNav from '@/views/layout/AppSideNav.vue';
import { ref, onMounted } from 'vue';

import { useUserStore } from '@/stores/user.js';
const userStore = useUserStore();

const props = defineProps(['user']);
userStore.setUser(props.user);

const appHeaderHeight = ref(80);
const appSideNavWidth = ref(300);
const paddingTop = ref(100);

onMounted(() => {
    let sideNav = document.querySelector('#AppSideNav');
    let appHeader = document.querySelector('#AppHeader');
    let branding = document.querySelector('#branding');
    appSideNavWidth.value = sideNav.clientWidth;
    appHeaderHeight.value = appHeader.clientHeight;

    let x = getComputedStyle(sideNav).paddingTop;
    paddingTop.value =
        parseInt(x.slice(0, x.length - 2)) + parseInt(branding.clientHeight);
});
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';
// .v-leave-active
.v-enter-active {
    transition: $transition-base;
    transition-property: opacity;
    transition-duration: 0.5s;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
