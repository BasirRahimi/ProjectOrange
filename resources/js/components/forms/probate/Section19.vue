<template>
    <div class="container">
        <ContentBox
            title="Section 19 - Liabilities (owed solely by the deceased)">
            <p class="text-gray-500 m-0">
                Use this section to include liabilities owed by the deceased.
            </p>
        </ContentBox>

        <ContentBox title="19.1 Liabilities">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer"
                class="mb-4">
                <div class="asset-table mt-4">
                    <div class="row no-gutters">
                        <div class="col-9 cell-header">
                            Description of liability
                        </div>
                        <div class="col-3 cell-header">Value (£)</div>
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
                        <div class="col-9 cell">
                            <input type="text" v-model="row.description" />
                        </div>
                        <div class="col-3 cell">
                            <input type="number" min="0" v-model="row.value" />
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

            <BCollapse toggle-button>
                <p class="text-gray-500 mt-2 mb-0">
                    When you do not know the value of a liability at the time of
                    completing this section, note ‘approximately’ by the figure
                </p>
            </BCollapse>
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
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { onBeforeMount, ref } from 'vue';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();
const rowSettings = ref(false);
let formData = ref([
    {
        query: 'Are there any liabilities owed by the deceased?',
        answer: null,
        onTrue: [
            {
                description: 'Funeral account',
                value: ''
            },
            {
                description: 'Other funeral expenses',
                value: ''
            },
            {
                description: 'Headstone or memorial account',
                value: ''
            },
            {
                description: '',
                value: ''
            }
        ]
    }
]);
const addRow = () => {
    formData.value[0].onTrue.push({
        description: '',
        value: ''
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
    routerSectionParam: 'liabilities',
    navIcon: 'po-icon-car',
    navLabel: 'Liabilities',
    order: 20
};
</script>
<style lang="scss" scoped></style>
