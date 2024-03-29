<template>
    <div class="container">
        <ContentBox title="Section 12 - Pensions">
            <p class="text-gray-500 m-0">
                If the deceased received, or had made provision for, a pension
                or benefit from an employer or under a personal pension policy
                (other than the State Pension) you are required to submit
                details to HMRC.
            </p>
        </ContentBox>

        <ContentBox title="12.1 Pension Details">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer">
                <base-input
                    labelClasses="mt-4"
                    label="Name of pension scheme or title of pension policy"
                    placeholder="Personal pension programme"
                    v-model="formData[0].onTrue.name_of_pension"></base-input>

                <label>Please describe the pension</label>
                <textarea
                    v-model="formData[0].onTrue.description"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>

                <label>Contact details of the scheme administrators </label>
                <honorific v-model="formData[0].onTrue.honorific" />
                <base-input
                    label="Company name"
                    placeholder="Appleseed Holdings"
                    v-model="formData[0].onTrue.company_name"></base-input>
                <base-input
                    label="Forenames"
                    placeholder="John"
                    v-model="formData[0].onTrue.forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="formData[0].onTrue.surname"></base-input>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890"
                            v-model="formData[0].onTrue.phone"></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk"
                            v-model="formData[0].onTrue.email"></base-input>
                    </div>
                </div>
            </yes-no>
        </ContentBox>

        <ContentBox title="12.2 Pension Payment">
            <yes-no
                collapse
                :label="formData[1].query"
                v-model="formData[1].answer">
                <base-input
                    labelClasses="mt-4"
                    label="Name of pension scheme or title of pension policy"
                    placeholder="Personal pension programme"
                    v-model="formData[1].onTrue.name_of_pension"></base-input>

                <label>Please describe the pension</label>
                <textarea
                    v-model="formData[1].onTrue.description"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="What is the value of the lump sum?"
                    placeholder="£300,000"
                    type="number"
                    min="0"
                    v-model="formData[1].onTrue.value"></base-input>
            </yes-no>
        </ContentBox>

        <ContentBox title="12.3 Pension Payment">
            <yes-no
                collapse
                :label="formData[2].query"
                v-model="formData[2].answer">
                <base-input
                    labelClasses="mt-4"
                    label="Name of pension scheme or title of pension policy"
                    placeholder="Personal pension programme"
                    v-model="formData[2].onTrue.name_of_pension"></base-input>

                <label>Please describe the pension</label>
                <textarea
                    v-model="formData[2].onTrue.description"
                    class="form-control mb-4"
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
import Honorific from '@/components/forms/form-snippets/Honorific.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { ref, onBeforeMount } from 'vue';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();
let formData = ref([
    {
        query: 'Other than small arrears of pension due to the date of death, did any payments under a pension scheme or personal pension policy continue after the death of the deceased?',
        answer: null,
        onTrue: {
            name_of_pension: '',
            description: '',
            honorific: '',
            company_name: '',
            forename: '',
            surname: '',
            phone: '',
            email: ''
        }
    },
    {
        query: 'Was a lump sum payable under the scheme as a result of the death of the deceased?',
        answer: null,
        onTrue: {
            name_of_pension: '',
            description: '',
            value: ''
        }
    },
    {
        query: 'Did the deceased, within two-years of their death, transfer or dispose of any benefits payable under a pension scheme or person pension policy?',
        answer: null,
        onTrue: {
            name_of_pension: '',
            description: ''
        }
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
    routerSectionParam: 'pensions',
    navIcon: 'po-icon-piggybank',
    navLabel: 'Pensions',
    order: 13
};
</script>
<style lang="scss" scoped></style>
