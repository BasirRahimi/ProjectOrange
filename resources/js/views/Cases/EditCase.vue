<template>
    <div class="container">
        <Transition>
            <component :is="activeSection" />
        </Transition>
    </div>
</template>
<script setup>
import AboutTheDeceased from '@/components/forms/probate/AboutTheDeceased.vue';
import Executors from '@/components/forms/probate/Executors.vue';
import { computed, ref, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const props = defineProps({
    id: Number,
    section: String
});

// Watch Route and update section variable or use route inside computed?
const sectionCopy = ref(props.section);
watch(route, (newRoute) => {
    if (newRoute.params.section) {
        sectionCopy.value = newRoute.params.section;
    }
});

const activeSection = computed(() => {
    switch (route.params.section) {
        case 'about-the-deceased':
            return AboutTheDeceased;
        case 'executors':
            return Executors;
    }
});
</script>
