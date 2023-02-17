<template>
    <div class="container">
        <content-box title="The Advisor Fact-Find" class="text-muted">
            <p>
                Please work through this fact find and complete as much
                information as possible. You may not have all of the information
                in the first instance and so you may set yourself reminders to
                revisit sections.
            </p>
            <p>
                Once the Executors have approved the fact find, please click the
                submit button.
            </p>
        </content-box>
        <content-box title="About the Deceased">
            <Honorific v-model="formData.honorific" />

            <base-input
                placeholder="John"
                v-model="formData.forename"
                label="Forenames"></base-input>
            <base-input
                placeholder="Doe"
                v-model="formData.surname"
                label="Surname"></base-input>
            <base-input
                placeholder="Johnathan Doe"
                v-model="formData.aliases"
                label="Any aliases in which they held assets?"></base-input>

            <div class="mb-4">
                <label>Last usual address</label><br />
                <BaseRadio
                    inline
                    name="postcode"
                    v-model="addressInputType"
                    value="postcode"
                    >Find with postcode</BaseRadio
                >
                <BaseRadio
                    inline
                    name="manual"
                    v-model="addressInputType"
                    value="manual"
                    >Add manually</BaseRadio
                >
            </div>

            <div class="row">
                <div
                    class="col-lg-5 mb-4"
                    v-show="addressInputType == 'postcode'">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="E.g. TN30 6RN" />
                        <div class="input-group-append">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12" v-show="addressInputType == 'manual'">
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label for="addressLine1">Address Line 1</label>
                            <input
                                type="text"
                                id="addressLine1"
                                class="form-control"
                                placeholder="23 Acacia Avenue"
                                v-model="formData.addressline1" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label for="addressLine2">Address Line 2</label>
                            <input
                                type="text"
                                id="addressLine2"
                                class="form-control"
                                placeholder="Acacia Road"
                                v-model="formData.addressline2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label for="town">Town / City</label>
                            <input
                                type="text"
                                id="town"
                                class="form-control"
                                placeholder="Acadia"
                                v-model="formData.city" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label for="postcode">Postcode</label>
                            <input
                                type="text"
                                id="postcode"
                                class="form-control"
                                placeholder="TN28 PJ13"
                                v-model="formData.postcode" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <label for="aliases">Date of Death</label>
                    <Datepicker
                        class="form-control bg-white"
                        v-model="formData.date_of_death"
                        placeholder="21 / 9 / 2020"
                        input-format="dd / MM / yy"
                        :upper-limit="date"></Datepicker>
                </div>
            </div>
        </content-box>
        <content-box title="1.2 Key Information">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <base-input
                        class="mb-3 mb-lg-0"
                        label="Place of Birth"
                        placeholder="Maidstone, Kent"
                        v-model="formData.place_of_birth"
                        :mb-4="false"></base-input>
                </div>
                <div class="col-12 col-lg-6">
                    <base-input
                        label="Place of Death"
                        placeholder="Wandsworth, London"
                        v-model="formData.place_of_death"
                        :mb-4="false"></base-input>
                </div>
            </div>
        </content-box>
        <content-box title="1.3 Marital Status">
            <div class="button-grid">
                <base-button
                    type="default"
                    outline
                    :class="{ active: formData.marital_status == 'Married' }"
                    @click="formData.marital_status = 'Married'"
                    >Married</base-button
                >
                <base-button
                    type="default"
                    outline
                    :class="{ active: formData.marital_status == 'Batchelor' }"
                    @click="formData.marital_status = 'Batchelor'"
                    >Batchelor</base-button
                >
                <base-button
                    type="default"
                    outline
                    :class="{ active: formData.marital_status == 'Divorced' }"
                    @click="formData.marital_status = 'Divorced'"
                    >Divorced</base-button
                >
                <base-button
                    type="default"
                    outline
                    :class="{ active: formData.marital_status == 'Widowed' }"
                    @click="formData.marital_status = 'Widowed'"
                    >Widowed</base-button
                >
                <base-button
                    type="default"
                    outline
                    :class="{ active: formData.marital_status == 'Spinster' }"
                    @click="formData.marital_status = 'Spinster'"
                    >Spinster</base-button
                >
            </div>
        </content-box>
        <content-box title="1.4 Surviving Relatives">
            <div class="button-grid">
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('spouse')"
                    :class="{ active: formData.spouse }"
                    class="col me-3"
                    >Spouse</base-button
                >
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('parents')"
                    :class="{ active: formData.parents > 0 }"
                    class="col me-3"
                    >Parents</base-button
                >
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('siblings')"
                    :class="{ active: formData.siblings > 0 }"
                    class="col me-3"
                    >Siblings</base-button
                >
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('children')"
                    :class="{ active: formData.children > 0 }"
                    class="col me-3"
                    >Children</base-button
                >
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('grand_children')"
                    :class="{ active: formData.grand_children > 0 }"
                    class="col"
                    >Grand Children</base-button
                >
            </div>
            <b-collapse ref="collapse1" :visible="formData.parents > 0">
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <label for="noOfParents"
                            >Number of Surviving Parents</label
                        >
                        <input
                            type="number"
                            max="2"
                            min="0"
                            id="noOfParents"
                            class="form-control"
                            v-model.number="formData.parents" />
                    </div>
                </div>
            </b-collapse>
            <b-collapse ref="collapse2" :visible="formData.siblings > 0">
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <label for="noOfSiblings"
                            >Number of Surviving Siblings</label
                        >
                        <input
                            type="number"
                            min="0"
                            id="noOfSiblings"
                            class="form-control"
                            v-model.number="formData.siblings" />
                    </div>
                </div>
            </b-collapse>
            <b-collapse ref="collapse3" :visible="formData.children > 0">
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <label for="noOfChildren"
                            >Number of Surviving Children</label
                        >
                        <input
                            type="number"
                            min="0"
                            id="noOfChildren"
                            class="form-control"
                            v-model.number="formData.children" />
                    </div>
                </div>
            </b-collapse>
            <b-collapse ref="collapse4" :visible="formData.grand_children > 0">
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <label for="noOfGrandChildren"
                            >Number of Surviving Grand Children</label
                        >
                        <input
                            type="number"
                            min="0"
                            id="noOfGrandChildren"
                            class="form-control"
                            v-model.number="formData.grand_children" />
                    </div>
                </div>
            </b-collapse>
        </content-box>
        <content-box title="1.5 Income tax details">
            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <label for="NInumber">National insurance number</label>
                    <input
                        type="text"
                        class="form-control"
                        id="NInumber"
                        placeholder="576HDIW7 IE"
                        v-model="formData.national_insurance_number" />
                </div>
                <div class="col-12 col-lg-6 mb-4">
                    <label for="tax-ref">Income tax reference</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tax-ref"
                        placeholder="5678 DVW 09"
                        v-model="formData.income_tax_reference" />
                </div>
                <div class="col-12 mb-2">
                    <label
                        >The contact details of the deceased’s accountant</label
                    >
                </div>
                <div class="col-12 col-lg-6 mb-4">
                    <label for="phone">Phone number</label>
                    <input
                        type="text"
                        class="form-control"
                        id="phone"
                        placeholder="+44 012345 67890"
                        v-model="formData.accountant_phone" />
                </div>
                <div class="col-12 col-lg-6 mb-4">
                    <label for="email">Email Address</label>
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        placeholder="John.doe@doe.co.uk"
                        v-model="formData.accountant_email" />
                </div>
            </div>
        </content-box>
        <content-box class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="nextSection">
                Next section
            </button>
        </content-box>
    </div>
</template>
<script setup>
import Honorific from '../form-snippets/Honorific.vue';
import { useClientStore } from '@/stores/client.js';
import Datepicker from 'vue3-datepicker';
import { onBeforeMount, ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useSaveSectionData as saveSectionData } from '@/composables/helper.js';

const router = useRouter();
const store = useClientStore();
const collapse1 = ref(null);
const collapse2 = ref(null);
const collapse3 = ref(null);
const collapse4 = ref(null);
const formData = reactive({
    honorific: '',
    forename: '',
    surname: '',
    aliases: '',
    addressline1: '',
    addressline2: '',
    city: '',
    postcode: '',
    date_of_death: null,
    place_of_birth: null,
    place_of_death: null,
    marital_status: null,
    spouse: false,
    parents: 0,
    siblings: 0,
    children: 0,
    grand_children: 0,
    national_insurance_number: '',
    income_tax_reference: '',
    accountant_phone: '',
    accountant_email: ''
});
const addressInputType = ref('manual');
const date = new Date();

const updateSurvivingRelatives = (relative) => {
    switch (relative) {
        case 'spouse':
            formData[relative] =
                formData[relative] === 0 || formData[relative] === null ? 1 : 0;
            break;
        case 'parents':
            if (formData[relative] === 0 || formData[relative] === null) {
                formData[relative] = 1;
                collapse1.value.show();
            } else {
                formData[relative] = 0;
                collapse1.value.hide();
            }
            break;
        case 'siblings':
            if (formData[relative] === 0 || formData[relative] === null) {
                formData[relative] = 1;
                collapse2.value.show();
            } else {
                formData[relative] = 0;
                collapse2.value.hide();
            }
            break;
        case 'children':
            if (formData[relative] === 0 || formData[relative] === null) {
                formData[relative] = 1;
                collapse3.value.show();
            } else {
                formData[relative] = 0;
                collapse3.value.hide();
            }
            break;
        case 'grand_children':
            if (formData[relative] === 0 || formData[relative] === null) {
                formData[relative] = 1;
                collapse4.value.show();
            } else {
                formData[relative] = 0;
                collapse4.value.hide();
            }
            break;

        default:
            break;
    }
};
const nextSection = () => {
    saveData();
    router.push({ name: 'section2' });
};
const saveData = () => {
    let data = {
        ...formData,
        date_of_death: `${formData.date_of_death.getFullYear()}-${
            formData.date_of_death.getMonth() + 1
        }-${formData.date_of_death.getDate()}`
    };
    saveSectionData(data, store.client.id).then((response) => {
        console.log(response);
        store.updateClient(response[1].data);
    });
};
onBeforeMount(() => {
    if (store.client) {
        Object.keys(formData).forEach((key, index) => {
            if (key === 'date_of_death' && store.client[key]) {
                formData[key] = new Date(store.client[key]);
            } else {
                formData[key] = store.client[key];
            }
        });
    }
});
</script>

<style lang="scss" scoped></style>
