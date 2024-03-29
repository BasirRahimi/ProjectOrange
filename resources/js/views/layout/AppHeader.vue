<template>
    <nav
        id="AppHeader"
        class="navbar sticky-top bg-white shadow p-0 justify-content-start align-items-stretch"
        ref="el">
        <div class="px-4 py-3 d-none d-md-block welcome">
            <div v-if="userStore.user" class="fw-bold">
                Hi, {{ userStore.user.name }}
            </div>
            <div v-if="userStore.user" class="text-gray-500">
                {{ userStore.user.company }}
            </div>
        </div>
        <div class="border-start flex-grow-1">
            <div class="d-flex align-items-center px-4 py-3 container h-100">
                <div class="fs-5 me-3 fw-bold">{{ title }}</div>
                <template v-if="subtitle">&#x2022;</template>
                <div class="text-gray-500 ms-3">
                    {{ subtitle }}
                </div>
                <BaseDropdown
                    v-if="userStore.user"
                    menu-classes="shadow"
                    tag="div"
                    class="ms-auto"
                    :title="userStore.user.name">
                    <RouterLink
                        :to="{ name: 'Dashboard' }"
                        class="dropdown-item">
                        Dashboard
                    </RouterLink>

                    <a
                        v-if="userStore.user.role < 2"
                        href="/grant-access"
                        class="dropdown-item">
                        Access control
                    </a>

                    <a
                        class="dropdown-item"
                        href="/logout"
                        @click.prevent="logout">
                        Logout
                    </a>
                </BaseDropdown>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { useUserStore } from '@/stores/user.js';
import { useRoute } from 'vue-router';
import { watch, ref, onMounted } from 'vue';
import BaseDropdown from '@/components/simple/BaseDropdown.vue';

const props = defineProps({ appSideNavWidth: Number });
const route = useRoute();

const userStore = useUserStore();
await userStore.fetchUser(false);

const title = ref('');
const subtitle = ref('');

onMounted(() => {
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
            if (userStore.user.role_name == 'admin') {
                title.value = 'Pre-Submitted Cases';
                subtitle.value = 'Your received cases, provide feedback here';
            } else {
                if (newRoute.params.caseType === 'probate') {
                    title.value = 'Your Probate Cases';
                    subtitle.value =
                        'Manage existing, or open new probate cases here';
                }
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
<style lang="scss" scoped>
#AppHeader {
    .welcome {
        width: 250px;
    }
}
</style>
