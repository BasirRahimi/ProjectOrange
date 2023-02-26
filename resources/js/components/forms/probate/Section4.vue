<template>
    <div class="container">
        <ContentBox title="Section 4 - Lifetime Gifs">
            <p class="text-gray-500">
                There is an obligation upon the Executors to make the fullest
                enquiries as appear to be relevant to establish whether any
                lifetime gifts were made on of after 18th March 1986. The
                Executors need to be able to prove that they made fullest
                enquiries and so this means that the Executors should seek
                information from those individuals who appear to be obvious
                recipients of gifts from the deceased (e.g. close relative, etc)
                but also consider less obvious recipients of gifts (e.g. friend,
                employee, housekeeper, distant relative, etc).
            </p>
            <p class="text-gray-500">
                <b
                    >HMRC has made it clear that it will, in some circumstances,
                    examine closely the activities of an Executor making
                    enquiries and will hold them to account for failure to
                    disclose gifts.</b
                >
            </p>
            <p class="text-gray-500">
                The principle is that a gift of an asset will reduce the value
                of a person’s estate. Since Inheritance Tax could have been
                payable if the asset was retained, there are rules which allow
                HMRC to take gifts, normally made within seven years of death,
                to be taken into account in determining whether Inheritance tax
                is due.
            </p>
            <ul class="text-gray-500 m-0 pl-4">
                <li>
                    Gifts to spouses or civil partners do not need to be
                    disclosed.
                </li>
                <li>Small cash gifts of £250 do not need to be disclosed.</li>
                <li>
                    Other gifts in total of £3,000 do not need to be disclosed.
                </li>
            </ul>
        </ContentBox>

        <ContentBox title="4.1 Details of lifetime gifts">
            <yes-no
                v-show="slide === 1"
                class="mb-4"
                label-class="flashit"
                :label="formData[0].query"
                v-model="formData[0].answer"
                collapse>
                <textarea
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"
                    v-model="formData[0].onTrue"></textarea>
            </yes-no>

            <yes-no
                v-show="slide === 2"
                class="mb-4"
                label-class="flashit"
                :label="formData[1].query"
                v-model="formData[1].answer"
                collapse>
                <textarea
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"
                    v-model="formData[1].onTrue"></textarea>
            </yes-no>

            <yes-no
                v-show="slide === 3"
                class="mb-4"
                label-class="flashit"
                :label="formData[2].query"
                v-model="formData[2].answer"
                collapse>
                <textarea
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"
                    v-model="formData[2].onTrue"></textarea>
            </yes-no>

            <yes-no
                v-show="slide === 4"
                class="mb-4"
                label-class="flashit"
                :label="formData[3].query"
                v-model="formData[3].answer"
                collapse>
                <textarea
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"
                    v-model="formData[3].onTrue"></textarea>
            </yes-no>

            <yes-no
                v-show="slide === 5"
                class="mb-4"
                label-class="flashit"
                :label="formData[4].query"
                v-model="formData[4].answer"
                collapse>
                <textarea
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"
                    v-model="formData[4].onTrue"></textarea>
            </yes-no>

            <div class="d-sm-flex align-items-center">
                <div class="flex-grow-1">Step {{ slide }}/5</div>
                <base-button
                    v-if="slide > 1"
                    type="default"
                    outline
                    @click="prevSlide"
                    >Previous</base-button
                >
                <base-button
                    v-if="slide < 5"
                    type="default"
                    outline
                    @click="nextSlide"
                    >Next</base-button
                >
            </div>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('lifetime_gifts', formData);
                    router.push({ name: 'Section5' });
                ">
                Next section
            </button>
        </ContentBox>
    </div>
</template>
<script setup>
// import BCollapse from '@/components/simple/BCollapse.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import { reactive, onBeforeMount, ref } from 'vue';
import {
    useSaveData as saveData,
    useFlashLabel as flashLabel
} from '@/composables/helper.js';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
const collapse = ref({ collapse1: false });
let formData = reactive([
    {
        query: 'Did the deceased make any gifts or transfer assets to or for the benefit of another individual, charity or other organisation?',
        answer: null,
        onTrue: ''
    },
    {
        query: 'Did the deceased create a trust or settlement?',
        answer: null,
        onTrue: ''
    },
    {
        query: 'Did the deceased transfer/gift additional assets to an existing trust or settlement?',
        answer: null,
        onTrue: ''
    },
    {
        query: 'Did the deceased pay a premium on any life insurance policy to for the benefit of someone else?',
        answer: null,
        onTrue: ''
    },
    {
        query: 'Was the deceased entitled to benefit from any assets held in trust or in a settlement which during their life had come to an end either in whole or in part?',
        answer: null,
        onTrue: ''
    }
]);
const slide = ref(1);

onBeforeMount(() => {
    if (store.client) {
        if (store.client.lifetime_gifts) {
            formData = reactive(
                JSON.parse(store.client.lifetime_gifts.the_data)
            );
        }
    }
});

const nextSlide = () => {
    if (slide.value < 5) {
        slide.value++;
        flashLabel();
    }
};
const prevSlide = () => {
    if (slide.value > 1) {
        slide.value--;
        flashLabel();
    }
};
</script>

<style lang="scss" scoped></style>
