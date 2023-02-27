<template>
    <div
        id="AppSideNav"
        class="bg-white px-3 py-4"
        :style="{
            width: '300px',
            height: `calc(100vh - ${appHeaderHeight}px`
        }">
        <nav>
            <div class="px-3 pb-4 border-bottom">
                <span class="text-gray-500">You're using</span><br />
                <span class="fs-5 text-primary fw-bold">SW.IO By Mabain</span>
            </div>
            <div class="py-4">
                <div class="text-gray-500 mb-3">YOUR CASEFLOWS</div>
                <ul class="fa-ul">
                    <li class="mb-3">
                        <router-link
                            to="/dashboard/succession"
                            class="router-link">
                            <span class="fa-li">
                                <i class="me-2 po-icon-person"></i>
                            </span>
                            Succession Desk
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            to="/dashboard/probate"
                            class="router-link">
                            <span class="fa-li">
                                <i class="fas fa-pen-nib me-2"></i>
                            </span>
                            Probate Desk
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script setup>
const props = defineProps({ appHeaderHeight: Number });
</script>

<style lang="scss">
@import '@sass/vue_sfc.scss';

#AppSideNav {
    position: fixed;

    .fa-ul {
        margin-left: 2rem;
    }

    .router-link {
        color: $default;
        transition: $transition-base;
        position: relative;
        &:hover {
            color: $primary;
        }
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
</style>
