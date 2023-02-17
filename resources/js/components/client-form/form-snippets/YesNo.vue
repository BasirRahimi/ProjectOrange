<template>
    <div>
        <label :class="labelClass">{{ label }}</label>
        <div class="button-grid colsize-100">
            <base-button
                type="default"
                outline
                :class="{ active: modelValue === true }"
                @click="yes()"
                >Yes</base-button
            >
            <base-button
                type="default"
                outline
                :class="{ active: modelValue === false }"
                @click="no()"
                >No</base-button
            >
        </div>
        <b-collapse
            v-if="collapse"
            ref="collapse1"
            :visible="openOn === modelValue">
            <slot></slot>
        </b-collapse>
    </div>
</template>

<script>
export default {
    name: 'YesNo',
    props: {
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
    },
    methods: {
        yes() {
            this.openOn
                ? this.$refs.collapse1.show()
                : this.$refs.collapse1.hide();
            this.$emit('update:modelValue', true);
        },
        no() {
            this.openOn
                ? this.$refs.collapse1.hide()
                : this.$refs.collapse1.show();
            this.$emit('update:modelValue', false);
        }
    }
};
</script>

<style></style>
