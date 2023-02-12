<template>
    <div class="fixed-bottom d-flex d-lg-none shadow client-form-utility-bar">
        <div class="container">
            <base-button type="primary" icon="fas fa-bars" @click="toggleNav"></base-button>
            <base-button type="primary" icon="fas fa-tools" @click="toggleWidgets"></base-button>
        </div>
    </div>
</template>

<script>

export default {
    name: 'client-form-utility-bar',
    methods: {
        toggleNav() {
            this.$emit('toggleNav');
        },
        toggleWidgets() {
            this.$emit('toggleWidgets')
        }
    }
}
</script>

<style lang="scss" scoped>
@import '@/vue_sfc.scss';

.client-form-utility-bar {
    background-color: $body-bg;
    padding-top: 8px;
    padding-bottom: 8px;
}
</style>