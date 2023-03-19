<template>
    <div class="container">
        <ContentBox
            title="Section 6 - England & Wales and the rest of the UK and British Isles">
            <div class="mb-3">
                <BCollapse toggle-button>
                    <p class="text-gray-500 mt-2 mb-0">
                        Certain investments can be placed with investment
                        institutions in these jurisdictions. They each have
                        separate legal systems and you may be required to apply
                        for a similar Grant of Probate there.
                    </p>
                </BCollapse>
            </div>
            <div>
                <BCollapse toggle-button>
                    <p class="text-gray-500 mt-2 mb-0">
                        You should take care that the deceased had regularised
                        their affairs with HMRC. For example, the Jersey
                        Disclosure Facility provides for a voluntary disclosure
                        facility to UK residents from 6 April 2013 to 30
                        September 2016 for UK residents with a beneficial
                        interest in Jersey “relevant property”, with undisclosed
                        UK tax liabilities, with a chance to regularise their UK
                        tax affairs in a controlled manner on beneficial terms.
                    </p>
                </BCollapse>
            </div>
        </ContentBox>

        <ContentBox
            title="6.1 - England & Wales and the rest of the UK and British Isles">
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
import BCollapse from '@/components/simple/BCollapse.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { onBeforeMount, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();

let formData = ref([
    {
        query: 'Did the deceased have any assets in Jersey?',
        answer: null,
        onTrue: ''
    },
    {
        query: 'Did the deceased have any assets in Guernsey?',
        answer: null,
        onTrue: ''
    },
    {
        query: 'Did the deceased have any assets in Isle of Man?',
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
    routerSectionParam: 'uk-and-british-isles',
    navIcon: 'po-icon-flag',
    navLabel: 'UK & British Isles',
    order: 7
};
</script>
<style lang="scss" scoped></style>
