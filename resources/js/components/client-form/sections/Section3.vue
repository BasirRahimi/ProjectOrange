<template>
    <div class="container">
        <content-box title="Section 2 - Powers of Attorney and non-UK elements">
            <yes-no
                class="form-group"
                :label="formData[0].query"
                collapse
                v-model="formData[0].answer">
                <client-file-upload
                    class="mt-3"
                    v-model="formData[0].document"></client-file-upload>
                <a
                    v-if="formData[0].document"
                    :href="formData[0].document.path"
                    >{{ formData[0].document.filename }}</a
                >
            </yes-no>
            <yes-no
                class="form-group"
                :label="formData[1].query"
                collapse
                v-model="formData[1].answer">
                <client-file-upload
                    class="mt-3"
                    v-model="formData[1].document"></client-file-upload>
                <a
                    v-if="formData[1].document"
                    :href="formData[1].document.path"
                    >{{ formData[1].document.filename }}</a
                >
            </yes-no>

            <BaseButton
                @click="collapse.collapse1 = !collapse.collapse1"
                class="pointer"
                >Tip<i class="icon-xs fas fa-chevron-down ml-2"></i
            ></BaseButton>
            <b-collapse :visible="collapse.collapse1" id="collapse1">
                <p class="text-gray-500 mt-2">
                    When a person dies, the Power of Attorney ceases to have
                    effect. The Attorney must hand over their responsibilities
                    to the Executors. If a Power of Attorney has been registered
                    with the Office of the Public Guardian then the death
                    certificate must be registered with that office.
                </p>
            </b-collapse>
        </content-box>

        <content-box title="2.2 Domicile, residence and non-UK assets">
            <yes-no
                collapse
                :collapseOn="false"
                :label="formData[2].query"
                v-model="formData[2].answer">
                <base-input
                    class="mt-4"
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
                    class="form-group"
                    :label="formData[2].onFalse[2].query"
                    :options="['Yes', 'No', 'Unsure']"
                    v-model="formData[2].onFalse[2].answer"></button-group>

                <button-group
                    cssGrid
                    :gridColsize="100"
                    class="form-group"
                    :label="formData[2].onFalse[3].query"
                    :options="['Yes', 'No', 'Unsure']"
                    v-model="formData[2].onFalse[3].answer"></button-group>
            </yes-no>
        </content-box>

        <content-box title="2.3 A brief narrative of the life of the deceased">
            <div v-show="slide === 1">
                <div class="form-group">
                    <label class="flashit">{{ formData[3].query }}</label>
                    <textarea
                        class="form-control"
                        rows="4"
                        placeholder="Please include a full overview of relevant details to this question"
                        v-model="formData[3].answer"></textarea>
                </div>
            </div>
            <div v-show="slide === 2">
                <div class="form-group">
                    <label class="flashit">{{ formData[4].query }}</label>
                    <textarea
                        class="form-control"
                        rows="4"
                        placeholder="Please include a full overview of relevant details to this question"
                        v-model="formData[4].answer"></textarea>
                </div>
            </div>
            <div v-show="slide === 3">
                <div class="form-group">
                    <label class="flashit">{{ formData[5].query }}</label>
                    <textarea
                        class="form-control"
                        rows="4"
                        placeholder="Please include a full overview of relevant details to this question"
                        v-model="formData[5].answer"></textarea>
                </div>
            </div>
            <div v-show="slide === 4">
                <div class="form-group">
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
                    class="form-group"
                    label-class="flashit"
                    :label="formData[7].query"
                    v-model="formData[7].answer">
                </yes-no>

                <yes-no
                    class="form-group"
                    label-class="flashit"
                    :label="formData[8].query"
                    v-model="formData[8].answer">
                </yes-no>

                <b-collapse :visible="formData[7].answer === true">
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
                </b-collapse>
            </div>
            <div v-show="slide === 6">
                <div class="form-group">
                    <label class="flashit">{{ formData[9].query }}</label>
                    <textarea
                        class="form-control"
                        rows="4"
                        placeholder="Please include a full overview of relevant details to this question"
                        v-model="formData[9].answer"></textarea>
                </div>
            </div>
            <div v-show="slide === 7">
                <div class="form-group">
                    <label class="flashit">{{ formData[10].query }}</label>
                    <textarea
                        class="form-control"
                        rows="4"
                        placeholder="Please include a full overview of relevant details to this question"
                        v-model="formData[10].answer"></textarea>
                </div>

                <div class="form-group">
                    <button-group
                        cssGrid
                        :gridColsize="100"
                        class="form-group"
                        :label="formData[11].query"
                        :options="['Yes', 'No', 'Unsure']"
                        v-model="formData[11].answer"></button-group>
                </div>
            </div>

            <div class="d-sm-flex align-items-center">
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

            <BaseButton
                @click="collapse.collapse2 = !collapse.collapse2"
                class="pointer"
                >Tip<i class="icon-xs fas fa-chevron-down ml-2"></i
            ></BaseButton>
            <b-collapse :visible="collapse.collapse2" id="collapse2">
                <p class="text-gray-500 mt-2">
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
            </b-collapse>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('powers_of_attorney', formData);
                    router.push({ name: 'section4' });
                ">
                Next section
            </button>
        </content-box>
    </div>
</template>
<script setup>
import ClientFileUpload from '../../base-components/ClientFileUpload.vue';
import YesNo from '../form-snippets/YesNo.vue';
import ButtonGroup from '../form-snippets/ButtonGroup.vue';
import { ref, reactive, onBeforeMount } from 'vue';
import {
    useFlashLabel as flashLabel,
    useSaveData as saveData
} from '../../../composables/helper';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();

const slide = ref(1);
const collapse = reactive({
    collapse1: false,
    collapse2: false
});
let formData = reactive([
    {
        query: 'Did the deceased make an ENDURING power of attorney?',
        answer: null,
        document: null
    },
    {
        query: 'Did the deceased make a LASTING power of attorney?',
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
        query: 'Do you know if the deceased intended to live in the UK for the rest of their lives?',
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
onBeforeMount(() => {
    if (store.client) {
        if (store.client.powers_of_attorney) {
            formData = JSON.parse(store.client.powers_of_attorney.the_data);
        }
    }
});
</script>

<style lang="scss" scoped></style>
