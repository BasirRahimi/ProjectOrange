<template>
    <div
        class="d-flex align-items-center px-4 py-3 align-self-stretch border-start">
        <span class="fs-5 d-block me-3 fw-bold">{{ title }}</span>
        <template v-if="subtitle">&#x2022;</template>
        <span class="text-gray-500 d-block ms-3">
            {{ subtitle }}
        </span>
    </div>
</template>

<script setup></script>
