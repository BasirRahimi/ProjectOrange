<template>
    <div class="desk">
        <div class="row">
            <div class="col-lg-6">
                <Card shadow>
                    <p class="fs-4"><i class="fa-solid fa-play"></i></p>
                    <p class="mb-2"><b>Videos</b></p>
                    <p class="text-gray-500">Lorem ipsum dolor sit amet</p>
                </Card>
            </div>
            <div class="col-lg-6">
                <Card shadow>
                    <p class="fs-4"><i class="fa-solid fa-book-open"></i></p>
                    <p class="mb-2"><b>Videos</b></p>
                    <p class="text-gray-500">Lorem ipsum dolor sit amet</p>
                </Card>
            </div>
        </div>
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
</style>
