<template>
    <div
        id="AppSideNav"
        class="bg-white px-3 py-4"
        :style="{
            height: `calc(100vh - ${appHeaderHeight}px`
        }">
        <nav class="d-flex flex-column h-100">
            <div id="branding" class="px-3 pb-4 mb-4 border-bottom">
                <span class="text-gray-500">You're using</span><br />
                <a href="#" class="fs-5 fw-bold">ATPS By Mabain</a>
            </div>
            <div class="mb-4">
                <div class="text-gray-500 mb-3 text-uppercase">
                    Your Caseflows
                </div>
                <ul class="fa-ul">
                    <li class="mb-3">
                        <RouterLink
                            to="/dashboard/succession"
                            class="router-link">
                            <span class="fa-li">
                                <i class="me-2 po-icon-person"></i>
                            </span>
                            Succession Desk
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/dashboard/probate" class="router-link">
                            <span class="fa-li">
                                <i class="fas fa-pen-nib me-2"></i>
                            </span>
                            Probate Desk
                        </RouterLink>
                    </li>
                </ul>
            </div>
            <div class="mb-4">
                <RouterLink
                    class="router-link text-uppercase"
                    to="/dashboard/document-library">
                    Document Library
                </RouterLink>
            </div>
            <div class="mb-4">
                <RouterLink
                    class="router-link text-uppercase"
                    to="/dashboard/knowledge-base">
                    Knowledge Base
                </RouterLink>
            </div>
            <div class="mb-4">
                <RouterLink
                    class="router-link text-uppercase"
                    to="/dashboard/help"
                    >Help & Contact</RouterLink
                >
            </div>
            <div class="mt-auto">
                <div class="mb-3">
                    <RouterLink
                        class="router-link text-uppercase"
                        to="/dashboard/settings"
                        >Settings</RouterLink
                    >
                </div>
                <div>
                    <RouterLink
                        class="router-link text-uppercase"
                        to="/dashboard/terms"
                        >Terms</RouterLink
                    >
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';

const props = defineProps({ appHeaderHeight: Number });
</script>

<style lang="scss">
@import '@sass/vue_sfc.scss';

#AppSideNav {
    position: fixed;

    .fa-ul {
        margin-left: 2rem;

        .router-link {
            color: $default;
            &.router-link-exact-active {
                color: $primary;
                margin-left: 0.5rem;
                &::before {
                    content: '';
                    background-color: $primary;
                    width: 0.25rem;
                    height: 100%;
                    display: block;
                    position: absolute;
                    left: -3.5rem;
                }
            }
        }
    }

    .router-link {
        color: $gray-500;
        transition: $transition-base;
        position: relative;
        &:hover {
            color: $primary;
        }
    }
}
</style>
