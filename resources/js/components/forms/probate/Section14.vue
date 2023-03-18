<template>
    <div class="container">
        <ContentBox
            title="Section 14 - Assets held jointly with another person">
            <p class="text-gray-500 m-0">
                Remember that it is possible to own assets either jointly and
                severally or as tenants in common.
            </p>
        </ContentBox>

        <ContentBox title="14.1 Assets in joint names">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer"
                class="mb-4">
                <div class="asset-table mt-4">
                    <div class="row no-gutters">
                        <div class="col-3 cell-header">
                            Description of asset
                        </div>
                        <div class="col-3 cell-header">Name of other owner</div>
                        <div class="col-3 cell-header">Total Value (£)</div>
                        <div class="col-3 cell-header">
                            Deceased’s share (%)
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
                            <input type="text" v-model="row.desc" />
                        </div>
                        <div class="col-3 cell">
                            <input type="text" v-model="row.otherOwner" />
                        </div>
                        <div class="col-3 cell">
                            <input
                                type="number"
                                step=".01"
                                min="0"
                                v-model="row.value" />
                        </div>
                        <div class="col-3 cell">
                            <input
                                type="number"
                                step=".01"
                                min="0"
                                max="100"
                                v-model="row.share" />
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

            <BCollapse toggle-button toggle-text="Tip">
                <p class="text-gray-500 mt-2 mb-0">
                    If the deceased owned a property jointly with another
                    person, include it here. If there is a mortgage on the
                    property, also include details here.
                </p>
            </BCollapse>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('joint_held_assets', formData);
                    router.push({ name: 'Section15' });
                ">
                Next section
            </button>
        </ContentBox>
    </div>
</template>
<script setup>
import BCollapse from '@/components/simple/BCollapse.vue';
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
        query: 'Did the deceased own any assets in the joint names with another person?',
        answer: null,
        onTrue: []
    }
]);

const addRow = () => {
    if (formData[0].onTrue.length >= 20) return;
    formData[0].onTrue.push({
        desc: '',
        otherOwner: '',
        value: '',
        share: ''
    });
};
const removeRow = (i) => {
    formData[0].onTrue.splice(i, 1);
};
onBeforeMount(() => {
    if (store.client) {
        if (store.client.joint_held_assets) {
            formData = reactive(
                JSON.parse(store.client.joint_held_assets.the_data)
            );
        }
    }
});
</script>
<script>
// URL route for :section parameter

export default {
    routerSectionParam: 'joint-held-assets',
    navIcon: 'po-icon-people',
    navLabel: 'Joint held assets',
    order: 15
};
</script>
<style lang="scss" scoped></style>
