<template>
    <div>
        <ContentBox class="text-center" title="Welcome to a new case">
            <p class="mb-0 text-gray-500">
                Let’s get you started with a new case. First thing’s first,
                let’s get this case opened with some basic details
            </p>
            <!-- <BaseButton
                    icon="po-icon-person"
                    outline
                    class="w-100"
                    :class="{ active: caseStore.caseType === 'succession' }">
                    Succession Case
                    <i class="fa-solid fa-arrow-right ms-auto"></i>
                </BaseButton>
                <BaseButton
                    icon="po-icon-person"
                    outline
                    class="w-100"
                    :class="{ active: caseStore.caseType === 'probate' }"
                    >Probate Case <i class="fa-solid fa-arrow-right"></i
                ></BaseButton> -->
        </ContentBox>
        <ContentBox>
            <template #title>
                Name this
                <span class="text-capitalize text-primary">{{
                    caseStore.caseType
                }}</span>
                case
            </template>
            <p class="fw-bold">What do you want this case to be called?</p>
            <p class="text-gray-500">
                We recommend sticking to the name of the deceased, but we
                recommend anything that’s best for you & your team to remember.
            </p>
            <BaseInput v-model="caseName" placeholder="John Doe"></BaseInput>
        </ContentBox>

        <div class="d-flex justify-content-end">
            <BaseButton type="primary" outline @click="createNewCase"
                >Open Case <i class="fa-solid fa-arrow-right ms-auto"></i
            ></BaseButton>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useCaseStore } from '@/stores/case';
import ContentBox from '@/components/simple/ContentBox.vue';
import BaseButton from '@/components/simple/BaseButton.vue';
import BaseInput from '@/components/simple/BaseInput.vue';

const caseStore = useCaseStore();
const caseName = ref('');

const openCase = (id) => {
    caseStore.openCase(id);
};

const createNewCase = async () => {
    if (!caseName.value.length) return;
    let response = await axios.post(`/api/cases/${caseStore.caseType}`, {
        'case-name': caseName.value
    });
    openCase(response.data.id);
};
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';
</style>
