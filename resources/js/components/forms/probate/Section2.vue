<template>
    <div class="container">
        <ContentBox title="Section 2 - Powers of Attorney and non-UK elements">
            <yes-no
                class="mb-4"
                :label="formData[0].query"
                collapse
                v-model="formData[0].answer">
                <client-file-upload
                    class="mt-3"
                    v-model="formData[0].document"></client-file-upload>
            </yes-no>
            <yes-no
                class="mb-4"
                :label="formData[1].query"
                collapse
                v-model="formData[1].answer">
                <client-file-upload
                    class="mt-3"
                    v-model="formData[1].document"></client-file-upload>
            </yes-no>

            <BCollapse toggle-button>
                <p class="text-gray-500 mt-2">
                    When a person dies, the Power of Attorney ceases to have
                    effect. The Attorney must hand over their responsibilities
                    to the Executors. If a Power of Attorney has been registered
                    with the Office of the Public Guardian then the death
                    certificate must be registered with that office.
                </p>
            </BCollapse>
        </ContentBox>

        <ContentBox title="2.2 Domicile, residence and non-UK assets">
            <yes-no
                collapse
                :openOn="false"
                :label="formData[2].query"
                v-model="formData[2].answer">
                <base-input
                    label-classes="mt-4"
                    :label="formData[2].onFalse[0].query"
                    placeholder="Paris, France"
                    v-model="formData[2].onFalse[0].answer"></base-input>
                <base-input
                    :label="formData[2].onFalse[1].query"
                    placeholder="French"
                    v-model="formData[2].onFalse[1].answer"></base-input>

                <button-group
                    cssGrid
                    :gridColsize="100"
                    class="mb-4"
                    :label="formData[2].onFalse[2].query"
                    :options="['Yes', 'No', 'Unsure']"
                    v-model="formData[2].onFalse[2].answer"></button-group>

                <button-group
                    cssGrid
                    :gridColsize="100"
                    class="mb-4"
                    :label="formData[2].onFalse[3].query"
                    :options="['Yes', 'No', 'Unsure']"
                    v-model="formData[2].onFalse[3].answer"></button-group>

                <div v-show="slide === 1">
                    <div class="mb-4">
                        <label class="flashit">{{ formData[3].query }}</label>
                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Please include a full overview of relevant details to this question"
                            v-model="formData[3].answer"></textarea>
                    </div>
                </div>
                <div v-show="slide === 2">
                    <div class="mb-4">
                        <label class="flashit">{{ formData[4].query }}</label>
                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Please include a full overview of relevant details to this question"
                            v-model="formData[4].answer"></textarea>
                    </div>
                </div>
                <div v-show="slide === 3">
                    <div class="mb-4">
                        <label class="flashit">{{ formData[5].query }}</label>
                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Please include a full overview of relevant details to this question"
                            v-model="formData[5].answer"></textarea>
                    </div>
                </div>
                <div v-show="slide === 4">
                    <div class="mb-4">
                        <label class="flashit">{{ formData[6].query }}</label>
                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Please include a full overview of relevant details to this question"
                            v-model="formData[6].answer"></textarea>
                    </div>
                </div>
                <div v-show="slide === 5">
                    <yes-no
                        class="mb-4"
                        label-class="flashit"
                        :label="formData[7].query"
                        v-model="formData[7].answer">
                    </yes-no>

                    <yes-no
                        class="mb-4"
                        label-class="flashit"
                        :label="formData[8].query"
                        v-model="formData[8].answer">
                    </yes-no>

                    <BCollapse :visible="formData[7].answer === true">
                        <base-input
                            :label="formData[7].onTrue[0].query"
                            placeholder="France"
                            v-model="formData[7].onTrue[0].answer"></base-input>
                        <base-input
                            :label="formData[7].onTrue[1].query"
                            placeholder="French"
                            v-model="formData[7].onTrue[1].answer"></base-input>
                        <base-input
                            :label="formData[7].onTrue[2].query"
                            placeholder="French"
                            v-model="formData[7].onTrue[2].answer"></base-input>
                    </BCollapse>
                </div>
                <div v-show="slide === 6">
                    <div class="mb-4">
                        <label class="flashit">{{ formData[9].query }}</label>
                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Please include a full overview of relevant details to this question"
                            v-model="formData[9].answer"></textarea>
                    </div>
                </div>
                <div v-show="slide === 7">
                    <div class="mb-4">
                        <label class="flashit">{{ formData[10].query }}</label>
                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Please include a full overview of relevant details to this question"
                            v-model="formData[10].answer"></textarea>
                    </div>

                    <div class="mb-4">
                        <button-group
                            cssGrid
                            :gridColsize="100"
                            class="mb-4"
                            :label="formData[11].query"
                            :options="['Yes', 'No', 'Unsure']"
                            v-model="formData[11].answer"></button-group>
                    </div>
                </div>

                <div
                    class="d-sm-flex align-items-center"
                    v-if="formData[2].answer == false">
                    <div class="flex-grow-1">Step {{ slide }}/7</div>
                    <base-button
                        v-if="slide > 1"
                        type="default"
                        outline
                        @click="prevSlide"
                        >Previous</base-button
                    >
                    <base-button
                        v-if="slide < 7"
                        type="default"
                        outline
                        @click="nextSlide"
                        >Next</base-button
                    >
                </div>
            </yes-no>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="nextSection">
                Next section
            </button>
        </ContentBox>
    </div>
</template>
<script setup>
import BCollapse from '@/components/simple/BCollapse.vue';
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import ButtonGroup from '@/components/forms/form-snippets/ButtonGroup.vue';
import { ref, onBeforeMount } from 'vue';
import { useFlashLabel as flashLabel } from '@/composables/helper.js';
import { useCaseStore } from '@/stores/case';
const store = useCaseStore();

const slide = ref(1);

let formData = ref([
    {
        query: 'Did the deceased make an ENDURING power of attorney?',
        answer: null,
        document: null
    },
    {
        query: 'Did the deceased make a Property & Financial Affairs LASTING power of attorney?',
        answer: null,
        document: null
    },
    {
        query: 'Was the deceased born in the UK and did they spend all of their life as a UK resident?',
        answer: null,
        onFalse: [
            {
                query: 'In what City/Country was the deceased born?',
                answer: ''
            },
            {
                query: 'What was their father’s domicile when the deceased was born?',
                answer: ''
            },
            {
                query: 'Was the deceased treated as a UK resident for Income Tax purposes?',
                answer: null
            },
            {
                query: 'Do you know if Sharia Law applies to this estate?',
                answer: null
            }
        ]
    },
    {
        query: 'Education history',
        answer: ''
    },
    {
        query: 'Employment history',
        answer: ''
    },
    {
        query: 'Nationality at Birth',
        answer: ''
    },
    {
        query: 'Nationality at Death',
        answer: ''
    },
    {
        query: 'Was the deceased female?',
        answer: null,
        onTrue: [
            {
                query: 'Where was their husband born?',
                answer: ''
            },
            {
                query: 'What was his nationality at birth?',
                answer: ''
            },
            {
                query: 'What was his nationality at death?',
                answer: ''
            }
        ]
    },
    {
        query: 'Was the deceased born before 1/2/1974?',
        answer: null
    },
    {
        query: 'Details of visits to the UK and the length of those visits',
        answer: ''
    },
    {
        query: 'The countries the deceased lived in',
        answer: ''
    },
    {
        query: 'Do you know if the deceased intended to live in the UK for the rest of their life?',
        answer: null
    }
]);
const nextSlide = () => {
    if (slide.value < 7) {
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
});
</script>

<script>
// URL route for :section parameter
export default {
    routerSectionParam: 'powers-of-attorney',
    navIcon: 'fas fa-pen-nib',
    navLabel: 'Powers of Attorney',
    order: 3
};
</script>

<style lang="scss" scoped></style>
