<template>
    <div class="container">
        <ContentBox title="Adding Executors">
            <p class="text-gray-500">
                Not every Executor may want to take on their role as an Executor
                for personal or other reasons. When this happens an Executor can
                choose one of the following:-
            </p>
            <p class="text-gray-500">
                1. Formally retire as an Executor (‘Renounce Executorship’) for
                which a form is required to be signed.
                <br />2. Have the power of Executorship reserved on them.
                <br />3. Appoint someone to take on the responsibility on their
                behalf (appoint an ‘Attorney’).
            </p>
            <p class="text-gray-500">
                Insert the details of all surviving Executors and check the
                relevant box whether they intend to apply for Probate.
            </p>
        </ContentBox>

        <ContentBox
            class="relative"
            v-for="(executor, key) in formData"
            :key="key"
            :title="`Executor ${key + 1}`">
            <a
                class="remove-executor"
                href="#"
                v-if="formData.length > 1"
                @click.prevent="removeExecutor(key)"
                >Remove Executor</a
            >
            <honorific v-model="executor.honorific" />

            <BaseInput
                label="Forenames"
                placeholder="John"
                v-model="executor.forename"></BaseInput>
            <BaseInput
                label="Surname"
                placeholder="Doe"
                v-model="executor.surname"></BaseInput>

            <div class="mb-4">
                <label>Last usual address</label>
                <BaseSwitch
                    v-model="executor.addressInputType"
                    label="Add manually"
                    leftText="Use postcode" />
            </div>

            <div class="row">
                <div
                    class="col-lg-5"
                    v-show="executor.addressInputType == 'Use postcode'">
                    <BaseInput
                        v-model="executor.postcode"
                        addonRightIcon="fas fa-search"
                        addonRightClasses="btn btn-primary"
                        placeholder="E.g. TN30 6RN" />
                </div>
                <div
                    class="col-12"
                    v-show="executor.addressInputType == 'Add manually'">
                    <div class="row">
                        <div class="col-lg-5">
                            <BaseInput
                                label="Address Line 1"
                                placeholder="23 Acacia Avenue"
                                v-model="executor.addressLine1"></BaseInput>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <BaseInput
                                label="Address Line 2"
                                placeholder="Acacia Road"
                                v-model="executor.addressLine2">
                            </BaseInput>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <BaseInput
                                label="Town / City"
                                placeholder="Acacia"
                                v-model="executor.town"></BaseInput>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <BaseInput
                                label="Postcode"
                                placeholder="TN28 PJ13"
                                v-model="executor.postcode"></BaseInput>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <BaseInput
                        label="National insurance number"
                        placeholder="576HDIW7 IE"
                        v-model="executor.niNumber">
                    </BaseInput>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <BaseInput
                        label="Phone number"
                        placeholder="+44 012345 67890"
                        v-model="executor.phone"></BaseInput>
                </div>
                <div class="col-12 col-lg-6">
                    <BaseInput
                        label="Email Address"
                        placeholder="John.doe@doe.co.uk"
                        v-model="executor.email"></BaseInput>
                </div>
            </div>

            <label>Relationship</label>
            <div class="button-grid mb-4">
                <BaseButton
                    type="default"
                    outline
                    :class="{ active: executor.relationship == 'Spouse' }"
                    @click="clickRelationship('Spouse', key)"
                    >Spouse</BaseButton
                >
                <BaseButton
                    type="default"
                    outline
                    :class="{ active: executor.relationship == 'Child' }"
                    @click="clickRelationship('Child', key)"
                    >Child</BaseButton
                >
                <BaseButton
                    type="default"
                    outline
                    :class="{ active: executor.relationship == 'Grandchild' }"
                    @click="clickRelationship('Grandchild', key)"
                    >Grandchild</BaseButton
                >
                <BaseButton
                    type="default"
                    outline
                    :class="{ active: executor.relationship == 'Sibling' }"
                    @click="clickRelationship('Sibling', key)"
                    >Sibling</BaseButton
                >
                <BaseButton
                    type="default"
                    outline
                    :class="{ active: executor.relationship == 'Other' }"
                    @click="clickRelationship('Other', key)"
                    >Other</BaseButton
                >
            </div>
            <BCollapse :visible="executor.relationship == 'Other'">
                <textarea
                    class="form-control mb-4"
                    rows="3"
                    placeholder="Please include a full overview of relevant details to this question"
                    v-model="executor.relationshipOther"></textarea>
            </BCollapse>

            <label>KYC Document</label>
            <p class="text-gray-500">
                For each executor, a copy of the KYC document should be produced
                with this application. The template of an IFA certification
                letter for this letter is downloadable
                <a href="#"><u>here</u></a
                >. For each Executor, please provide a certified copy of a Type
                1 document and a Type 2 document.
            </p>
            <div class="d-flex mb-4">
                <div class="me-3">
                    <label :for="`${key}kyc1`">Type 1</label><br />
                    <ClientFileUpload
                        :inputId="`${key}kyc1`"
                        v-model="executor.kycType1" />
                </div>
                <div>
                    <label :for="`${key}kyc2`">Type 2</label><br />
                    <ClientFileUpload
                        :inputId="`${key}kyc2`"
                        v-model="executor.kycType2" />
                </div>
            </div>

            <label>Acting as an Executor</label>
            <p class="text-gray-500">
                Sometimes a person may decide that they do not want to be an
                Executor. Would this Executor like to:-
            </p>
            <div>
                <BaseRadio
                    :name="`${key}executorActing`"
                    v-model="executor.acting"
                    value="Accept"
                    >Accept their role and act as executor?</BaseRadio
                >
                <BaseRadio
                    :name="`${key}executorActing`"
                    v-model="executor.acting"
                    value="Retire"
                    >Retire as an executor?</BaseRadio
                >
                <BCollapse :visible="executor.acting == 'Retire'">
                    <p class="text-gray-500">
                        This executor will need to sign a Renunciation. Download
                        a copy below.
                    </p>
                    <BaseButton
                        tag="a"
                        href="#"
                        type="primary"
                        outline
                        class="me-3"
                        >Download Copy <i class="fa-solid fa-arrow-down"></i
                    ></BaseButton>
                    <ClientFileUpload
                        v-model="executor.renunciation"
                        uploadText="Upload Doc +"
                        class="mb-3"
                        changeText="Change Doc" />
                </BCollapse>
                <BaseRadio
                    :name="`${key}executorActing`"
                    v-model="executor.acting"
                    value="Reserve"
                    >Have the power of Executorship reserved to them? (Standing
                    back now but can be involved later)</BaseRadio
                >
                <BCollapse :visible="executor.acting == 'Reserve'">
                    <p class="text-gray-500">
                        This executor will receive a notice of the intention to
                        reserve power on them. This notice can be downloaded
                        below.
                    </p>
                    <BaseButton
                        tag="a"
                        href="#"
                        type="primary"
                        outline
                        class="me-3"
                        >Download Copy <i class="fa-solid fa-arrow-down"></i
                    ></BaseButton>
                    <ClientFileUpload
                        v-model="executor.reserveIntent"
                        uploadText="Upload Doc +"
                        class="mb-3"
                        changeText="Change Doc" />
                </BCollapse>
                <BaseRadio
                    class="mb-0"
                    :name="`${key}executorActing`"
                    v-model="executor.acting"
                    value="Appoint"
                    >Appoint someone to take on the responsibility on their
                    behalf?</BaseRadio
                >
                <BCollapse :visible="executor.acting == 'Appoint'">
                    <p class="text-gray-500 mt-3">
                        If this Executor wants to appoint an Attorney to act for
                        them, you will need to contact us. Use the button below.
                    </p>
                    <a href="#">Create alternative Attorney</a>
                </BCollapse>
            </div>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <div
                class="d-flex mb-4 align-items-center"
                :class="[
                    { 'justify-content-between': formData.length < 4 },
                    { 'justify-content-end': formData.length == 4 }
                ]">
                <BaseButton
                    outline
                    type="default"
                    @click.prevent="addExecutor"
                    v-show="formData.length < 4"
                    >Add executor +
                </BaseButton>
                <button class="btn btn-primary shadow" @click="nextSection()">
                    Next section
                </button>
            </div>
        </ContentBox>
    </div>
</template>
<script setup>
import BaseInput from '@/components/simple/BaseInput.vue';
import BaseRadio from '@/components/simple/BaseRadio.vue';
import BCollapse from '@/components/simple/BCollapse.vue';
import BaseSwitch from '@/components/simple/BaseSwitch.vue';
import Honorific from '@/components/forms/form-snippets/Honorific.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import { useCaseStore } from '@/stores/case.js';
import { onBeforeMount, ref, reactive } from 'vue';
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';

const store = useCaseStore();

let formData = ref([
    {
        honorific: '',
        forename: '',
        surname: '',
        addressLine1: '',
        addressLine2: '',
        town: '',
        postcode: '',
        niNumber: '',
        phone: '',
        email: '',
        relationship: '',
        relationshipOther: '',
        kycType1: '',
        kycType2: '',
        acting: '',
        renunciation: '',
        reserveIntent: '',
        addressInputType: 'Add manually'
    }
]);

const addExecutor = () => {
    formData.value.push({
        honorific: '',
        forename: '',
        surname: '',
        addressLine1: '',
        addressLine2: '',
        town: '',
        postcode: '',
        niNumber: '',
        phone: '',
        email: '',
        relationship: '',
        relationshipOther: '',
        kycType1: '',
        kycType2: '',
        acting: '',
        renunciation: '',
        reserveIntent: '',
        addressInputType: 'Add manually'
    });
};
const removeExecutor = (i) => {
    formData.value.splice(i, 1);
};

const clickRelationship = (relationship, i) => {
    formData.value[i].relationship = relationship;
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
    routerSectionParam: 'executors',
    navIcon: 'fas fa-user-tie',
    navLabel: 'Executors',
    order: 2
};
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.relative {
    position: relative;
}

.remove-executor {
    position: absolute;
    top: 40px;

    @include media-breakpoint-down(sm) {
        top: 5px;
    }
}
</style>
