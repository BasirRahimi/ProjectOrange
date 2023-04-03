<template>
    <div class="d-flex flex-column-reverse">
        <div class="collapse" ref="collapseEl">
            <slot></slot>
        </div>
        <BaseButton
            v-if="toggleButton"
            @click="toggle()"
            size="sm"
            outline
            class="toggle">
            {{ toggleText }}
            <i class="icon-xs fa-solid fa-chevron-down ms-2"></i>
        </BaseButton>
    </div>
</template>

<script setup>
import BaseButton from '@/components/simple/BaseButton.vue';
import { onMounted, ref, onUpdated } from 'vue';
import { Collapse as BsCollapse } from '~bootstrap';

const props = defineProps({
    visible: Boolean,
    identifier: String,
    toggleButton: Boolean,
    toggleText: {
        type: String,
        default: 'Tip'
    }
});

const collapseEl = ref(null);
let collapse = null;

const toggle = () => {
    if (collapseEl.value.classList.contains('show')) {
        hide();
    } else {
        show();
    }
};
const show = () => {
    if (collapse._isTransitioning) return;
    collapseEl.value.classList.add('showing');
    collapse.show();
};
const hide = () => {
    if (collapse._isTransitioning) return;
    collapseEl.value.classList.remove('showing');
    collapse.hide();
};

const isCollapsed = () => {
    return collapseEl.value.classList.contains('show');
};

const identifier = props.identifier;

defineExpose({ toggle, show, hide, identifier, isCollapsed });

onMounted(() => {
    collapse = new BsCollapse(collapseEl.value, {
        toggle: props.visible
    });
});
onUpdated(() => {
    if (props.visible) {
        show();
    } else {
        hide();
    }
});
</script>
<style scoped lang="scss">
@import '@sass/vue_sfc.scss';

.toggle {
    width: fit-content;

    i {
        transition: transform 0.35s ease;
    }
}

.collapse + .toggle {
    i {
        transform: rotateZ(0deg);
    }
}

.showing + .toggle {
    i {
        transform: rotateZ(-180deg);
    }
}
</style>
