<template>
    <Swiper>
        <template v-for="(slide, i) in slides">
            <SwiperSlide><slot :name="`slide${i}`"></slot></SwiperSlide>
        </template>
    </Swiper>
</template>

<script setup>
import { Swiper, SwiperSlide, useSwiper } from 'swiper/vue';
import 'swiper/css';
import { onMounted } from 'vue';

const props = defineProps({
    slides: Array
});

const swiperInstance = useSwiper();

onMounted(() => {
    console.log(swiperInstance.value);
});

const nextSlide = () => {
    swiperInstance.value.slideNext();
};
const prevSlide = () => {
    swiperInstance.value.slidePrev();
};
const activeIndex = swiperInstance.value.activeIndex;
defineExpose({ nextSlide, prevSlide, activeIndex });
</script>
