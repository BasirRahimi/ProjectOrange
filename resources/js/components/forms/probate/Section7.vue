<template>
    <div class="container">
        <content-box title="Section 7 - Swiss and assets in other ‘tax havens’">
            <!-- <BaseButton
                @click="collapse.collapse1 = !collapse.collapse1"
                size="sm"
                class="pointer"
                >Tip<i class="icon-xs fas fa-chevron-down ms-2"></i
            ></BaseButton>
            <BCollapse :visible="collapse.collapse1">
                <p class="text-gray-500 mt-2 mb-0">
                    Domicile and residence is relevant because it affects the
                    law that governs succession. Since 17.8.2016 a new European
                    Regulation affects succession within EU member states. The
                    UK and Eire have not opted in to the Regulation (Denmark has
                    opted out) but it will nonetheless affect individuals
                    connected with the EU. If you are a beneficiary of this
                    estate and there are non-UK assets involved, you should
                    consider your own Will now. Do not wait until the estate has
                    been administered.
                </p>
            </BCollapse> -->
        </content-box>

        <content-box title="7.1 Swiss and assets in other ‘tax havens’">
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
        </content-box>

        <content-box class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('tax_havens', formData);
                    router.push({ name: 'Section8' });
                ">
                Next section
            </button>
        </content-box>
    </div>
</template>

<script setup>
// import BCollapse from '@/components/simple/BCollapse.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { reactive, onBeforeMount, ref } from 'vue';
import { useSaveData as saveData } from '@/composables/helper.js';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
const collapse = ref({ collapse1: false });

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
