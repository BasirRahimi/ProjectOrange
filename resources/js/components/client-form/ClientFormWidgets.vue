<template>
    <div class="widgets-container" :class="{ show: !hidden }">
        <required-docs class="mb-4"></required-docs>
        <tools></tools>
    </div>
</template>

<script>
import clientEB from '@@/clientEB.js';

import RequiredDocs from './widgets/RequiredDocs.vue';
import Tools from './widgets/Tools.vue';
export default {
    name: 'ClientFormWidgets',
    components: {
        RequiredDocs,
        Tools
    },
    data() {
        return {
            hidden: false
        }
    },
    mounted() {
        let _self = this;

        if (window.innerWidth < 992) {
            _self.hidden = true;
        }

        clientEB.$on('toggle-widgets', () => {
            _self.hidden = !_self.hidden;
        });
    }
}
</script>

<style lang="scss" scoped>
@import '@/argon/vue_sfc.scss';

.widgets-container {
    position: fixed;
    top: 65px;
    right: -380px;
    padding-top: 64px;
    padding-bottom: 50px;
    padding-right: 35px;
    padding-left: 35px;
    width: 450px;
    max-width: 100%;
    height: calc(100% - 68px);
    overflow-y: scroll;
    z-index: 1;
    transition: .25s;

    &::-webkit-scrollbar {
        width: 0;
    }

    @include media-breakpoint-down(md) {
        right: -428px;
        padding-right: 16px;
        padding-left: 16px;
        width: 412px;
        padding-top: 30px;
        padding-bottom: 30px;
        top: 42px;
        height: calc(100% - 96px);

        &.show {
            right: 0;
        }
    }

    @include media-breakpoint-down(xl) {
        &:hover {
            right: 0px;
        }
    }

    @include media-breakpoint-up(lg) {
        display: block;
    }

    @include media-breakpoint-up(xxl) {
        padding-right: 0px;
        @include fluid-property-vw(4px, 992px, 1862px, 3840px, 'right');
        @include fluid-property-vw(226px, 400px, 1500px, 1862px, 'width');
    }

}
</style>