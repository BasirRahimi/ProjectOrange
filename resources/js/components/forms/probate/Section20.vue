<template>
    <div class="container">
        <ContentBox title="Section 20 - Other information">
            <p class="text-gray-500 m-0">
                Use this section as an opportunity to provide any extra
                information you believe relevant.
            </p>
        </ContentBox>

        <ContentBox
            title="20.1 Other information"
            v-for="(row, i) in formData"
            :key="`otherInfo${i}`"
            class="relative">
            <a
                class="remove-info"
                href="#"
                v-if="formData.length > 1"
                @click.prevent="removeInfo(i)"
                >Remove</a
            >
            <label>Subject</label>
            <base-input
                placeholder="e.g. Section 13 - policy information finished on it’s way"
                v-model="row.subject"></base-input>

            <label>Description</label>
            <textarea
                v-model="row.description"
                class="form-control mb-4"></textarea>

            <label>Upload relevant documents:</label><br />
            <div class="row mb-2" v-for="(doc, j) in row.docs" :key="j">
                <div class="col-12 file-row">
                    <client-file-upload
                        class="mb-0"
                        v-model="formData[i].docs[j]"></client-file-upload>
                    <div class="file-rem-hidden d-inline-block ms-3">
                        <base-button
                            type="danger"
                            icon="fas fa-window-close"
                            icon-only
                            @click="removeDoc(i, j)"></base-button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <client-file-upload
                        class="mb-0"
                        v-model="formData[i].docs[formData[i].docs.length]"
                        wipeAfterInput
                        :show-file="false"></client-file-upload>
                </div>
            </div>
        </ContentBox>

        <ContentBox class="p-0 text-center" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="addRow">
                Add information<i
                    data-v-c216df9e=""
                    class="fas fa-plus ms-3"></i>
            </button>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="nextSection">
                Review
            </button>
        </ContentBox>
    </div>
</template>
<script setup>
import ContentBox from '@/components/simple/ContentBox.vue';
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';
import { onBeforeMount, ref } from 'vue';
import { useCaseStore } from '@/stores/case.js';
const store = useCaseStore();
let formData = ref([]);

const addRow = () => {
    formData.value.push({
        subject: '',
        description: '',
        docs: []
    });
};
const removeInfo = (i) => {
    formData.value.splice(i, 1);
};
const removeDoc = (i, j) => {
    formData.value[i].docs.splice(j, 1);
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

    if (formData.length < 1) {
        addRow();
    }
});
</script>
<script>
// URL route for :section parameter

export default {
    routerSectionParam: 'other-information',
    navIcon: 'po-icon-information',
    navLabel: 'Other information',
    order: 21
};
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.relative {
    position: relative;
}

.remove-info {
    position: absolute;
    top: 40px;

    @include media-breakpoint-down(sm) {
        top: 5px;
    }
}
</style>
