<template>
    <div class="accordion-tabs">
        <template v-for="(tab, i) in tabs">
            <BaseButton
                :class="{ active: activeTab == i }"
                type="default"
                outline
                class="d-block mb-2 accordion-toggle"
                @click="setActiveTab(i)"
                >{{ i + 1 }} {{ toggleKey ? '-' : '' }}
                {{ tab[toggleKey] }}</BaseButton
            >
            <BCollapse ref="tabPanels">
                <Card shadow class="mb-2 relative">
                    <slot :name="`tab${i}`"></slot>
                </Card>
            </BCollapse>
        </template>
    </div>
</template>

<script setup>
import Card from '@/components/simple/Card.vue';
import BCollapse from '@/components/simple/BCollapse.vue';
import BaseButton from '@/components/simple/BaseButton.vue';
import { ref } from 'vue';
const props = defineProps({
    tabs: Array,
    toggleKey: {
        type: String,
        description: 'The property to show on the toggle tab button'
    }
});

const activeTab = ref(null);
const tabPanels = ref(null);

const setActiveTab = (i) => {
    if (activeTab.value == i) {
        tabPanels.value[i].hide();
        activeTab.value = null;
    } else {
        activeTab.value = i;
        tabPanels.value.forEach((x) => x.hide());
        tabPanels.value[i].show();
    }
};
const slotName = (i) => {
    return `tab${i}`;
};
defineExpose({ slotName });
</script>

<style lang="scss" scoped>
.accordion-tabs {
    .accordion-toggle {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
    }
}
</style>
