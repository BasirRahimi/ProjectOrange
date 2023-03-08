<template>
    <div>
        <Card shadow class="mb-4">
            <p><b>Contact</b></p>
            <p class="text-gray-500">
                Please don't hesitate to contact us if you need technical
                support, think something isn't working correctly or even if you
                want to request a feature.
            </p>
        </Card>
        <Card shadow class="mb-4">
            <p><b>Support</b></p>
            <p class="text-gray-500">
                Are you facing an issue or unsure if something is working
                correctly?
            </p>
            <p class="text-gray-500">
                If you need support, send us an e-mail and we'll try and get
                back to you as soon as we can.
            </p>
            <p class="text-gray-500 email">
                E-mail: <a href="mailto:tech@mabain.co.uk">tech@mabain.co.uk</a>
            </p>
        </Card>
        <Card shadow class="mb-4">
            <p><b>Feature request</b></p>
            <p class="text-gray-500">
                If there is anything you would like added or changed that you
                think would be useful, please let us know below:
            </p>
            <p class="text-gray-500 email">
                E-mail: <a href="mailto:tech@mabain.co.uk">tech@mabain.co.uk</a>
            </p>
        </Card>
    </div>
</template>

<script setup>
import Card from '@/components/simple/Card.vue';
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.desk {
    padding: 6rem;
}
.email {
    display: inline-block;
    background-color: $gray-200;
    padding: 0.8rem 0.5rem;
}
</style>
