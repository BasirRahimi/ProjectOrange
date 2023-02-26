<template>
    <div v-if="cssGrid">
        <label v-if="label">{{ label }}</label>
        <div class="button-grid" :class="`colsize-${gridColsize}`">
            <base-button
                v-for="(option, key) in optionsCopy"
                :key="key"
                type="default"
                outline
                class="m-0"
                :class="{ active: option.active === true }"
                @click="update(key)"
                >{{ option.value }}</base-button
            >
        </div>
        <BCollapse
            :visible="option.active"
            v-for="(option, key) in optionsCopy"
            ref="collapse">
            <slot :name="`collapse${key}`"></slot>
        </BCollapse>
    </div>

    <div v-else>
        <label v-if="label">{{ label }}</label>
        <div v-if="sameWidthButtons" class="row no-gutters flex-wrap">
            <base-button
                v-for="(option, key) in optionsCopy"
                :key="key"
                type="default"
                outline
                class="col"
                :class="[
                    { active: option.active === true },
                    { 'me-3': key != optionsCopy.length - 1 }
                ]"
                @click="update(key)"
                >{{ option.value }}</base-button
            >
        </div>
        <template v-else>
            <br />
            <base-button
                v-for="(option, key) in optionsCopy"
                :key="key"
                type="default"
                outline
                :class="{ active: option.active === true }"
                @click="update(key)"
                >{{ option.value }}</base-button
            >
        </template>
    </div>
</template>
<script setup>
import { ref, onBeforeMount } from 'vue';
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
    multichoice: {
        type: Boolean,
        default: false
    },
    sameWidthButtons: {
        type: Boolean,
        default: false
    },
    cssGrid: {
        type: Boolean,
        default: false
    },
    gridColsize: {
        type: Number,
        default: 150
    },
    modelValue: {}
});

const optionsCopy = ref([]);
onBeforeMount(() => {
    optionsCopy.value = props.options.map((x) => {
        return {
            value: x,
            active: props.modelValue === x ? true : false
        };
    });
});
const emit = defineEmits(['update:modelValue']);
const update = (index) => {
    if (!props.multichoice) {
        optionsCopy.value.forEach((x, i) => {
            if (i === index) {
                x.active = true;
                collapse.value[i].show();
                emit('update:modelValue', x.value);
            } else {
                x.active = false;
                collapse.value[i].hide();
            }
        });
    } else {
        optionsCopy.value[index].active = !optionsCopy.value[index].active;
        optionsCopy.value[index].active
            ? collapse.value[index].show()
            : collapse.value[index].hide();
        emit('update:modelValue', optionsCopy.value);
    }
};

const collapse = ref(null);
</script>
