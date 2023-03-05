<template>
    <div>
        <div class="search mb-4 d-flex">
            <BaseInput
                wrapperClasses="shadow me-3"
                class="border-0 p-2"
                placeholder="Search for a case..."
                addonLeftIcon="fa-solid fa-magnifying-glass"
                :mb-4="false"
                v-model="searchText" />
        </div>
        <div class="d-flex flex-wrap mb-5">
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >All</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >Will Writing</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >KYC</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >Power of Attorney</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >Executorship</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >Filter Here</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >Inheritance</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >Probate</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >Document</BaseButton
            >
            <BaseButton
                class="me-4 mb-4 shadow border-0 flex-grow-1"
                type="white"
                >Document Name</BaseButton
            >
        </div>
        <div class="row">
            <div class="col-lg-4 mb-4" v-for="x in 6">
                <Card>
                    <p class="fs-5 mb-1"><b>KYC Document 1</b></p>
                    <p class="text-gray-500">Last updated on 07/07/23</p>
                    <p class="text-gray-500 fw-light">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                    <BaseButton
                        type="white"
                        class="border px-3"
                        tag="a"
                        href="#">
                        <i class="fa-solid fa-download"></i>
                    </BaseButton>
                </Card>
            </div>
        </div>
    </div>
</template>
<script setup>
import BaseButton from '@/components/simple/BaseButton.vue';
import Card from '@/components/simple/Card.vue';
import { ref } from 'vue';

const searchText = ref('');
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.desk {
    padding: 6rem;
}

.search :deep(.input-group-text) {
    font-size: 1.1rem;
    color: $primary;
    background-color: $white;
    border: 0;

    i {
        transform: rotateY(180deg);
    }
}

.btn.btn-white {
    color: $gray-500;
    &:hover {
        background-color: $primary;
        color: $white;
    }
}
</style>
