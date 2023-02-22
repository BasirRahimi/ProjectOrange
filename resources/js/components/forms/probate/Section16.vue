<template>
    <div class="container">
        <content-box
            title="Section 16 - Bank and saving accounts (in the sole name of the deceased)">
            <p class="text-gray-500 m-0">
                HMRC requires information about all assets held by the deceased.
            </p>
        </content-box>

        <content-box title="16.1 Banking">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer"
                class="mb-4">
                <div class="asset-table mt-4">
                    <div class="row no-gutters">
                        <div class="col-3 cell-header">Name of institution</div>
                        <div class="col-3 cell-header">Account number</div>
                        <div class="col-3 cell-header">Type of account</div>
                        <div class="col-3 cell-header">Value at D.O.D (£)</div>
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
                            <input type="text" v-model="row.institution" />
                        </div>
                        <div class="col-3 cell">
                            <input type="number" v-model="row.accountNumber" />
                        </div>
                        <div class="col-3 cell">
                            <input type="text" v-model="row.accountType" />
                        </div>
                        <div class="col-3 cell">
                            <input type="number" v-model="row.value" />
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
        </content-box>

        <content-box class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('banks_savings', formData);
                    router.push({ name: 'Section17' });
                ">
                Next section
            </button>
        </content-box>
    </div>
</template>
<script setup>
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { reactive, onBeforeMount, ref } from 'vue';
import { useSaveData as saveData } from '@/composables/helper.js';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
const rowSettings = ref(false);
let formData = reactive([
    {
        query: 'Did the deceased have any bank or building society accounts etc?',
        answer: null,
        onTrue: []
    }
]);

onBeforeMount(() => {
    if (store.client) {
        if (store.client.banks_savings) {
            formData = reactive(
                JSON.parse(store.client.banks_savings.the_data)
            );
        }
    }
});

const addRow = () => {
    formData[0].onTrue.push({
        institution: '',
        accountNumber: '',
        accountType: '',
        value: ''
    });
};
const removeRow = (i) => {
    formData[0].onTrue.splice(i, 1);
};
</script>

<style lang="scss" scoped></style>
