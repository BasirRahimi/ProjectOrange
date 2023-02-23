<template>
    <div class="container">
        <ContentBox title="Section 5 - Gifts with reservation of benefit">
            <p class="text-gray-500">
                There is established anti-avoidance legislation which removes
                any tax advantage if a person has given away an asset but
                retained an interest in it. An example of this is where a parent
                might transfer the title of their home to a son or daughter but
                remain in occupation of it after the transfer takes place. This
                is known as a ‘gift with reservation of benefit’ (GWRoB) and
                Executors have a duty to make fullest enquiries and make full
                disclosure to HMRC.
            </p>
            <p class="text-gray-500">
                It does not matter whether seven-years have elapsed since the
                original transfer of the title.
            </p>
        </ContentBox>

        <ContentBox title="5.1 Anti-avoidance legislation">
            <yes-no
                :label="formData[0].query"
                v-model="formData[0].answer"
                collapse>
                <textarea
                    v-model="formData[0].onTrue"
                    class="form-control mt-3"
                    rows="4"
                    placeholder="We shall review this information and ask for further details as appropriate to ensure you make full disclosure to HMRC."></textarea>
            </yes-no>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('gifts', formData);
                    router.push({ name: 'Section6' });
                ">
                Next section
            </button>
        </ContentBox>
    </div>
</template>
<script setup>
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import { reactive, onBeforeMount } from 'vue';
import { useSaveData as saveData } from '@/composables/helper.js';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
let formData = reactive([
    {
        query: 'Did the deceased transfer any assets to any individual, trust, company or other organisation during their lifetime where the recipient did not take full possession of them?',
        answer: null,
        onTrue: ''
    }
]);
onBeforeMount(() => {
    if (store.client) {
        if (store.client.gifts) {
            formData = reactive(JSON.parse(store.client.gifts.the_data));
        }
    }
});
</script>

<style lang="scss" scoped></style>
