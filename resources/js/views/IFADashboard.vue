<template>
    <AppHeader :app-side-nav-width="appSideNavWidth" />
    <AppSideNav :app-header-height="appHeaderHeight" />
    <main :style="{ 'margin-left': `${appSideNavWidth}px` }">
        <RouterView v-slot="{ Component }">
            <Transition>
                <component :is="Component" />
            </Transition>
        </RouterView>
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
onMounted(() => {
    appSideNavWidth.value = document.querySelector('#AppSideNav').clientWidth;
    appHeaderHeight.value = document.querySelector('#AppHeader').clientHeight;
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
