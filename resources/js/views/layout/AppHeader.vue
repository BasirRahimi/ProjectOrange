<template>
    <nav
        id="AppHeader"
        class="navbar sticky-top bg-white shadow p-0 justify-content-start"
        ref="el">
        <div
            class="px-4 py-3 d-none d-md-block"
            :style="{ width: `${appSideNavWidth}px` }">
            <div class="fw-bold">Hi, John Doe</div>
            <div class="text-gray-500">Company Name Ltd</div>
        </div>
        <div
            class="d-flex align-items-center px-4 py-3 align-self-stretch border-start">
            <span class="fs-5 d-block me-3 fw-bold">Your Succession Cases</span>
            &#x2022;
            <span class="text-gray-500 d-block ms-3">
                Manage existing, or open new succession cases here
            </span>
        </div>
    </nav>
</template>

<script setup>
const props = defineProps({ appSideNavWidth: Number });
</script>
<style lang="scss" scoped></style>
