<template>
    <div class="container">
        <ContentBox title="The Advisor Fact-Find" class="text-gray-500">
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
        </ContentBox>
        <ContentBox title="About the Deceased">
            <Honorific v-model="formData.honorific" />

            <BaseInput
                placeholder="John"
                v-model="formData.forename"
                label="Forenames"></BaseInput>
            <BaseInput
                placeholder="Doe"
                v-model="formData.surname"
                label="Surname"></BaseInput>
            <BaseInput
                placeholder="Johnathan Doe"
                v-model="formData.aliases"
                label="Any aliases in which they held assets?"></BaseInput>
            <div class="row mb-4">
                <div class="col-lg-5">
                    <label>Date of Death</label>
                    <Datepicker
                        class="form-control bg-white"
                        v-model="formData.date_of_death"
                        placeholder="21 / 9 / 2020"
                        input-format="dd / MM / yy"
                        :upper-limit="date"></Datepicker>
                </div>
            </div>

            <div class="mb-4">
                <label>Last usual address</label>
                <BaseSwitch
                    v-model="addressInputType"
                    label="Add manually"
                    leftText="Use postcode" />
            </div>

            <div class="row">
                <div
                    class="col-lg-5 mb-4"
                    v-show="addressInputType == 'Use postcode'">
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
                <div class="col-12" v-show="addressInputType == 'Add manually'">
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
                        <div class="col-lg-5">
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
        </ContentBox>
        <ContentBox title="1.2 Key Information">
            <div class="row">
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <BaseInput
                        label="Place of Birth"
                        placeholder="Maidstone, Kent"
                        v-model="formData.place_of_birth"
                        :mb-4="false"></BaseInput>
                </div>
                <div class="col-12 col-lg-6">
                    <BaseInput
                        label="Place of Death"
                        placeholder="Wandsworth, London"
                        v-model="formData.place_of_death"
                        :mb-4="false"></BaseInput>
                </div>
            </div>
        </ContentBox>
        <ContentBox title="1.3 Marital Status">
            <ButtonGroup
                cssGrid
                :gridColsize="150"
                :options="[
                    'Married / CP',
                    'Batchelor',
                    'Divorced',
                    'Widowed',
                    'Spinster'
                ]"
                v-model="formData.marital_status">
                <template v-slot:collapse0>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <BaseInput
                                label="Full Name of Spouse / CP"
                                placeholder="Jane Sally Doe"
                                v-model="formData.spouse_name" />
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <BaseInput
                                label="Place of marriage / CP"
                                placeholder="Wandsworth, London"
                                v-model="formData.place_of_marriage" />
                        </div>
                        <div class="col-md-6">
                            <label>Date of marriage / CP</label>
                            <Datepicker
                                class="form-control bg-white"
                                v-model="formData.date_of_marriage"
                                placeholder="21 / 04 / 2010"
                                input-format="dd / MM / yy"
                                :upper-limit="date"></Datepicker>
                        </div>
                        <div class="col-md-6">
                            <label
                                >Upload a copy of the marriage / CP
                                certificate</label
                            >
                            <ClientFileUpload
                                v-model="formData.marriage_cert" />
                        </div>
                    </div>
                </template>
                <template v-slot:collapse2>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label>Date of marriage</label>
                            <Datepicker
                                class="form-control bg-white mb-4"
                                v-model="formData.date_of_marriage"
                                placeholder="21 / 04 / 2010"
                                input-format="dd / MM / yy"
                                :upper-limit="date"></Datepicker>
                        </div>
                        <div class="col-md-6">
                            <label>Date the marriage officially ended</label>
                            <Datepicker
                                class="form-control bg-white mb-4"
                                v-model="formData.date_of_divorce"
                                placeholder="21 / 04 / 2010"
                                input-format="dd / MM / yy"
                                :upper-limit="date"></Datepicker>
                        </div>
                        <div class="col-md-6">
                            <BaseInput
                                label="Place of marriage"
                                placeholder="Wandsworth, London"
                                v-model="formData.place_of_marriage" />
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <label>
                                Upload a copy of the marriage / CP certificate
                            </label>
                            <ClientFileUpload
                                v-model="formData.marriage_cert" />
                        </div>
                    </div>
                </template>
            </ButtonGroup>
        </ContentBox>
        <ContentBox title="1.4 Surviving Relatives">
            <div class="button-grid">
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('spouse')"
                    :class="{ active: formData.spouse }"
                    class="col"
                    >Spouse</base-button
                >
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('parents')"
                    :class="{ active: formData.parents > 0 }"
                    class="col"
                    >Parents</base-button
                >
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('siblings')"
                    :class="{ active: formData.siblings > 0 }"
                    class="col"
                    >Siblings</base-button
                >
                <base-button
                    type="default"
                    outline
                    @click="updateSurvivingRelatives('children')"
                    :class="{ active: formData.children > 0 }"
                    class="col"
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
            <BCollapse :visible="formData.parents > 0">
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
            </BCollapse>
            <BCollapse :visible="formData.siblings > 0">
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
            </BCollapse>
            <BCollapse :visible="formData.children > 0">
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
            </BCollapse>
            <BCollapse :visible="formData.grand_children > 0">
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
            </BCollapse>
        </ContentBox>
        <ContentBox title="1.5 Income tax details">
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
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <label for="phone">Phone number</label>
                    <input
                        type="text"
                        class="form-control"
                        id="phone"
                        placeholder="+44 012345 67890"
                        v-model="formData.accountant_phone" />
                </div>
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <label for="email">Email Address</label>
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        placeholder="John.doe@doe.co.uk"
                        v-model="formData.accountant_email" />
                </div>
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
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';
import ButtonGroup from '@/components/forms/form-snippets/ButtonGroup.vue';
import BaseInput from '@/components/simple/BaseInput.vue';
import BCollapse from '@/components/simple/BCollapse.vue';
import BaseSwitch from '@/components/simple/BaseSwitch.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import Honorific from '@/components/forms/form-snippets/Honorific.vue';
import Datepicker from 'vue3-datepicker';
import { onBeforeMount, ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useCaseStore } from '@/stores/case';

const router = useRouter();
const store = useCaseStore();
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
    date_of_marriage: null,
    date_of_divorce: null,
    place_of_marriage: null,
    marriage_cert: null,
    spouse_name: null,
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
const addressInputType = ref('Add manually');
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
            } else {
                formData[relative] = 0;
            }
            break;
        case 'siblings':
            if (formData[relative] === 0 || formData[relative] === null) {
                formData[relative] = 1;
            } else {
                formData[relative] = 0;
            }
            break;
        case 'children':
            if (formData[relative] === 0 || formData[relative] === null) {
                formData[relative] = 1;
            } else {
                formData[relative] = 0;
            }
            break;
        case 'grand_children':
            if (formData[relative] === 0 || formData[relative] === null) {
                formData[relative] = 1;
            } else {
                formData[relative] = 0;
            }
            break;

        default:
            break;
    }
};
const nextSection = async () => {
    let response = await saveData();
    if (response.status === 200) {
        store.nextSection();
    } else {
        alert('There has been an error, please contact a Mabain admin');
    }
};
const saveData = async () => {
    let date_of_death = null;
    if (formData.date_of_death) {
        date_of_death = `${formData.date_of_death.getFullYear()}-${
            formData.date_of_death.getMonth() + 1
        }-${formData.date_of_death.getDate()}`;
    }

    let date_of_marriage = null;
    if (formData.date_of_marriage) {
        date_of_marriage = `${formData.date_of_marriage.getFullYear()}-${
            formData.date_of_marriage.getMonth() + 1
        }-${formData.date_of_marriage.getDate()}`;
    }

    let date_of_divorce = null;
    if (formData.date_of_divorce) {
        date_of_divorce = `${formData.date_of_divorce.getFullYear()}-${
            formData.date_of_divorce.getMonth() + 1
        }-${formData.date_of_divorce.getDate()}`;
    }

    let data = {
        ...formData,
        date_of_death,
        date_of_marriage,
        date_of_divorce
    };
    let response = await store.saveCaseData(data);
    return response;
};
const fetchCaseData = async () => {
    let response = await store.fetchCaseData();
    if (response) {
        Object.keys(formData).forEach((key, index) => {
            if (
                [
                    'date_of_divorce',
                    'date_of_death',
                    'date_of_marriage'
                ].indexOf(key) >= 0
            ) {
                formData[key] = new Date(response[key]);
            } else if (key === 'marriage_cert') {
                formData[key] = response[key];
            } else {
                formData[key] = response[key];
            }
        });
    }
};
onBeforeMount(() => {
    fetchCaseData();
});
</script>

<script>
// URL route for :section parameter
export default {
    routerSectionParam: 'about-the-deceased',
    navIcon: 'po-icon-person',
    navLabel: 'About the deceased',
    order: 1
};
</script>

<style lang="scss" scoped></style>
