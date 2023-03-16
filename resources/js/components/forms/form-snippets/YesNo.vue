<template>
    <div>
        <label :class="labelClass">{{ label }}</label>
        <div class="button-grid colsize-100">
            <base-button type="default" outline :class="{ active: props.modelValue }" @click="yes()">Yes</base-button>
            <base-button type="default" outline :class="{ active: !props.modelValue }" @click="no()">No</base-button>
        </div>
        <BCollapse v-if="collapse" ref="collapse1" v-model="props.modelValue">
            <slot></slot>
        </BCollapse>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import BCollapse from '@/components/simple/BCollapse.vue';
const collapse1 = ref(null);
const props = defineProps({
    label: {
        type: String,
        default: 'No question given'
    },
    labelClass: {
        type: String
    },
    collapse: {
        type: Boolean,
        default: false
    },
    modelValue: {
        type: Boolean,
        default: null
    },
    openOn: {
        type: Boolean,
        default: true
    }
});

const emit = defineEmits(['update:modelValue']);

const yes = () => {
    if (props.collapse) {
        props.openOn ? collapse1.value.show() : collapse1.value.hide();
    }
    emit('update:modelValue', true);
};

const no = () => {
    if (props.collapse) {
        props.openOn ? collapse1.value.hide() : collapse1.value.show();
    }
    emit('update:modelValue', false);
};
</script>

<style></style>
