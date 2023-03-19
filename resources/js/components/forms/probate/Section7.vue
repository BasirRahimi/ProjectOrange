<template>
    <div class="container">
        <ContentBox title="Section 7 - Swiss and assets in other ‘tax havens’">
        </ContentBox>

        <ContentBox title="7.1 Swiss and assets in other ‘tax havens’">
            <yes-no
                v-for="(row, i) in formData"
                :key="i"
                class="mb-4"
                :label="row.query"
                v-model="row.answer"
                collapse>
                <textarea
                    v-model="row.onTrue"
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="nextSection">
                Next section
            </button>
        </ContentBox>
    </div>
</template>

<script setup>
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { onBeforeMount, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();

let formData = ref([
    {
        query: 'Did the deceased have any assets in Switzerland?',
        answer: null,
        onTrue: ''
    },
    {
        query: 'Did the deceased have any assets in a tax haven?',
        answer: null,
        onTrue: ''
    }
]);
const nextSection = async () => {
    let response = await store.saveCaseData(formData.value);
    if (response.status === 200) {
        store.nextSection();
    }
};

onBeforeMount(async () => {
    let response = await store.fetchCaseData();
    if (response) {
        formData.value = response;
    }
});
</script>
<script>
// URL route for :section parameter

export default {
    routerSectionParam: 'tax-havens',
    navIcon: 'po-icon-world',
    navLabel: 'Tax Havens',
    order: 8
};
</script>
<style lang="scss" scoped></style>
