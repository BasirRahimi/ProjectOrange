<template>
    <div class="container">
        <content-box title="Section 10 - Inheritance from other people">
            <p class="text-gray-500">If the deceased received a legacy of money or of an asset from another person in the last five years then please be alert to the details below.</p>
        </content-box>

        <content-box title="10.1 Inheritance">
            <yes-no label="In the 5 years before their death, did the deceased inherit money or assets from another person’s estate on which Inheritance Tax was paid?" collapse>
                <label class="mt-4">Who gave them that legacy?</label>
                <honorific />
                <base-input
                    label="Forename"
                    placeholder="John"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"></base-input>
                <div class="row no-gutters">
                    <div class="col-md-4 form-group">
                        <label>Date of death</label>
                        <datepicker input-class="form-control bg-white" placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-12">
                        <label>What was the value of the inheritance received?</label>
                    </div>
                    <div class="col-md-4">
                        <base-input
                            type="number"
                            placeholder="£200,000"></base-input>
                    </div>
                </div>

                <yes-no collapse label="Do you have the copy of the Will, Grant of Probate or other documents relating to the legacy?">
                    <div v-for="(doc,index) in docs" v-show="activeDoc === index" :key="index">
                        <div class="row no-gutters mt-4 form-group" :key="index">
                            <div class="col-md-4 mr-md-2 mb-2 mb-md-0">
                                <base-input
                                    placeholder="Document title e.g ‘The Will’"
                                    :form-group="false"></base-input>
                            </div>
                            <div class="col">
                                <base-file-upload class="m-0" />
                            </div>
                        </div>

                        <textarea :key="`details${index}`" class="form-control mb-4" rows="4" placeholder="Add details including any specific page references"></textarea>
                    </div>
                    <div class="d-sm-flex align-items-center">
                        <div class="flex-grow-1 mb-3" v-show="docs.length > 1"><b>Document: {{activeDoc + 1}}</b></div>
                        <base-button v-if="activeDoc > 0" type="default" outline @click="activeDoc--">Back</base-button>
                        <base-button type="default" outline @click="addDoc" v-if="activeDoc + 1 == docs.length">Add</base-button>
                        <base-button type="default" outline @click="activeDoc++" v-if="activeDoc + 1 < docs.length">Next</base-button>
                    </div>
                </yes-no>
            </yes-no>
        </content-box>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import YesNo from '../form-snippets/YesNo';
import Honorific from '../form-snippets/Honorific';
import BaseFileUpload from '../../base-components/BaseFileUpload';
export default {
    components: {
        YesNo,
        Honorific,
        Datepicker,
        BaseFileUpload
    },
    data() {
        return {
            activeDoc: 0,
            docs: [{title:'', file: null}]
        }
    },
    methods: {
        addDoc() {
            this.docs.push({title: '', file: null});
            this.activeDoc++;
        }
    }
}
</script>

<style lang="scss" scoped>

</style>