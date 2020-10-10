<template>
    <div class="container">
        <content-box title="Section 10 - Inheritance from other people">
            <p class="text-gray-500">If the deceased received a legacy of money or of an asset from another person in the last five years then please be alert to the details below.</p>
        </content-box>

        <content-box title="10.1 Inheritance">
            <yes-no :label="formData[0].query" v-model="formData[0].answer" collapse>
                <label class="mt-4">Who gave them that legacy?</label>
                <honorific v-model="formData[0].onTrue.honorific"/>
                <base-input
                    label="Forename"
                    placeholder="John" v-model="formData[0].onTrue.forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe" v-model="formData[0].onTrue.surname"></base-input>
                <div class="row no-gutters">
                    <div class="col-md-4 form-group">
                        <label>Date of death</label>
                        <datepicker v-model="formData[0].onTrue.date_of_death" input-class="form-control bg-white" placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-12">
                        <label>What was the value of the inheritance received?</label>
                    </div>
                    <div class="col-md-4">
                        <base-input
                            type="number"
                            placeholder="£200,000"
                            v-model="formData[0].onTrue.value_of_inheritance"></base-input>
                    </div>
                </div>

                <yes-no collapse :label="formData[0].onTrue.query1.query" v-model="formData[0].onTrue.query1.answer">
                    <div v-for="(doc,index) in formData[0].onTrue.query1.onTrue" v-show="activeDoc === index" :key="index">
                        <div class="row no-gutters mt-4 form-group">
                            <div class="col-md-4 mr-md-2 mb-2 mb-md-0">
                                <base-input
                                    placeholder="Document title e.g ‘The Will’"
                                    :form-group="false"
                                    v-model="doc.document_title"></base-input>
                            </div>
                            <div class="col">
                                <client-file-upload class="m-0" v-model="doc.document" @input="saveData"/>
                                <a v-if="doc.document" :href="doc.document.path">{{doc.document.filename}}</a>
                            </div>
                        </div>

                        <textarea v-model="doc.extra_details" class="form-control mb-4" rows="4" placeholder="Add details including any specific page references"></textarea>
                    </div>
                    <div class="d-sm-flex align-items-center">
                        <div class="flex-grow-1 mb-3" v-show="formData[0].onTrue.query1.onTrue.length > 1">
                            <b>Document: {{activeDoc + 1}} / {{formData[0].onTrue.query1.onTrue.length}}</b><br>
                            <a class="remove-doc" href="#" v-if="formData[0].onTrue.query1.onTrue.length > 1" @click.prevent="removeDoc(activeDoc)">Remove document</a>
                        </div>
                        <base-button v-if="activeDoc > 0" type="default" outline @click="activeDoc--">Back</base-button>
                        <base-button type="default" outline @click="addDoc" v-if="activeDoc + 1 == formData[0].onTrue.query1.onTrue.length">Add</base-button>
                        <base-button type="default" outline @click="activeDoc++" v-if="activeDoc + 1 < formData[0].onTrue.query1.onTrue.length">Next</base-button>
                    </div>
                </yes-no>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData();routerPush('section12');">Next section</button>
        </content-box>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import YesNo from '../form-snippets/YesNo';
import Honorific from '../form-snippets/Honorific';
import ClientFileUpload from '../../base-components/ClientFileUpload';
export default {
    components: {
        YesNo,
        Honorific,
        Datepicker,
        ClientFileUpload
    },
    data() {
        return {
            section: 'received_inheritance',
            activeDoc: 0,
            formData: [
                {
                    query: 'In the 5 years before their death, did the deceased inherit money or assets from another person’s estate on which Inheritance Tax was paid?',
                    answer: null,
                    onTrue: {
                        honorific: '',
                        forename: '',
                        surname: '',
                        date_of_death: '',
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
            ]
        }
    },
    beforeMount() {
        if(this.$store.state.client) {
            if(this.$store.state.client.received_inheritance) {
                this.formData = JSON.parse(this.$store.state.client.received_inheritance.the_data);
            }
        }
    },
    methods: {
        addDoc() {
            this.formData[0].onTrue.query1.onTrue.push({document_title: '', document: '', extra_details: ''});
            this.activeDoc++;
        },
        removeDoc(i) {
            if(i+1 == this.formData[0].onTrue.query1.onTrue.length) {
                this.activeDoc--;
            }
            this.formData[0].onTrue.query1.onTrue.splice(i,1);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>