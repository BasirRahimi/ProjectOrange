<template>
    <div
        class="custom-control custom-radio"
        :class="[inlineClass, { disabled: disabled }]">
        <input
            :id="cbId"
            class="custom-control-input"
            type="radio"
            :disabled="disabled"
            :value="name"
            v-model="model" />
        <label :for="cbId" class="custom-control-label">
            <slot></slot>
        </label>
    </div>
</template>
<script>
import { randomString } from '@/composables/helper.js';
export default {
    name: 'base-radio',
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
            set(value) {
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
.custom-radio {
    position: relative;
    display: block;
    min-height: 1.5rem;
    padding-left: 1.75rem;
    .custom-control-label::before {
        border-radius: 50%;
        border: 1px solid $input-border-color;
        transition: $input-transition;
        position: absolute;
        top: 0.125rem;
        left: -1.75rem;
        display: block;
        width: 1.25rem;
        height: 1.25rem;
        pointer-events: none;
        content: '';
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        background-color: $white;
    }
    .custom-control-input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
    .custom-control-input ~ .custom-control-label {
        font-weight: normal;
        font-size: 0.875rem;
        cursor: pointer;
        margin-bottom: 0;
        position: relative;
        display: inline-block;
    }
    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: $primary;
        background-color: $primary;
        color: $white;
    }
    .custom-control-input:checked ~ .custom-control-label::after {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3E%3Ccircle r='3' fill='%23fff'/%3E%3C/svg%3E");
    }
    .custom-control-label::after {
        position: absolute;
        top: 0.125rem;
        left: -1.75rem;
        display: block;
        width: 1.25rem;
        height: 1.25rem;
        content: '';
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 50% 50%;
    }
}

.form-check-inline {
    display: inline-flex;
}
</style>
