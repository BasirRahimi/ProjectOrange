<template>
    <div
        id="AppSideNav"
        class="bg-white"
        :style="{
            height: `calc(100vh - ${appHeaderHeight}px`
        }">
        <nav class="d-flex flex-column h-100 px-3 py-4">
            <div id="branding" class="px-3 pb-4 mb-4 border-bottom">
                <span class="text-gray-500">You're using</span><br />
                <RouterLink class="fs-5 fw-bold" :to="{ name: 'Dashboard' }">
                    ATPS By Mabain
                </RouterLink>
            </div>
            <slot></slot>
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

    nav {
        overflow-y: scroll;

        &::-webkit-scrollbar {
            width: 0.25rem;
        }

        &::-webkit-scrollbar-track {
            background-color: $white;
            border-radius: 0.25rem;
        }

        &::-webkit-scrollbar-thumb {
            background-color: rgba($color: $black, $alpha: 0.2);
            border-radius: 0.25rem;
        }
    }
}
</style>
