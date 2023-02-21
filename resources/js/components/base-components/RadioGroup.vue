<template>
    <div class="radio-group">
        <template v-for="(option, key) in options">
            <BaseRadio v-model="model" :name="name">{{ option }}</BaseRadio>
        </template>
    </div>
</template>
<script setup>
import { computed } from 'vue';
import BaseRadio from './BaseRadio.vue';
const props = defineProps({
    options: Array,
    modelValue: String,
    name: String
});
const emit = defineEmits('update:modelValue');

const model = computed({
    get() {
        return props.modelValue;
    },
    set(val) {
        emit('update:modelValue', val);
    }
});
</script>
