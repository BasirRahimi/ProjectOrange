<template>
    <div class="container">
        <ContentBox title="Section 7 - Swiss and assets in other ‘tax havens’">
        </ContentBox>

        <ContentBox title="7.1 Swiss and assets in other ‘tax havens’">
            <yes-no
                v-for="(row, i) in formData"
                :key="i"
                class="mb-4"
                :label="row.query"
                v-model="row.answer"
                collapse>
                <textarea
                    v-model="row.onTrue"
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('tax_havens', formData);
                    router.push({ name: 'Section8' });
                ">
                Next section
            </button>
        </ContentBox>
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

let formData = reactive([
    {
        query: 'Did the deceased have any assets in Switzerland?',
        answer: null,
        onTrue: ''
    },
    {
        query: 'Did the deceased have any assets in a tax haven?',
        answer: null,
        onTrue: ''
    }
]);
onBeforeMount(() => {
    if (store.client) {
        if (store.client.tax_havens) {
            formData = reactive(JSON.parse(store.client.tax_havens.the_data));
        }
    }
});
</script>

<style lang="scss" scoped></style>
