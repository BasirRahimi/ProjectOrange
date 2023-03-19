<template>
    <div class="container">
        <ContentBox title="Section 3 - Other Information">
            <yes-no
                class="mb-4"
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer">
                <client-file-upload
                    class="mt-3"
                    v-model="formData[0].document" />
            </yes-no>
            <yes-no
                class="mb-4"
                collapse
                :label="formData[1].query"
                v-model="formData[1].answer">
                <client-file-upload
                    class="mt-3"
                    v-model="formData[1].document" />
            </yes-no>

            <BCollapse toggle-button>
                <p class="text-gray-500 mt-2">
                    If you hold the original Will (and any codicils), nothing
                    should be pinned, clipped or fastened to it at any time.
                </p>
            </BCollapse>
        </ContentBox>

        <ContentBox title="3.2 The Will (‘Foreign Wills’)">
            <yes-no
                collapse
                :label="formData[2].query"
                v-model="formData[2].answer">
                <yes-no
                    class="mt-4"
                    collapse
                    :label="formData[2].onTrue.query"
                    v-model="formData[2].onTrue.answer">
                    <honorific
                        v-model="formData[2].onTrue.onTrue.honorific"
                        class="mt-4" />
                    <base-input
                        label="Forenames"
                        placeholder="John"
                        v-model="
                            formData[2].onTrue.onTrue.forename
                        "></base-input>
                    <base-input
                        label="Surname"
                        placeholder="Doe"
                        v-model="
                            formData[2].onTrue.onTrue.surname
                        "></base-input>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <base-input
                                label="Phone number"
                                placeholder="+44 012345 67890"
                                v-model="
                                    formData[2].onTrue.onTrue.phone
                                "></base-input>
                        </div>
                        <div class="col-12 col-lg-6">
                            <base-input
                                label="Email Address"
                                placeholder="John.doe@doe.co.uk"
                                :mb-4="false"
                                v-model="
                                    formData[2].onTrue.onTrue.email
                                "></base-input>
                        </div>
                    </div>
                </yes-no>
            </yes-no>
        </ContentBox>

        <ContentBox title="3.3 If the deceased was a widow or widower">
            <yes-no
                collapse
                :label="formData[3].query"
                v-model="formData[3].answer">
                <label class="my-4"
                    >Please add the following details of the spouse who died
                    first:</label
                >
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <label>Date of death</label>
                        <datepicker
                            class="form-control bg-white"
                            v-model="formData[3].onTrue.date_of_death"
                            placeholder="Date"
                            format="dd / MM / yy"
                            :upper-limit="new Date()"></datepicker>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <label>Date of marriage</label>
                        <datepicker
                            class="form-control bg-white"
                            v-model="formData[3].onTrue.date_of_marriage"
                            placeholder="Date"
                            format="dd / MM / yy"
                            :upper-limit="new Date()"></datepicker>
                    </div>
                </div>
                <base-input
                    label="Forenames"
                    placeholder="John"
                    v-model="formData[3].onTrue.forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="formData[3].onTrue.surname"></base-input>

                <label
                    >Please attach the following documents related to the first
                    spouse:</label
                >
                <p class="text-gray-500 mb-3">
                    It may be the case that a Grant of Probate/Letters of
                    Administration was not applied for.
                </p>

                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">
                        A marriage certificate
                    </div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[3].onTrue.marriage_cert" />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">
                        Death certificate
                    </div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[3].onTrue.death_cert" />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">
                        Copy of Will
                    </div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[3].onTrue.will" />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">
                        Copy of Codicil(s)
                    </div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[3].onTrue.condicils" />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">
                        Grant of Representation
                    </div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[3].onTrue.grant_of_probate" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">
                        Estate accounts
                    </div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[3].onTrue.estate_accounts" />
                    </div>
                </div>
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
import BCollapse from '@/components/simple/BCollapse.vue';
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';
import Honorific from '@/components/forms/form-snippets/Honorific.vue';
import Datepicker from 'vue3-datepicker';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { onBeforeMount, ref } from 'vue';
import { useCaseStore } from '@/stores/case';
const store = useCaseStore();

let formData = ref([
    {
        query: 'Did the deceased make a Will?',
        answer: null,
        document: null
    },
    {
        query: 'Did the deceased make any Codicils?',
        answer: null,
        document: null
    },
    {
        query: 'Did the deceased make a Will under a different law?',
        answer: null,
        onTrue: {
            query: 'Is there another lawyer advising on the non-UK process?',
            answer: null,
            onTrue: {
                honorific: '',
                forename: '',
                surname: '',
                phone: '',
                email: ''
            }
        }
    },
    {
        query: 'Was the deceased a widow or widower?',
        answer: null,
        onTrue: {
            date_of_death: null,
            date_of_marriage: null,
            forename: '',
            surname: '',
            marriage_cert: null,
            death_cert: null,
            will: null,
            condicils: null,
            grant_of_probate: null,
            estate_accounts: null
        }
    }
]);
const nextSection = async () => {
    let response = await store.saveCaseData(
        null,
        'will-and-marital-status',
        formData.value
    );
    if (response.status === 200) {
        store.navigateToSection('lifetime-gifts');
    }
};

onBeforeMount(async () => {
    let response = await store.fetchCaseData(null, 'will-and-marital-status');
    if (response) {
        formData.value = response;
        let date_of_death = formData.value[3].onTrue.date_of_death;
        let date_of_marriage = formData.value[3].onTrue.date_of_marriage;
        formData.value[3].onTrue.date_of_death = date_of_death
            ? new Date(date_of_death)
            : null;
        formData.value[3].onTrue.date_of_marriage = date_of_marriage
            ? new Date(date_of_marriage)
            : null;
    }
});
</script>

<script>
// URL route for :section parameter
export default {
    routerSectionParam: 'will-and-marital-status',
    navIcon: 'po-icon-ring',
    navLabel: 'Will & Marital Status',
    order: 4
};
</script>

<style lang="scss" scoped></style>
