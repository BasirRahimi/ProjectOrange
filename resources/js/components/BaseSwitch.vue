<template>
    <label class="custom-toggle" :class="{'coloured-dot':coloured}">
        <input type="checkbox"
               :value="value"
               v-bind="$attrs"
               v-on="inputListeners"
               ref="checkbox">
        <span class="custom-toggle-slider rounded-circle"></span>
    </label>
</template>
<script>
export default {
    name: "base-switch",
    inheritAttrs: false,
    props: {
        value: {
            type: Boolean,
            default: false,
            description: "Switch value"
        },
        coloured: {
            type: Boolean,
            default: false,
            description: "coloured when in off state"
        }
    },
    computed: {
        inputListeners() {
            var _self = this;
            // `Object.assign` merges objects together to form a new object
            return Object.assign({},
                // We add all the listeners from the parent
                this.$listeners,
                // Then we can add custom listeners or override the
                // behavior of some listeners.
                {
                    // This ensures that the component works with v-model
                    input(event) {
                        _self.$emit('input', event.target.value == 'false')
                    }
                }
            )
        },
        // model: {
        // get() {
        //     if(typeof this.value == 'boolean'){

        //         return this.value;
        //     }
        // },
        // set(value) {
        //     this.$emit("input", value);
        // }
        // }
    },
    mounted() {
        this.$nextTick(()=>{
            if(this.value) {
                this.$refs.checkbox.checked = true;
            }
        });
    }
};
</script>
<style>
</style>
