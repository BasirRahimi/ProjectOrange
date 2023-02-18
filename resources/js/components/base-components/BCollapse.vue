<template>
    <div class="collapse" ref="collapseEl">
        <slot></slot>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { Collapse as BsCollapse } from 'bootstrap';

const props = defineProps({
    visible: Boolean
});
const collapseEl = ref(null);
let collapse = null;

const toggle = () => {
    collapse.toggle();
};
const show = () => {
    collapse.show();
};
const hide = () => {
    collapse.hide();
};

defineExpose({ toggle, show, hide });

onMounted(() => {
    collapse = new BsCollapse(collapseEl.value, {
        toggle: props.visible
    });
});
</script>
