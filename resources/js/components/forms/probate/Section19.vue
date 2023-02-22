<template>
    <div class="container">
        <content-box title="Section 18 - Houses, flats and all other realty">
            <p class="text-gray-500 m-0">
                Use this section to include assets which are known to you but
                not otherwise included in this form.
            </p>
        </content-box>

        <content-box title="18.1 Realty">
            <yes-no
                collapse
                :label="formData[0].query"
                v-model="formData[0].answer"
                class="mb-4"
                @input="addRowIfNone">
                <div
                    class="mt-4 accordion-asset-table"
                    v-show="viewData == false">
                    <template
                        v-for="(row, i) in formData[0].onTrue"
                        :key="`toggle${i}`">
                        <base-button
                            :class="{ active: activeTab == i }"
                            type="default"
                            outline
                            class="d-block mb-2 asset-toggle"
                            @click="changeActiveTab(i)"
                            >{{ i + 1 }} - {{ row.description }}</base-button
                        >
                        <BCollapse
                            :id="`accordion${i}`"
                            role="tabpanel"
                            :visible="activeTab == i"
                            ref="tabPanels">
                            <Card shadow class="mb-2 relative">
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
                                        <label
                                            >Mortgage if applicable (£)</label
                                        >
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
                            </Card>
                        </BCollapse>
                    </template>
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
        </content-box>

        <content-box class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('assets', formData);
                    router.push({ name: 'section20' });
                ">
                Next section
            </button>
        </content-box>
    </div>
</template>
<script setup>
import BCollapse from '@/components/simple/BCollapse.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import Card from '@/components/simple/Card.vue';
import { reactive, onBeforeMount, ref } from 'vue';
import { useSaveData as saveData } from '@/composables/helper.js';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
const viewData = ref(false);

const activeTab = ref(null);
const tabPanels = ref(null);
const changeActiveTab = (i) => {
    if (activeTab.value == i) {
        tabPanels.value[i].hide();
        activeTab.value = null;
    } else {
        activeTab.value = i;
        tabPanels.value.forEach((x) => x.hide());
        tabPanels.value[i].show();
    }
};

let formData = reactive([
    {
        query: 'Did the deceased own IN THEIR SOLE NAME, houses, flats or other realty?',
        answer: null,
        onTrue: []
    }
]);

const addRow = () => {
    formData[0].onTrue.push({
        description: '',
        mortgage: '',
        value: ''
    });
    activeTab.value = formData[0].onTrue.length - 1;
};
const removeRow = (i) => {
    formData[0].onTrue.splice(i, 1);
};
const addRowIfNone = (data) => {
    if (data && formData[0].onTrue.length < 1) {
        addRow();
    }
};

onBeforeMount(() => {
    if (store.client) {
        if (store.client.assets) {
            formData = reactive(JSON.parse(store.client.assets.the_data));
        }
    }
});
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
