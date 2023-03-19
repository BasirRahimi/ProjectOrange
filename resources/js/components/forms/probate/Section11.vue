<template>
    <div class="container">
        <ContentBox
            title="Section 11 - Trusts in which the deceased had an interest">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer">
                <label class="mt-4">Who created the trust?</label>

                <honorific v-model="formData[0].onTrue.trust_honorific" />

                <base-input
                    label="Forenames"
                    placeholder="John"
                    v-model="formData[0].onTrue.trust_forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="formData[0].onTrue.trust_surname"></base-input>

                <label
                    >The date it was created / date of death of the person who
                    died</label
                >
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <datepicker
                            v-model="formData[0].onTrue.trust_date_created"
                            class="form-control bg-white"
                            placeholder="Date"
                            format="dd / MM / yy"></datepicker>
                    </div>
                </div>

                <label>What was the nature of the inheritance received?</label>
                <textarea
                    v-model="formData[0].onTrue.nature_of_inheritance"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>

                <label>What was the value of the inheritance received?</label>
                <div class="row">
                    <div class="col-md-4">
                        <base-input
                            type="number"
                            placeholder="£240,000"
                            min="0"
                            v-model="formData[0].onTrue.value"></base-input>
                    </div>
                </div>

                <label>The names of the trustees</label>
                <p class="text-gray-500 mb-2">
                    Please separate each name with a comma
                </p>
                <textarea
                    v-model="formData[0].onTrue.trustees"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="John Doe, Johnny Appleseed"></textarea>

                <label
                    >Please add the contact details of one of the
                    following</label
                >
                <BaseSwitch
                    left-text="Their solicitors"
                    label="Their accountants"
                    class="mb-4"
                    v-model="formData[0].onTrue.contact" />

                <honorific v-model="formData[0].onTrue.contact_honorific" />
                <base-input
                    label="Forenames"
                    placeholder="John"
                    v-model="formData[0].onTrue.contact_forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="formData[0].onTrue.contact_surname"></base-input>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890"
                            v-model="
                                formData[0].onTrue.contact_phone
                            "></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk"
                            v-model="
                                formData[0].onTrue.contact_email
                            "></base-input>
                    </div>
                </div>

                <label
                    >If you have a copy of the trust documents please include
                    details below and upload the relevant documents too</label
                >
                <div
                    v-for="(doc, index) in formData[0].onTrue.docs"
                    v-show="activeDoc === index"
                    :key="index">
                    <div class="row no-gutters mb-4" :key="index">
                        <div class="col-md-4 me-md-2 mb-2 mb-md-0">
                            <base-input
                                placeholder="Document title e.g ‘The Will’"
                                :mb-4="false"
                                v-model="doc.document_title"></base-input>
                        </div>
                        <div class="col">
                            <client-file-upload
                                v-model="doc.document"
                                class="m-0" />
                        </div>
                    </div>

                    <textarea
                        v-model="doc.extra_details"
                        :key="`details${index}`"
                        class="form-control mb-4"
                        rows="4"
                        placeholder="Add details including any specific page references"></textarea>
                </div>
                <div class="d-sm-flex align-items-center mb-4">
                    <div
                        class="flex-grow-1 mb-3"
                        v-show="formData[0].onTrue.docs.length > 1">
                        <b
                            >Document: {{ activeDoc + 1 }} /
                            {{ formData[0].onTrue.docs.length }}</b
                        ><br />
                        <a
                            href="#"
                            v-if="formData[0].onTrue.docs.length > 1"
                            @click.prevent="removeDoc(activeDoc)"
                            >Remove document</a
                        >
                    </div>
                    <base-button
                        v-if="activeDoc > 0"
                        type="default"
                        outline
                        @click="activeDoc--"
                        >Back</base-button
                    >
                    <base-button
                        type="default"
                        outline
                        @click="addDoc"
                        v-if="activeDoc + 1 == formData[0].onTrue.docs.length"
                        >Add</base-button
                    >
                    <base-button
                        type="default"
                        outline
                        @click="activeDoc++"
                        v-if="activeDoc + 1 < formData[0].onTrue.docs.length"
                        >Next</base-button
                    >
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
import BaseSwitch from '@/components/simple/BaseSwitch.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import Datepicker from 'vue3-datepicker';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import Honorific from '@/components/forms/form-snippets/Honorific.vue';
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';
import { onBeforeMount, ref } from 'vue';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();
const activeDoc = ref(0);
let formData = ref([
    {
        query: 'Was the deceased entitled to benefit from a trust that was created by a Deed or under another’s person’s Will (or intestacy)?',
        answer: null,
        onTrue: {
            trust_honorific: '',
            trust_forename: '',
            trust_surname: '',
            trust_date_created: null,
            nature_of_inheritance: '',
            value: '',
            trustees: '',
            contact: '',
            contact_honorific: '',
            contact_forename: '',
            contact_surname: '',
            contact_phone: '',
            contact_email: '',
            docs: [
                {
                    document_title: '',
                    document: null,
                    extra_details: ''
                }
            ]
        }
    }
]);

const addDoc = () => {
    formData.value[0].onTrue.docs.push({
        document_title: '',
        document: '',
        extra_details: ''
    });
    activeDoc.value++;
};
const removeDoc = (i) => {
    if (i + 1 == formData.value[0].onTrue.docs.length) {
        activeDoc.value--;
    }
    formData.value[0].onTrue.docs.splice(i, 1);
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
        let trust_date_created = formData.value[0].onTrue.trust_date_created;
        formData.value[0].onTrue.trust_date_created = trust_date_created
            ? new Date(trust_date_created)
            : null;
    }
});
</script>
<script>
// URL route for :section parameter
export default {
    routerSectionParam: 'trusts',
    navIcon: 'po-icon-handshake',
    navLabel: 'Trusts',
    order: 12
};
</script>
<style lang="scss" scoped></style>
