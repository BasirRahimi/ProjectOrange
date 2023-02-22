<template>
    <div class="container">
        <content-box title="Section 13 - Life Assurance">
            <p class="text-gray-500 m-0">
                HMRC requires information from you about simple life policies
                and other investments as follows
            </p>
        </content-box>

        <content-box title="13.1 Sums payable from insurance companies">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"
                    v-model="formData[0].onTrue.company_name"></base-input>

                <label>Please describe the policies</label>
                <textarea
                    v-model="formData[0].onTrue.policies"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"
                    v-model="formData[0].onTrue.value"></base-input>

                <label
                    >If you have any relevant documents or correspondence to
                    this, please upload copies</label
                ><br />
                <div
                    class="row mb-2"
                    v-for="(doc, i) in formData[0].onTrue.docs"
                    :key="i">
                    <div class="col-12 file-row">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[0].onTrue.docs[i]"
                            @input="saveData"></client-file-upload>
                        <div class="file-rem-hidden d-inline-block ms-3">
                            <base-button
                                type="danger"
                                icon="fas fa-window-close"
                                icon-only
                                @click="removeDoc(0, i)"></base-button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <client-file-upload
                            class="mb-0"
                            v-model="
                                formData[0].onTrue.docs[
                                    formData[0].onTrue.docs.length
                                ]
                            "
                            @input="saveData"
                            wipeAfterInput
                            :show-file="false"></client-file-upload>
                    </div>
                </div>
            </yes-no>
        </content-box>

        <content-box title="13.2 Investment Bonds">
            <yes-no
                collapse
                :label="formData[1].query"
                v-model="formData[1].answer">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"
                    v-model="formData[1].onTrue.company_name"></base-input>

                <label>Please describe the policies</label>
                <textarea
                    v-model="formData[1].onTrue.policies"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"
                    v-model="formData[1].onTrue.value"></base-input>

                <label
                    >If you have any relevant documents or correspondence to
                    this, please upload copies</label
                ><br />
                <div
                    class="row mb-2"
                    v-for="(doc, i) in formData[1].onTrue.docs"
                    :key="i">
                    <div class="col-12 file-row">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[1].onTrue.docs[i]"
                            @input="saveData"></client-file-upload>
                        <div class="file-rem-hidden d-inline-block ms-3">
                            <base-button
                                type="danger"
                                icon="fas fa-window-close"
                                icon-only
                                @click="removeDoc(1, i)"></base-button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <client-file-upload
                            class="mb-0"
                            v-model="
                                formData[1].onTrue.docs[
                                    formData[1].onTrue.docs.length
                                ]
                            "
                            @input="saveData"
                            wipeAfterInput
                            :show-file="false"></client-file-upload>
                    </div>
                </div>
            </yes-no>
        </content-box>

        <content-box title="13.3 Investment or reinvestment">
            <yes-no
                collapse
                :label="formData[2].query"
                v-model="formData[2].answer">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"
                    v-model="formData[2].onTrue.company_name"></base-input>

                <label>Please describe the policies</label>
                <textarea
                    v-model="formData[2].onTrue.policies"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"
                    v-model="formData[2].onTrue.value"></base-input>

                <label
                    >If you have any relevant documents or correspondence to
                    this, please upload copies</label
                ><br />
                <div
                    class="row mb-2"
                    v-for="(doc, i) in formData[2].onTrue.docs"
                    :key="i">
                    <div class="col-12 file-row">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[2].onTrue.docs[i]"
                            @input="saveData"></client-file-upload>
                        <div class="file-rem-hidden d-inline-block ms-3">
                            <base-button
                                type="danger"
                                icon="fas fa-window-close"
                                icon-only
                                @click="removeDoc(2, i)"></base-button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <client-file-upload
                            class="mb-0"
                            v-model="
                                formData[2].onTrue.docs[
                                    formData[2].onTrue.docs.length
                                ]
                            "
                            @input="saveData"
                            wipeAfterInput
                            :show-file="false"></client-file-upload>
                    </div>
                </div>
            </yes-no>
        </content-box>

        <content-box title="13.4 Unit-linked investment bonds">
            <yes-no
                collapse
                :label="formData[3].query"
                v-model="formData[3].answer">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"
                    v-model="formData[3].onTrue.company_name"></base-input>

                <label>Please describe the policies</label>
                <textarea
                    v-model="formData[3].onTrue.policies"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"
                    v-model="formData[3].onTrue.value"></base-input>

                <label
                    >If you have any relevant documents or correspondence to
                    this, please upload copies</label
                ><br />
                <div
                    class="row mb-2"
                    v-for="(doc, i) in formData[3].onTrue.docs"
                    :key="i">
                    <div class="col-12 file-row">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[3].onTrue.docs[i]"
                            @input="saveData"></client-file-upload>
                        <div class="file-rem-hidden d-inline-block ms-3">
                            <base-button
                                type="danger"
                                icon="fas fa-window-close"
                                icon-only
                                @click="removeDoc(3, i)"></base-button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <client-file-upload
                            class="mb-0"
                            v-model="
                                formData[3].onTrue.docs[
                                    formData[3].onTrue.docs.length
                                ]
                            "
                            @input="saveData"
                            wipeAfterInput
                            :show-file="false"></client-file-upload>
                    </div>
                </div>
            </yes-no>
        </content-box>

        <content-box title="13.5 Joint life assurances">
            <yes-no
                collapse
                :label="formData[4].query"
                v-model="formData[4].answer">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"
                    v-model="formData[4].onTrue.company_name"></base-input>

                <label>Please describe the policies</label>
                <textarea
                    v-model="formData[4].onTrue.policies"
                    class="form-control mb-4"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"
                    v-model="formData[4].onTrue.value"></base-input>

                <label
                    >If you have any relevant documents or correspondence to
                    this, please upload copies</label
                ><br />
                <div
                    class="row mb-2"
                    v-for="(doc, i) in formData[4].onTrue.docs"
                    :key="i">
                    <div class="col-12 file-row">
                        <client-file-upload
                            class="mb-0"
                            v-model="formData[4].onTrue.docs[i]"
                            @input="saveData"></client-file-upload>
                        <div class="file-rem-hidden d-inline-block ms-3">
                            <base-button
                                type="danger"
                                icon="fas fa-window-close"
                                icon-only
                                @click="removeDoc(4, i)"></base-button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <client-file-upload
                            class="mb-0"
                            v-model="
                                formData[4].onTrue.docs[
                                    formData[4].onTrue.docs.length
                                ]
                            "
                            @input="saveData"
                            wipeAfterInput
                            :show-file="false"></client-file-upload>
                    </div>
                </div>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('life_assurance', formData);
                    router.push({ name: 'section15' });
                ">
                Next section
            </button>
        </content-box>
    </div>
</template>
<script setup>
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { reactive, onBeforeMount } from 'vue';
import { useSaveData as saveData } from '@/composables/helper.js';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
let formData = reactive([
    {
        query: 'Were any sums payable from insurance companies to the estate as a result of the death of the deceased?',
        answer: null,
        onTrue: {
            company_name: '',
            policies: '',
            value: '',
            docs: []
        }
    },
    {
        query: 'Did the deceased have any unit-linked investment bonds with insurance companies or other financial service providers that pay 101% of the value of the unit trusts to the estate?',
        answer: null,
        onTrue: {
            company_name: '',
            policies: '',
            value: '',
            docs: []
        }
    },
    {
        query: 'Did the deceased have any investment or reinvestment plans, bonds or contracts with financial services providers that pay out to the estate on death?',
        answer: null,
        onTrue: {
            company_name: '',
            policies: '',
            value: '',
            docs: []
        }
    },
    {
        query: 'Did the deceased have any insurance policies and unit-linked investment bonds that are payable to beneficiaries under trust and do not form part of the estate?',
        answer: null,
        onTrue: {
            company_name: '',
            policies: '',
            value: '',
            docs: []
        }
    },
    {
        query: 'Did the deceased have any joint life assurance policies under which the deceased was one of the lives assured but which remain in force after the death?',
        answer: null,
        onTrue: {
            company_name: '',
            policies: '',
            value: '',
            docs: []
        }
    }
]);

const removeDoc = (i, j) => {
    formData[i].onTrue.docs.splice(j, 1);
};

onBeforeMount(() => {
    if (store.client) {
        if (store.client.life_assurance) {
            formData = reactive(
                JSON.parse(store.client.life_assurance.the_data)
            );
        }
    }
});
</script>

<style lang="scss" scoped></style>
