<template>
    <div class="container">
        <ContentBox title="Section 18 - Houses, flats and all other realty">
            <p class="text-gray-500 m-0">
                Use this section to include assets which are known to you but
                not otherwise included in this form.
            </p>
        </ContentBox>

        <ContentBox title="18.1 Realty">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer"
                class="mb-4"
                @input="addRowIfNone">
                <div
                    class="mt-4 accordion-asset-table"
                    v-show="viewData == false">
                    <AccordionTabs
                        :tabs="formData[0].onTrue"
                        toggleKey="description"
                        ref="accordion">
                        <template
                            v-for="(row, i) in formData[0].onTrue"
                            v-slot:[accordion.slotName(i)]>
                            <div class="d-flex">
                                <label class="d-lock"
                                    >Description of asset</label
                                >
                                <a
                                    class="ms-auto d-block"
                                    href="#"
                                    v-if="formData[0].onTrue.length > 1"
                                    @click.prevent="removeRow(i)"
                                    >Remove asset</a
                                >
                            </div>
                            <textarea
                                placeholder="e.g. The deceased’s freehold home at 12 Acacia Avenue London, England, EW1 123"
                                rows="2"
                                class="form-control mb-4"
                                v-model="row.description"></textarea>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Mortgage if applicable (£)</label>
                                    <base-input
                                        placeholder="£300,000"
                                        v-model="row.mortgage"
                                        type="number"
                                        min="0"></base-input>
                                </div>
                                <div class="col-md-6">
                                    <label>Value (£)</label>
                                    <base-input
                                        placeholder="£740,000"
                                        v-model="row.value"
                                        type="number"
                                        min="0"></base-input>
                                </div>
                            </div>
                        </template>
                    </AccordionTabs>
                </div>
                <div class="asset-table mt-4" v-if="viewData == true">
                    <div class="row no-gutters">
                        <div class="col-6 cell-header">
                            Description of asset
                        </div>
                        <div class="col-3 cell-header">Mortgage</div>
                        <div class="col-3 cell-header">Value</div>
                    </div>
                    <div
                        class="row no-gutters table-row"
                        v-for="(row, i) in formData[0].onTrue"
                        :key="i">
                        <div class="col-6 cell">
                            {{ row.description }}
                        </div>
                        <div class="col-3 cell text-center">
                            <span v-if="row.mortgage">{{
                                new Intl.NumberFormat('en', {
                                    style: 'currency',
                                    currency: 'GBP'
                                }).format(parseFloat(row.mortgage))
                            }}</span>
                        </div>
                        <div class="col-3 cell text-center">
                            <span v-if="row.mortgage">{{
                                new Intl.NumberFormat('en', {
                                    style: 'currency',
                                    currency: 'GBP'
                                }).format(parseFloat(row.value))
                            }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-4">
                    <base-button
                        type="default"
                        outline
                        class="d-block"
                        @click="viewData = !viewData"
                        >{{ viewData ? 'Edit' : 'Overview' }}</base-button
                    >
                    <base-button
                        type="default"
                        outline
                        class="ms-auto d-block"
                        @click="addRow"
                        v-if="!viewData"
                        >Add</base-button
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
import AccordionTabs from '@/components/AccordionTabs.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { onBeforeMount, ref, nextTick } from 'vue';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();
const viewData = ref(false);
const accordion = ref(null);
let formData = ref([
    {
        query: 'Did the deceased own IN THEIR SOLE NAME, houses, flats or other realty?',
        answer: null,
        onTrue: []
    }
]);

const addRow = async () => {
    formData.value[0].onTrue.push({
        description: '',
        mortgage: '',
        value: ''
    });

    await nextTick();
    accordion.value.setActiveTab(formData.value[0].onTrue.length - 1);
};
const removeRow = (i) => {
    formData.value[0].onTrue.splice(i, 1);
    accordion.value.setActiveTab(i);
};
const addRowIfNone = (data) => {
    if (data && formData.value[0].onTrue.length < 1) {
        addRow();
    }
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
    routerSectionParam: 'assets',
    navIcon: 'po-icon-house',
    navLabel: 'Assets',
    order: 19
};
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.relative {
    position: relative;
}

.remove-asset {
    position: absolute;
    top: 40px;

    @include media-breakpoint-down(sm) {
        top: 5px;
    }
}
</style>
