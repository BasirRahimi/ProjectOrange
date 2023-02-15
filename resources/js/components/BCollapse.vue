<template>
    <div class="collapse" :class="{ show: props.visible }" ref="collapse">
        <slot></slot>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
const props = defineProps({
    visible: Boolean
});
const collapse = ref(null);

onMounted(() => {
    new bootstrap.Collapse(collapse.value, {
        toggle: false
    });
});
</script>
