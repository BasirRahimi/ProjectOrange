<template>
    <div class="widgets-container">
        <RequiredDocs class="mb-4" />
        <Tools />
    </div>
</template>

<script setup>
import RequiredDocs from './widgets/RequiredDocs.vue';
import Tools from './widgets/Tools.vue';
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.widgets-container {
    position: fixed;
    top: 60px;
    right: -380px;
    padding-top: 60px;
    padding-bottom: 50px;
    padding-right: 35px;
    padding-left: 35px;
    width: 450px;
    max-width: 100%;
    height: calc(100% - 68px);
    overflow-y: scroll;
    z-index: 1;
    transition: 0.25s;

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
        right: 10px;
    }
}
</style>
