<template>
    <div class="container">
        <ContentBox
            title="Section 15 - Stocks and shares (in the sole name of the deceased)">
            <p class="text-gray-500 m-0">
                HMRC requires information about stocks and shares held by the
                deceased.
            </p>
        </ContentBox>

        <ContentBox title="15.1 Stocks Information">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer"
                class="mb-4">
                <div class="asset-table mt-4">
                    <div class="row no-gutters">
                        <div class="col-3 cell-header">Name of company</div>
                        <div class="col-3 cell-header">
                            Number of shares held
                        </div>
                        <div class="col-3 cell-header">Shareholder no.</div>
                        <div class="col-3 cell-header">
                            Share price at D.O.D (£)
                        </div>
                    </div>
                    <div
                        class="row no-gutters table-row"
                        v-for="(row, i) in formData[0].onTrue"
                        :key="i">
                        <div
                            class="row-settings"
                            :class="{ active: rowSettings }">
                            <base-button
                                type="danger"
                                icon="fas fa-window-close"
                                icon-only
                                @click="removeRow(i)"></base-button>
                        </div>
                        <div class="col-3 cell">
                            <input type="text" v-model="row.company" />
                        </div>
                        <div class="col-3 cell">
                            <input
                                type="number"
                                step="5"
                                min="0"
                                v-model="row.shares" />
                        </div>
                        <div class="col-3 cell">
                            <input type="text" v-model="row.shareNumber" />
                        </div>
                        <div class="col-3 cell">
                            <input
                                type="number"
                                step="5"
                                min="0"
                                v-model="row.price" />
                        </div>
                    </div>
                </div>

                <div class="text-end mt-2">
                    <base-button
                        type="default"
                        outline
                        :class="{ active: rowSettings }"
                        icon="fas fa-cog"
                        icon-only
                        @click="rowSettings = !rowSettings"></base-button>
                    <base-button
                        type="default"
                        outline
                        class="ms-auto"
                        @click="addRow"
                        v-if="formData[0].onTrue.length < 20"
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
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { onBeforeMount, ref } from 'vue';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();
const rowSettings = ref(false);
let formData = ref([
    {
        query: 'Did the deceased own any stocks and shares in companies registered in the stock exchange?',
        answer: null,
        onTrue: []
    }
]);

const addRow = () => {
    formData.value[0].onTrue.push({
        company: '',
        shares: '',
        shareNumber: '',
        price: ''
    });
};
const removeRow = (i) => {
    formData.value[0].onTrue.splice(i, 1);
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
    routerSectionParam: 'stocks-and-shares',
    navIcon: 'po-icon-graph',
    navLabel: 'Stocks & Shares',
    order: 16
};
</script>
<style lang="scss" scoped></style>
