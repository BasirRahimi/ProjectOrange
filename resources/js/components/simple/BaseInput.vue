<template>
    <div
        :class="[
            { 'mb-4': mb4 },
            { 'input-group': hasIcon },
            { 'has-danger': error },
            { focused: focused },
            { 'input-group-alternative': alternative },
            { 'has-success': valid === true },
            { 'has-danger': valid === false }
        ]">
        <slot name="label">
            <label v-if="label" :class="labelClasses">
                {{ label }}
                <span v-if="required">*</span>
            </label>
        </slot>

        <span
            v-if="addonLeftIcon || $slots.addonLeft"
            class="input-group-text"
            :class="addonLeftClasses">
            <slot name="addonLeft">
                <i :class="addonLeftIcon"></i>
            </slot>
        </span>
        <slot v-bind="slotData">
            <input
                :value="modelValue"
                v-on="listeners"
                v-bind="$attrs"
                class="form-control"
                :class="[
                    { 'is-valid': valid === true },
                    { 'is-invalid': valid === false },
                    inputClasses
                ]"
                aria-describedby="addon-right addon-left" />
        </slot>
        <component
            is="button"
            v-if="addonRightIcon || $slots.addonRight"
            class="input-group-text"
            :class="addonRightClasses">
            <slot name="addonRight">
                <i :class="addonRightIcon"></i>
            </slot>
        </component>
        <slot name="infoBlock"></slot>
        <slot name="helpBlock">
            <div
                class="text-danger invalid-feedback"
                style="display: block"
                :class="{ 'mt-2': hasIcon }"
                v-if="error">
                {{ error }}
            </div>
        </slot>
    </div>
</template>
<script>
export default {
    inheritAttrs: false,
    name: 'base-input',
    props: {
        required: {
            type: Boolean,
            description: 'Whether input is required (adds an asterix *)'
        },
        valid: {
            type: Boolean,
            description: 'Whether is valid',
            default: undefined
        },
        alternative: {
            type: Boolean,
            description: 'Whether input is of alternative layout'
        },
        label: {
            type: String,
            description: 'Input label (text before input)'
        },
        error: {
            type: String,
            description: 'Input error (below input)'
        },
        labelClasses: {
            type: String,
            description: 'Input label css classes'
        },
        inputClasses: {
            type: String,
            description: 'Input css classes'
        },
        modelValue: {
            type: [String, Number],
            description: 'Input value'
        },
        addonRightIcon: {
            type: String,
            description: 'Addon right icon'
        },
        addonLeftIcon: {
            type: String,
            description: 'Addont left icon'
        },
        addonLeftClasses: {
            type: String
        },
        addonRightClasses: { type: String },
        mb4: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            focused: false
        };
    },
    computed: {
        listeners() {
            let fallthroughListeners = [];
            for (let i = 0; i < this.$attrs.length; i++) {
                if (typeof this.$attrs[i] === 'function') {
                    fallthroughListeners.push(this.$attrs[i]);
                }
            }
            return {
                ...fallthroughListeners,
                input: this.updateValue,
                focus: this.onFocus,
                blur: this.onBlur
            };
        },
        slotData() {
            return {
                focused: this.focused,
                ...this.listeners
            };
        },
        hasIcon() {
            const { addonRight, addonLeft } = this.$slots;
            return (
                addonRight !== undefined ||
                addonLeft !== undefined ||
                this.addonRightIcon !== undefined ||
                this.addonLeftIcon !== undefined
            );
        }
    },
    methods: {
        updateValue(evt) {
            let value = evt.target.value;
            this.$emit('update:modelValue', value);
        },
        onFocus(value) {
            this.focused = true;
            this.$emit('focus', value);
        },
        onBlur(value) {
            this.focused = false;
            this.$emit('blur', value);
        }
    }
};
</script>
<style lang="scss" scoped>
.input-group-text {
    &.btn {
        background-color: var(--bs-btn-bg);
        color: var(--bs-btn-color);
        border-color: var(--bs-btn-border-color);
    }
}
</style>
