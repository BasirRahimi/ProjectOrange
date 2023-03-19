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
            class="d-flex align-items-center px-4 py-3 align-self-stretch border-start flex-grow-1">
            <div class="fs-5 me-3 fw-bold">{{ title }}</div>
            <template v-if="subtitle">&#x2022;</template>
            <div class="text-gray-500 ms-3">
                {{ subtitle }}
            </div>
            <BaseDropdown
                menu-classes="shadow"
                position="right"
                tag="div"
                class="ms-auto">
                <template v-slot:title>
                    <base-button
                        type="link"
                        class="dropdown-toggle m-0 nav-link">
                        {{ userStore.user.name }} <span class="caret"></span>
                    </base-button>
                </template>

                <RouterLink :to="{ name: 'Dashboard' }" class="dropdown-item">
                    Dashboard
                </RouterLink>

                <a
                    v-if="userStore.user.role < 2"
                    href="/grant-access"
                    class="dropdown-item">
                    Access control
                </a>

                <a class="dropdown-item" href="/logout" @click.prevent="logout">
                    Logout
                </a>
            </BaseDropdown>
        </div>
    </nav>
</template>

<script setup>
import { useUserStore } from '@/stores/user.js';
import { useRoute } from 'vue-router';
import { watch, ref, onBeforeMount } from 'vue';
import BaseDropdown from '@/components/simple/BaseDropdown.vue';

const props = defineProps({ appSideNavWidth: Number });
const userStore = useUserStore();
const route = useRoute();

const title = ref('');
const subtitle = ref('');

onBeforeMount(() => {
    routeUpdated(route);
});

watch(route, (newVal) => {
    routeUpdated(newVal);
});

const logout = async () => {
    await axios.post('/logout');
    window.location.href = '/';
};

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
