<template>
    <div>
        <label :class="labelClass">{{ label }}</label>
        <div class="button-grid colsize-100">
            <base-button
                type="default"
                outline
                :class="{ active: answer === true }"
                @click="yes()"
                >Yes</base-button
            >
            <base-button
                type="default"
                outline
                :class="{ active: answer === false }"
                @click="no()"
                >No</base-button
            >
        </div>
        <b-collapse v-if="collapse" :visible="answer === collapseOn">
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
        collapseOn: {
            type: Boolean,
            default: true
        },
        modelValue: {
            type: Boolean,
            default: null
        }
    },
    data() {
        return {
            answer: null
        };
    },
    methods: {
        yes() {
            this.answer = true;
            this.$emit('update:modelValue', this.answer);
        },
        no() {
            this.answer = false;
            this.$emit('update:modelValue', this.answer);
        }
    },
    beforeMount() {
        this.answer = this.modelValue;
    }
};
</script>

<style></style>
