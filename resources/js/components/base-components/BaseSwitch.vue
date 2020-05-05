<template>
    <div class="baseSwitch">
        <span v-if="offText" class="pointer" :class="{'text-gray-500': checked}" @click="checked = false">{{offText}}</span>
        <b-form-checkbox v-model="checked" name="check-button" switch class="mx-2" />
        <span v-if="onText" class="pointer" :class="{'text-gray-500': !checked}" @click="checked = true">{{onText}}</span>
    </div>
</template>

<script>
import { BFormCheckbox } from 'bootstrap-vue';
export default {
    name: 'BaseSwitch',
    components: {
        BFormCheckbox
    },
    props: {
        offText: {
            type: String,
            default: ''
        },
        onText: {
            type: String,
            default: ''
        },
        value: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            checked: false
        }
    },
    watch: {
        checked(newVal, oldVal) {
            this.$emit('input', newVal);
        }
    },
    beforeMount() {
        this.checked = this.value;
    }
}
</script>

<style lang="scss">
@import '~@/_variables.scss'; 

.custom-switch {
    display: inline-block;
    padding-left: 50px;
}

.custom-switch .custom-control-label::before {
    width: 50px;
    border-color: $gray-400;
    left: -50px;
}
.custom-switch .custom-control-label::after {
    background-color: $primary;
    left: -48px;
}
.custom-control-input:checked ~ .custom-control-label::before {
    background-color: $white;
    border-color: $gray-400;
}
.custom-switch .custom-control-input:checked ~ .custom-control-label::after {
    background-color: $primary;
    transform: translateX(34px);
}
</style>