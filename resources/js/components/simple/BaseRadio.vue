<template>
    <div class="form-check" :class="[inlineClass, { disabled: disabled }]">
        <!-- custom-control-input -->
        <input
            :id="cbId"
            class="form-check-input"
            type="radio"
            :disabled="disabled"
            :name="name"
            v-model="model"
            v-bind="$attrs" />
        <!-- custom-control-label -->
        <label :for="cbId" class="form-check-label">
            <slot></slot>
        </label>
    </div>
</template>
<script>
import { randomString } from '@/composables/helper.js';
export default {
    name: 'base-radio',
    inheritAttrs: false,
    props: {
        name: {
            type: [String, Number],
            description: 'Radio label'
        },
        disabled: {
            type: Boolean,
            description: 'Whether radio is disabled'
        },
        modelValue: {
            type: [String, Boolean],
            description: 'Radio value'
        },
        inline: {
            type: Boolean,
            description: 'Whether radio is inline'
        }
    },
    data() {
        return {
            cbId: ''
        };
    },
    computed: {
        model: {
            get() {
                return this.modelValue;
            },
            set(value, b, c) {
                this.$emit('update:modelValue', value);
            }
        },
        inlineClass() {
            if (this.inline) {
                return `form-check-inline`;
            }
            return '';
        }
    },
    mounted() {
        this.cbId = randomString();
    }
};
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.form-check {
    --height: 1.8rem;
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    .form-check-input {
        width: var(--height);
        height: var(--height);
        border-radius: var(--bs-border-radius);
        border-color: $input-border-color;
        position: relative;
        margin-top: 0;
        cursor: pointer;
        transition: $input-transition;
        &::before {
            font: var(--fa-font-solid);
            content: '\f00c';
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        &:checked,
        &:hover {
            background-color: var(--bs-primary);
            background-image: none;
        }
    }
    .form-check-label {
        height: var(--height);
        margin-bottom: 0;
        margin-left: 1rem;
        cursor: pointer;
    }
}
</style>
