<template>
    <div class="container">
        <ContentBox>
            <h2>What type of case is this?</h2>
            <BaseButton
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
            ></BaseButton>
        </ContentBox>
        <ContentBox>
            <h2>
                Name this
                <span class="text-capitalize">{{ caseStore.caseType }}</span>
                case
            </h2>
            What do you want this case to be called?
            <div class="text-muted">
                We recommend sticking to the name of the deceased, but we
                recommend anything that's best for you & your team to remember.
            </div>
            <BaseInput v-model="caseName"></BaseInput>
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
import { ref, onMounted, computed, watch } from 'vue';
import { useCaseStore } from '@/stores/case';
import { useRouter } from 'vue-router';
import ContentBox from '@/components/simple/ContentBox.vue';
import BaseButton from '@/components/simple/BaseButton.vue';
import BaseInput from '@/components/simple/BaseInput.vue';

const router = useRouter();
const caseStore = useCaseStore();
const caseName = ref('');

onMounted(async () => {});

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
