<template>
    <div>
        <label v-if="label">{{ label }}</label>
        <div class="button-grid" :class="`colsize-${gridColsize}`">
            <base-button
                v-for="option in props.options"
                :key="option"
                type="default"
                outline
                class="m-0"
                :class="{ active: option === props.modelValue }"
                @click="emit('update:modelValue', option)"
                >{{ option }}</base-button
            >
        </div>
        <BCollapse
            v-for="(option, key) in props.options"
            :visible="option === props.modelValue">
            <slot :name="`collapse${key}`"></slot>
        </BCollapse>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import BCollapse from '@/components/simple/BCollapse.vue';
const props = defineProps({
    label: {
        type: String,
        default: null
    },
    options: {
        type: Array,
        default: () => ['Yes', 'No']
    },
    gridColsize: {
        type: Number,
        default: 150
    },
    modelValue: {}
});

const emit = defineEmits(['update:modelValue']);

const collapse = ref(null);
</script>
