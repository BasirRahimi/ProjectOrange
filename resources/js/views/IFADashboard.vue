<template>
    <AppHeader :app-side-nav-width="appSideNavWidth" />
    <AppSideNav :app-header-height="appHeaderHeight" />
    <main :style="{ 'margin-left': `${appSideNavWidth}px` }">
        <RouterView />
    </main>
</template>

<script setup>
import AppHeader from '@/views/layout/AppHeader.vue';
import AppSideNav from '@/views/layout/AppSideNav.vue';
import { ref, onMounted } from 'vue';

const appHeaderHeight = ref(80);
const appSideNavWidth = ref(300);
onMounted(() => {
    appSideNavWidth.value = document.querySelector('#AppSideNav').clientWidth;
    appHeaderHeight.value = document.querySelector('#AppHeader').clientHeight;
});
</script>
<style lang="scss" scoped></style>
