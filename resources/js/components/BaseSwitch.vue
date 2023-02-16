<template>
    <div
        class="form-check form-switch"
        :class="{ 'coloured-dot': leftText.length }">
        <label
            class="form-check-label switch-text-left"
            @click="value = false"
            v-if="leftText"
            >{{ leftText }}</label
        >
        <input
            v-model="value"
            class="form-check-input"
            type="checkbox"
            role="switch"
            id="flexSwitchCheckDefault" />
        <label
            class="form-check-label switch-text-right"
            @click="value = true"
            v-if="label"
            >{{ label }}</label
        >
    </div>
</template>
<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: [Boolean, String]
    },
    label: '',
    leftText: ''
});

const emit = defineEmits(['update:modelValue']);

const value = computed({
    get() {
        if (typeof props.modelValue === 'string') {
            return props.label === props.modelValue;
        }
        return props.modelValue;
    },
    set(value) {
        if (typeof props.modelValue === 'string') {
            emit('update:modelValue', value ? props.label : props.leftText);
        } else {
            emit('update:modelValue', value);
        }
    }
});
</script>
<style scoped lang="scss">
@import '@sass/vue_sfc.scss';

.form-check.form-switch {
    display: flex;
    align-items: center;
    padding-left: 0;
    .form-check-input {
        margin-left: 1rem;
        margin-right: 1rem;
    }

    @include media-breakpoint-down(md) {
        flex-direction: column;

        .form-check-input {
            transform: rotate(90deg);
            padding: 20px 0px;
        }

        .switch-text-left,
        .switch-text-right {
            text-align: center;
        }
    }
}

.pointer {
    cursor: pointer;
}
</style>
