<template>
    <div class="container">
        <content-box
            title="Section 17 - Personal belongings (owned solely by the deceased)">
            <p class="text-gray-500 m-0">
                HMRC requires information about all chattels held by the
                deceased.
            </p>
        </content-box>

        <content-box title="17.1 Chattels">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer"
                class="mb-4">
                <div class="asset-table mt-4">
                    <div class="row no-gutters">
                        <div class="col-9 cell-header">
                            Description of Chattels
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

            <BaseButton
                @click="collapse.collapse1 = !collapse.collapse1"
                size="sm"
                class="pointer"
                >Tip<i class="icon-xs fas fa-chevron-down ms-2"></i
            ></BaseButton>
            <b-collapse :visible="collapse.collapse1">
                <p class="text-gray-500 mt-2 mb-0">
                    If the deceased was, for example, married and acquired
                    furniture and household effects with their spouse, it could
                    be the case that such items were owned jointly and so you
                    should include jointly owned possessions in section 14.
                    Unless the total value of the Chattels owned by the deceased
                    is likely to exceed £1,000 there is usually no need to
                    obtain a formal valuation. Include below Items such as cars,
                    jewellery, etc.
                </p>
            </b-collapse>
        </content-box>

        <content-box class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('personal_belongings', formData);
                    router.push({ name: 'section19' });
                ">
                Next section
            </button>
        </content-box>
    </div>
</template>
<script setup>
import YesNo from '../form-snippets/YesNo.vue';
import { reactive, onBeforeMount, ref } from 'vue';
import { useSaveData as saveData } from '../../../composables/helper';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
const rowSettings = ref(false);
const collapse = ref({ collapse1: false });
let formData = reactive([
    {
        query: 'Did the deceased own any Chattels of particular value?',
        answer: null,
        onTrue: []
    }
]);

const addRow = () => {
    formData[0].onTrue.push({
        description: '',
        value: ''
    });
};
const removeRow = (i) => {
    formData[0].onTrue.splice(i, 1);
};

onBeforeMount(() => {
    if (store.client) {
        if (store.client.personal_belongings) {
            formData = reactive(
                JSON.parse(store.client.personal_belongings.the_data)
            );
        }
    }
});
</script>

<style lang="scss" scoped></style>
