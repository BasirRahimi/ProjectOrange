<template>
    <div class="container">
        <ContentBox title="Overview"> </ContentBox>
    </div>
</template>

<script setup>
import ContentBox from '@/components/simple/ContentBox.vue';
</script>

<script>
// URL route for :section parameter
export default {
    routerSectionParam: 'overview',
    navIcon: 'fas fa-pen-nib',
    navLabel: 'Overview',
    order: 22
};
</script>

<style></style>
