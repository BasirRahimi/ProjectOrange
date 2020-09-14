<template>
    <div class="switch-with-text">
        <div class="switch-text-left pointer" :class="{'text-gray-500':checked}" @click="clickSwitch(false)">{{leftText}}</div>
        <div class="the-switch"><base-switch coloured v-model="checked" class="m-0 mx-3 d-block" ref="switch"></base-switch></div>
        <div class="switch-text-right pointer" :class="{'text-gray-500':!checked}" @click="clickSwitch(true)">{{rightText}}</div>
    </div>
</template>

<script>
export default {
    name: 'switch-with-text',
    props: {
        value: {
            type: Boolean | String,
            default: false
        },
        leftText: {
            type: String
        },
        rightText: {
            type: String
        },
        returnText: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            checked: false
        }
    },
    beforeMount() {
        if(this.returnText) {
            if(this.rightText === this.value) {
                this.checked = true;
            }
        } else {
            this.checked = this.value;
        }
    },
    watch: {
        checked(val) {
            let data = val;
            if(this.returnText) {
                if(val) {
                    data = this.rightText;
                } else {
                    data = this.leftText;
                }
            } 
            
            this.$emit('input', data);
        }
    },
    methods: {
        clickSwitch(val) {
            if(this.checked !== val) {
                this.$refs.switch.$el.click();
            }
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

.pointer {
    cursor: pointer;
}
</style>