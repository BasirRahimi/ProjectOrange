<template>
    <div
        class="content-box rounded mb-3"
        :class="[{ shadow: shadow }, { 'bg-white': whiteBg }]">
        <p v-if="title" class="title h5 text-center">
            <b>{{ title }}</b>
        </p>
        <slot></slot>
    </div>
</template>

<script setup>
const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    shadow: {
        type: Boolean,
        default: true
    },
    whiteBg: {
        type: Boolean,
        default: true
    }
});
</script>

<style scoped>
.content-box {
    padding: 40px;
}
.title {
    margin-bottom: 40px;
}
</style>
