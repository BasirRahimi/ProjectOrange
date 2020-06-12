<template>
    <div class="switch-with-text">
        <div class="switch-text-left" :class="{'text-gray-500':checked}">{{leftText}}</div>
        <div class="the-switch"><base-switch coloured v-model="checked" class="m-0 mx-3 d-block"></base-switch></div>
        <div class="switch-text-right" :class="{'text-gray-500':!checked}">{{rightText}}</div>
    </div>
</template>

<script>
export default {
    name: 'switch-with-text',
    props: {
        value: {
            type: Boolean,
            default: false
        },
        leftText: {
            type: String
        },
        rightText: {
            type: String
        }
    },
    data() {
        return {
            checked: false
        }
    },
    beforeMount() {
        this.checked = this.value;
    },
    watch: {
        checked(val) {
            this.$emit('input', val);
        }
    }
}
</script>

<style scoped lang="scss">
@import '~@/argon/vue_sfc.scss';

.switch-with-text {
    display: flex;
    align-items: center;
    @include media-breakpoint-down(xs) {
        flex-direction: column;
        .the-switch {
            transform: rotate(90deg);
            padding: 20px 0px;
        }
        .switch-text-left,
        .switch-text-right {
            text-align: center;
        }
    }
}
</style>