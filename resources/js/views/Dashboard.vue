<template>
    <Transition>
        <Suspense>
            <template #default>
                <div>
                    <AppHeader :app-side-nav-width="appSideNavWidth">
                        <RouterView name="AppHeader" v-slot="{ Component }">
                            <Transition>
                                <component :is="Component" />
                            </Transition>
                        </RouterView>
                    </AppHeader>
                    <AppSideNav :app-header-height="appHeaderHeight">
                        <RouterView name="LeftSideBar" v-slot="{ Component }">
                            <Transition>
                                <component :is="Component" />
                            </Transition>
                        </RouterView>
                    </AppSideNav>
                    <main>
                        <div class="container">
                            <RouterView v-slot="{ Component }">
                                <Transition>
                                    <component :is="Component" />
                                </Transition>
                            </RouterView>
                        </div>
                    </main>
                </div>
            </template>
            <template #fallback>
                <PageLoad />
            </template>
        </Suspense>
    </Transition>
</template>

<script setup>
import AppHeader from '@/views/layout/AppHeader.vue';
import AppSideNav from '@/views/layout/AppSideNav.vue';
import { ref, onMounted, nextTick } from 'vue';
import { useUserStore } from '@/stores/user';
import PageLoad from './PageLoad.vue';

const appHeaderHeight = ref(80);
const appSideNavWidth = ref(300);
const paddingTop = ref(100);

// onMounted(() => {
//     nextTick(() => {
//         let sideNav = document.querySelector('#AppSideNav');
//         let appHeader = document.querySelector('#AppHeader');
//         let branding = document.querySelector('#branding');
//         appSideNavWidth.value = sideNav.clientWidth;

//         appHeaderHeight.value = appHeader.clientHeight;

//         let x = getComputedStyle(sideNav.children[0]).paddingTop;
//         paddingTop.value =
//             parseInt(x.slice(0, x.length - 2)) +
//             parseInt(branding.clientHeight);
//     });
// });
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

// .v-leave-active,
.v-enter-active {
    transition: $transition-base;
    transition-property: opacity;
    transition-duration: 0.5s;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

main {
    padding-top: calc(79px + 1.5rem);
    margin-left: 250px;
}
</style>
