<template>
    <div class="d-grid" :style="{ gridTemplateRows: rows, gridTemplateColumns: columns }">
        <slot></slot>
    </div>
</template>

<script setup>
const props = defineProps({
    rows: Number,
    columns: Number
})
</script>