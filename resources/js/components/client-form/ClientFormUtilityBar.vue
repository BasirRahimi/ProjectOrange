<template>
    <div class="fixed-bottom d-flex d-lg-none shadow client-form-utility-bar">
        <div class="container">
            <base-button type="primary" icon="fas fa-bars" @click="toggleNav"></base-button>
            <base-button type="primary" icon="fas fa-tools" @click="toggleWidgets"></base-button>
        </div>
    </div>
</template>

<script>
import clientEB from '@@/clientEB.js';

export default {
    name: 'client-form-utility-bar',
    methods: {
        toggleNav() {
            clientEB.$emit('toggle-nav');
        },
        toggleWidgets() {
            clientEB.$emit('toggle-widgets')
        }
    }
}
</script>

<style lang="scss" scoped>
@import '@/argon/vue_sfc.scss';

.client-form-utility-bar {
    background-color: $body-bg;
    padding-top: 8px;
    padding-bottom: 8px;
}
</style>