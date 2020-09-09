<template>
    <div v-if="!invert">
        <label>{{label}}</label>
        <div class="button-grid colsize-100">
            <base-button 
                type="default" 
                outline 
                :class="{'active': answer === true}" 
                @click="yes()">Yes</base-button>
            <base-button 
                type="default" 
                outline 
                :class="{'active': answer === false}" 
                @click="no()">No</base-button>
        </div>
        <b-collapse v-if="collapse" :visible="answer === collapseOn">
            <slot></slot>
        </b-collapse>
    </div>
    <div v-else>
        <label>{{label}}</label>
        <div class="button-grid colsize-100">
            <base-button 
                type="default" 
                outline 
                :class="{'active': answer === false}" 
                @click="no()">Yes</base-button>
            <base-button 
                type="default" 
                outline 
                :class="{'active': answer === true}" 
                @click="yes()">No</base-button>
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
        collapse: {
            type: Boolean,
            default: false
        },
        collapseOn: {
            type: Boolean,
            default: true
        },
        value: {
            type: Boolean,
            default: null
        },
        invert: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            answer: null
        }
    },
    methods: {
        yes() {
            this.answer = true;
            this.$emit('input', this.invert ? !this.answer : this.answer);
        },
        no() {
            this.answer = false;
            this.$emit('input', this.invert ? !this.answer : this.answer);
        }
    },
    beforeMount() {
        this.answer = this.value;
    }
}
</script>

<style>

</style>