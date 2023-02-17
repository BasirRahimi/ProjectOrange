<template>
    <div class="container">
        <content-box
            title="Section 19 - Liabilities (owed solely by the deceased)">
            <p class="text-gray-500 m-0">
                Use this section to include liabilities owed by the deceased.
            </p>
        </content-box>

        <content-box title="19.1 Liabilities">
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

            <BaseButton @click="collapse1.toggle()" size="sm" class="pointer"
                >Tip<i class="icon-xs fas fa-chevron-down ms-2"></i
            ></BaseButton>
            <b-collapse ref="collapse1">
                <p class="text-gray-500 mt-2 mb-0">
                    When you do not know the value of a liability at the time of
                    completing this section, note ‘approximately’ by the figure
                </p>
            </b-collapse>
        </content-box>

        <content-box class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('liabilities', formData);
                    router.push({ name: 'section21' });
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
const collapse1 = ref();
let formData = reactive([
    {
        query: 'Are there any liabilities owed by the deceased?',
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
        if (store.client.liabilities) {
            formData = reactive(JSON.parse(store.client.liabilities.the_data));
        }
    }
});
</script>

<style lang="scss" scoped></style>
