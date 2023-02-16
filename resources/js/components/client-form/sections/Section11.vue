<template>
    <div class="container">
        <content-box title="Section 10 - Inheritance from other people">
            <p class="text-gray-500">
                If the deceased received a legacy of money or of an asset from
                another person in the last five years then please be alert to
                the details below.
            </p>
        </content-box>

        <content-box title="10.1 Inheritance">
            <yes-no
                :label="formData[0].query"
                v-model="formData[0].answer"
                collapse>
                <label class="mt-4">Who gave them that legacy?</label>
                <honorific v-model="formData[0].onTrue.honorific" />
                <base-input
                    label="Forename"
                    placeholder="John"
                    v-model="formData[0].onTrue.forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="formData[0].onTrue.surname"></base-input>
                <div class="row no-gutters">
                    <div class="col-md-4 form-group">
                        <label>Date of death</label>
                        <datepicker
                            v-model="formData[0].onTrue.date_of_death"
                            class="form-control bg-white"
                            placeholder="Date"
                            format="dd / MM / yy"></datepicker>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-12">
                        <label
                            >What was the value of the inheritance
                            received?</label
                        >
                    </div>
                    <div class="col-md-4">
                        <base-input
                            type="number"
                            placeholder="£200,000"
                            v-model="
                                formData[0].onTrue.value_of_inheritance
                            "></base-input>
                    </div>
                </div>

                <yes-no
                    collapse
                    :label="formData[0].onTrue.query1.query"
                    v-model="formData[0].onTrue.query1.answer">
                    <div
                        v-for="(doc, index) in formData[0].onTrue.query1.onTrue"
                        v-show="activeDoc === index"
                        :key="index">
                        <div class="row no-gutters mt-4 form-group">
                            <div class="col-md-4 mr-md-2 mb-2 mb-md-0">
                                <base-input
                                    placeholder="Document title e.g ‘The Will’"
                                    :form-group="false"
                                    v-model="doc.document_title"></base-input>
                            </div>
                            <div class="col">
                                <client-file-upload
                                    class="m-0"
                                    v-model="doc.document"
                                    @input="saveData" />
                                <a
                                    v-if="doc.document"
                                    :href="doc.document.path"
                                    >{{ doc.document.filename }}</a
                                >
                            </div>
                        </div>

                        <textarea
                            v-model="doc.extra_details"
                            class="form-control mb-4"
                            rows="4"
                            placeholder="Add details including any specific page references"></textarea>
                    </div>
                    <div class="d-sm-flex align-items-center">
                        <div
                            class="flex-grow-1 mb-3"
                            v-show="
                                formData[0].onTrue.query1.onTrue.length > 1
                            ">
                            <b
                                >Document: {{ activeDoc + 1 }} /
                                {{ formData[0].onTrue.query1.onTrue.length }}</b
                            ><br />
                            <a
                                class="remove-doc"
                                href="#"
                                v-if="
                                    formData[0].onTrue.query1.onTrue.length > 1
                                "
                                @click.prevent="removeDoc(activeDoc)"
                                >Remove document</a
                            >
                        </div>
                        <base-button
                            v-if="activeDoc > 0"
                            type="default"
                            outline
                            @click="activeDoc--"
                            >Back</base-button
                        >
                        <base-button
                            type="default"
                            outline
                            @click="addDoc"
                            v-if="
                                activeDoc + 1 ==
                                formData[0].onTrue.query1.onTrue.length
                            "
                            >Add</base-button
                        >
                        <base-button
                            type="default"
                            outline
                            @click="activeDoc++"
                            v-if="
                                activeDoc + 1 <
                                formData[0].onTrue.query1.onTrue.length
                            "
                            >Next</base-button
                        >
                    </div>
                </yes-no>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('received_inheritance', formData);
                    router.push({ name: 'section12' });
                ">
                Next section
            </button>
        </content-box>
    </div>
</template>
<script setup>
import YesNo from '../form-snippets/YesNo.vue';
import Honorific from '../form-snippets/Honorific.vue';
import ClientFileUpload from '../../base-components/ClientFileUpload.vue';
import Datepicker from 'vue3-datepicker';
import { reactive, onBeforeMount, ref } from 'vue';
import { useSaveData as saveData } from '../../../composables/helper';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
const activeDoc = ref(0);
let formData = reactive([
    {
        query: 'In the 5 years before their death, did the deceased inherit money or assets from another person’s estate on which Inheritance Tax was paid?',
        answer: null,
        onTrue: {
            honorific: '',
            forename: '',
            surname: '',
            date_of_death: null,
            value_of_inheritance: '',
            query1: {
                query: 'Do you have the copy of the Will, Grant of Probate or other documents relating to the legacy?',
                onTrue: [
                    {
                        document_title: '',
                        document: null,
                        extra_details: ''
                    }
                ]
            }
        }
    }
]);

const addDoc = () => {
    formData[0].onTrue.query1.onTrue.push({
        document_title: '',
        document: '',
        extra_details: ''
    });
    activeDoc.value++;
};
const removeDoc = (i) => {
    if (i + 1 == formData[0].onTrue.query1.onTrue.length) {
        activeDoc.value--;
    }
    formData[0].onTrue.query1.onTrue.splice(i, 1);
};

onBeforeMount(() => {
    if (store.client) {
        if (store.client.received_inheritance) {
            formData = reactive(
                JSON.parse(store.client.received_inheritance.the_data)
            );
            let date_of_death = formData[0].onTrue.date_of_death;
            formData[0].onTrue.date_of_death = date_of_death
                ? new Date(date_of_death)
                : null;
        }
    }
});
</script>

<style lang="scss" scoped></style>
