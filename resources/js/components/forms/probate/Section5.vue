<template>
    <div class="container">
        <ContentBox title="Section 5 - Gifts with reservation of benefit">
            <p class="text-gray-500">
                There is established anti-avoidance legislation which removes
                any tax advantage if a person has given away an asset but
                retained an interest in it. An example of this is where a parent
                might transfer the title of their home to a son or daughter but
                remain in occupation of it after the transfer takes place. This
                is known as a ‘gift with reservation of benefit’ (GWRoB) and
                Executors have a duty to make fullest enquiries and make full
                disclosure to HMRC.
            </p>
            <p class="text-gray-500">
                It does not matter whether seven-years have elapsed since the
                original transfer of the title.
            </p>
        </ContentBox>

        <ContentBox title="5.1 Anti-avoidance legislation">
            <yes-no
                :label="formData[0].query"
                v-model="formData[0].answer"
                collapse>
                <textarea
                    v-model="formData[0].onTrue"
                    class="form-control mt-3"
                    rows="4"
                    placeholder="We shall review this information and ask for further details as appropriate to ensure you make full disclosure to HMRC."></textarea>
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
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import { ref, onBeforeMount } from 'vue';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();
let formData = ref([
    {
        query: 'Did the deceased transfer any assets to any individual, trust, company or other organisation during their lifetime where the recipient did not take full possession of them?',
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
    routerSectionParam: 'gifts',
    navIcon: 'fas fa-gifts',
    navLabel: 'Gifts',
    order: 6
};
</script>
<style lang="scss" scoped></style>
