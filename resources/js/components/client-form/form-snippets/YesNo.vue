<template>
    <div>
        <label>{{label}}</label><br />
        <button class="btn btn-outline-secondary active-primary mr-3" :class="{'active': answer === true}" @click="yes()">Yes</button>
        <button class="btn btn-outline-secondary active-primary mr-3" :class="{'active': answer === false}" @click="no()">No</button>
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
            this.$emit('input', this.answer);
        },
        no() {
            this.answer = false;
            this.$emit('input', this.answer);
        }
    },
    beforeMount() {
        this.answer = this.value;
    }
}
</script>

<style>

</style>