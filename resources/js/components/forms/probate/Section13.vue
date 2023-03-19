<template>
    <div class="container">
        <ContentBox title="Section 13 - Life Assurance">
            <p class="text-gray-500 m-0">
                HMRC requires information from you about simple life policies
                and other investments as follows
            </p>
        </ContentBox>

        <ContentBox v-for="(part, key) in parts" :title="part">
            <yes-no
                collapse
                :label="formData[key].query"
                v-model="formData[key].answer">
                <AccordionTabs
                    class="mt-4"
                    :tabs="formData[key].onTrue"
                    toggle-key="company_name"
                    ref="accordion">
                    <template
                        v-for="(item, itemKey) in formData[key].onTrue"
                        v-slot:[slotName(itemKey)]>
                        <BaseButton
                            type="link"
                            class="d-block ms-auto p-0"
                            @click="removePolicy(key, itemKey)"
                            >Remove policy</BaseButton
                        >
                        <BaseInput
                            label="Company name"
                            placeholder="Insurance Company"
                            v-model="item.company_name" />

                        <label>Please describe the policies</label>
                        <textarea
                            v-model="item.policies"
                            class="form-control mb-4"
                            rows="4"
                            placeholder="Please include a full overview of relevant details to this question"></textarea>

                        <base-input
                            label="Value of lump sum"
                            placeholder="£1,000,000"
                            type="number"
                            min="0"
                            v-model="item.value"></base-input>

                        <label
                            >If you have any relevant documents or
                            correspondence to this, please upload copies</label
                        ><br />
                        <div
                            class="row mb-2"
                            v-for="(doc, docKey) in item.docs">
                            <div class="col-12 file-row">
                                <ClientFileUpload
                                    class="mb-0"
                                    v-model="item.docs[docKey]" />
                                <div
                                    class="file-rem-hidden d-inline-block ms-3">
                                    <base-button
                                        type="danger"
                                        icon="fas fa-window-close"
                                        icon-only
                                        @click="
                                            removeDoc(key, itemKey, docKey)
                                        "></base-button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <ClientFileUpload
                                    class="mb-0"
                                    v-model="item.docs[item.docs.length]"
                                    wipeAfterInput
                                    :show-file="false" />
                            </div>
                        </div>
                    </template>
                </AccordionTabs>

                <div class="mt-4">
                    <base-button type="default" outline @click="addRow(key)"
                        >Add another policy</base-button
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
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { onBeforeMount, ref, nextTick } from 'vue';
import { useCaseStore } from '@/stores/case.js';
import AccordionTabs from '@/components/AccordionTabs.vue';
const store = useCaseStore();
const slotName = (i) => {
    return `tab${i}`;
};
const accordion = ref(null);
const addRow = async (partKey) => {
    formData.value[partKey].onTrue.push({
        company_name: '',
        policies: '',
        value: '',
        docs: []
    });
    await nextTick();
    accordion.value[partKey].setActiveTab(
        formData.value[partKey].onTrue.length - 1
    );
};
const removePolicy = (partKey, i) => {
    formData.value[partKey].onTrue.splice(i, 1);
    accordion.value[partKey].setActiveTab(i);
};
const parts = [
    '13.1 Sums payable from insurance companies',
    '13.2 Investment Bonds',
    '13.3 Investment or reinvestment',
    '13.4 Unit-linked investment bonds',
    '13.5 Joint life assurances'
];
let formData = ref([
    {
        query: 'Were any sums payable from insurance companies to the estate as a result of the death of the deceased?',
        answer: null,
        onTrue: [
            {
                company_name: '',
                policies: '',
                value: '',
                docs: []
            }
        ]
    },
    {
        query: 'Did the deceased have any unit-linked investment bonds with insurance companies or other financial service providers that pay 101% of the value of the unit trusts to the estate?',
        answer: null,
        onTrue: [
            {
                company_name: '',
                policies: '',
                value: '',
                docs: []
            }
        ]
    },
    {
        query: 'Did the deceased have any investment or reinvestment plans, bonds or contracts with financial services providers that pay out to the estate on death?',
        answer: null,
        onTrue: [
            {
                company_name: '',
                policies: '',
                value: '',
                docs: []
            }
        ]
    },
    {
        query: 'Did the deceased have any insurance policies and unit-linked investment bonds that are payable to beneficiaries under trust and do not form part of the estate?',
        answer: null,
        onTrue: [
            {
                company_name: '',
                policies: '',
                value: '',
                docs: []
            }
        ]
    },
    {
        query: 'Did the deceased have any joint life assurance policies under which the deceased was one of the lives assured but which remain in force after the death?',
        answer: null,
        onTrue: [
            {
                company_name: '',
                policies: '',
                value: '',
                docs: []
            }
        ]
    }
]);

const removeDoc = (partKey, itemKey, docIndex) => {
    formData.value[partKey].onTrue[itemKey].docs.splice(docIndex, 1);
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
    routerSectionParam: 'life-assurance',
    navIcon: 'po-icon-lifebuoy',
    navLabel: 'Life Assurance',
    order: 14
};
</script>
<style lang="scss" scoped></style>
