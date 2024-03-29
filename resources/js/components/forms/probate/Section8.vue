<template>
    <div class="container">
        <ContentBox title="Section 8 - Nil Rate Band Discretionary Trusts">
            <p class="text-gray-500">
                The nil rate band is also called the Inheritance tax threshold.
                It represents the first part of the estate which is taxed at 0%.
            </p>
            <p class="text-gray-500">
                If the deceased was a widow or widower, you have been asked in
                section 3.3 to give details of the estate of the first spouse to
                die. This is necessary to claim both the deceased’s nil-rate
                band plus the nil rate band of the first spouse to die.<br />
                Therefore, up to £650,000 of the estate can pass free of tax,
                but this is not always so.<br />
                If the first spouse to die created a Nil Rate Band Discretionary
                Trust in their Will, the transferrable nil rate band may not be
                available.<br />
                If you have provided a copy of the Will of the first spouse to
                die in response to the questions in 3.3 then details of any
                Trust will be seen.
            </p>
        </ContentBox>

        <ContentBox
            title="8.1 - Nil Rate Band Discretionary relative"
            class="relative"
            v-for="(trust, key) in formData"
            :key="key">
            <a
                class="remove-trustee"
                href="#"
                v-if="formData.length > 1"
                @click.prevent="removeTrustee(key)"
                >Remove Trustee</a
            >
            <p class="text-gray-500">
                If you know details of any Nil Rate Band Discretionary Trust,
                then please provide the following information:-
            </p>
            <honorific v-model="trust.honorific" />
            <base-input
                label="Forenames"
                placeholder="John"
                v-model="trust.forename"></base-input>
            <base-input
                label="Surname"
                placeholder="Doe"
                v-model="trust.surname"></base-input>

            <yes-no
                class="mb-4"
                :label="trust.query1.query"
                v-model="trust.query1.answer"
                collapse>
                <textarea
                    v-model="trust.query1.onTrue"
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <div class="mb-4">
                <label>{{ trust.query2.query }}</label>
                <BaseSwitch
                    v-model="trust.query2.answer"
                    left-text="The Trustee"
                    label="The trustee’s solicitors or accountants" />
            </div>
            <BCollapse
                :visible="
                    trust.query2.answer ==
                    'The trustee’s solicitors or accountants'
                ">
                <honorific v-model="trust.query2.onTrue.honorific" />
                <base-input
                    label="Forenames"
                    placeholder="John"
                    v-model="trust.query2.onTrue.forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="trust.query2.onTrue.surname"></base-input>
            </BCollapse>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <base-input
                        label="Phone number"
                        placeholder="+44 012345 67890"
                        v-model="trust.phone"></base-input>
                </div>
                <div class="col-12 col-lg-6">
                    <base-input
                        label="Email Address"
                        placeholder="John.doe@doe.co.uk"
                        v-model="trust.email"></base-input>
                </div>
            </div>
        </ContentBox>

        <ContentBox
            title="8.1 - Nil Rate Band Discretionary Trusts"
            v-if="formData.length < 4">
            <div class="text-center">
                <base-button type="default" outline @click="addTrustee"
                    >Add trustee<i class="fas fa-plus ms-3"></i
                ></base-button>
            </div>
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
import BaseSwitch from '@/components/simple/BaseSwitch.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import Honorific from '@/components/forms/form-snippets/Honorific.vue';
import { onBeforeMount, ref } from 'vue';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();

let formData = ref([]);

const addTrustee = () => {
    formData.value.push({
        honorific: '',
        forename: '',
        surname: '',
        query1: {
            query: 'Did the deceased have any charge/debit arrangements with this trustee?',
            answer: null,
            onTrue: ''
        },
        query2: {
            query: 'Select dependent on which contact details you know:',
            answer: 'The Trustee',
            onTrue: {
                honorific: '',
                forename: '',
                surname: ''
            }
        },
        phone: '',
        email: ''
    });
};
const removeTrustee = (i) => {
    formData.value.splice(i, 1);
};

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
    routerSectionParam: 'nil-rate-band',
    navIcon: 'po-icon-pound',
    navLabel: 'Nil-Rate band',
    order: 9
};
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.relative {
    position: relative;
}

.remove-trustee {
    position: absolute;
    top: 40px;

    @include media-breakpoint-down(sm) {
        top: 5px;
    }
}
</style>
