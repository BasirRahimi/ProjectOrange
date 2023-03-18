<template>
    <nav
        id="AppHeader"
        class="navbar sticky-top bg-white shadow p-0 justify-content-start"
        ref="el">
        <div
            class="px-4 py-3 d-none d-md-block"
            :style="{ width: `${appSideNavWidth}px` }">
            <div class="fw-bold">Hi, {{ userStore.user.name }}</div>
            <div class="text-gray-500">{{ userStore.user.company }}</div>
        </div>
        <div
            class="d-flex align-items-center px-4 py-3 align-self-stretch border-start">
            <span class="fs-5 d-block me-3 fw-bold">{{ title }}</span>
            <template v-if="subtitle">&#x2022;</template>
            <span class="text-gray-500 d-block ms-3">
                {{ subtitle }}
            </span>
        </div>
    </nav>
</template>

<script setup>
import { useUserStore } from '@/stores/user.js';
import { useCaseStore } from '@/stores/case.js';
import { useRoute } from 'vue-router';
import { watch, ref, onBeforeMount } from 'vue';

const props = defineProps({ appSideNavWidth: Number });
const userStore = useUserStore();
const caseStore = useCaseStore();
const route = useRoute();

const title = ref('');
const subtitle = ref('');

onBeforeMount(() => {
    routeUpdated(route);
});

watch(route, (newVal) => {
    routeUpdated(newVal);
});

const routeUpdated = (newRoute) => {
    switch (newRoute.name) {
        case 'Dashboard':
            title.value = 'Dashboard';
            subtitle.value = '';
            break;
        case 'CaseFlows':
            if (newRoute.params.caseType === 'probate') {
                title.value = 'Your Probate Cases';
                subtitle.value =
                    'Manage existing, or open new probate cases here';
            }
            break;
        case 'DocumentLibrary':
            title.value = 'Document Library';
            subtitle.value = '';
            break;
        case 'KnowledgeBase':
            title.value = 'Knowledge Base';
            subtitle.value = '';
            break;
        case 'Help':
            title.value = 'Help & Contact';
            subtitle.value = '';
            break;
        case 'Settings':
            title.value = 'Settings';
            subtitle.value = '';
            break;
        case 'Terms':
            title.value = 'Terms';
            subtitle.value = '';
            break;
        case 'EditCase':
            // if (caseStore.caseType === 'probate') {
            //     title.value = 'Probate Case';
            //     subtitle.value = '';
            // }
            break;

        default:
            title.value = '';
            subtitle.value = '';
            break;
    }
};
</script>
<style lang="scss" scoped></style>
