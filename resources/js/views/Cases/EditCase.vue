<template>
    <div class="container">
        <Transition>
            <component :is="activeSection" />
        </Transition>
    </div>
</template>
<script setup>
import * as probateSections from '@/components/forms/probate.js';
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import { useCaseStore } from '@/stores/case';

const route = useRoute();
const props = defineProps({
    id: Number,
    section: String
});
const caseStore = useCaseStore();

const activeSection = computed(() => {
    if (caseStore.caseType === 'probate') {
        let sections = Object.keys(probateSections);
        for (let i = 0; i < sections.length; i++) {
            if (
                route.params.section ===
                probateSections[sections[i]].routerSectionParam
            ) {
                return probateSections[sections[i]];
            }
        }
    }
});
</script>
<style scoped lang="scss">
@import '@sass/vue_sfc.scss';

.v-enter-active {
    transition: $transition-base;
    transition-property: opacity;
    transition-duration: 1s;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
