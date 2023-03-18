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
                @click="update(option)"
                >{{ option }}</base-button
            >
        </div>
        <BCollapse
            v-for="(option, key) in props.options"
            :model-value="option === props.modelValue"
            ref="collapse">
            <slot :name="`collapse${key}`"></slot>
        </BCollapse>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
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
const update = (option) => {
    props.options.forEach((x, i) => {
        if (x === option) {
            collapse.value[i].show();
            emit('update:modelValue', option);
        } else {
            collapse.value[i].hide();
        }
    });
};

onMounted(() => {
    props.options.forEach((x, i) => {
        if (x === props.modelValue) {
            collapse.value[i].show();
        }
    });
});

const collapse = ref(null);
</script>
