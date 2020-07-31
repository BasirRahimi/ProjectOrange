<template>
    <div class="container">
        <content-box title="Section 11 - Trusts in which the deceased had an interest">
            <yes-no collapse label="Was the deceased entitled to benefit from a trust that was created by a Deed or under another’s person’s Will (or intestacy)?">
                <label class="mt-4">Who created the trust?</label>
                
                <honorific />
                
                <base-input
                    label="Forename"
                    placeholder="John"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"></base-input>
                
                <label>The date it was created / date of death of the person who died</label>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <datepicker input-class="form-control bg-white" placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                </div>

                <label>What was the nature of the inheritance received?</label>
                <textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <label>What was the value of the inheritance received?</label>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <base-input
                            type="number"
                            placeholder="£240,000"
                            min="0"></base-input>
                    </div>
                </div>

                <label>The names of the trustees</label>
                <p class="text-gray-500 mb-2">Please separate each name with a comma</p>
                <textarea class="form-control mb-4" rows="4" placeholder="John Doe, Johnny Appleseed"></textarea>

                <label>Please add the contact details of one of the following</label>
                <switch-with-text
                    left-text="Their Solicitors"
                    right-text="Their accountants"
                    class="form-group"></switch-with-text>

                <honorific />
                <base-input
                    label="Forename"
                    placeholder="John"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"></base-input>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890"></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk"></base-input>
                    </div>
                </div>

                <label>If you have a copy of the trust documents please include details below and upload the relevant documents too</label>
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
                <div class="d-sm-flex align-items-center mb-4">
                    <div class="flex-grow-1 mb-3" v-show="docs.length > 1"><b>Document: {{activeDoc + 1}}</b></div>
                    <base-button v-if="activeDoc > 0" type="default" outline @click="activeDoc--">Back</base-button>
                    <base-button type="default" outline @click="addDoc" v-if="activeDoc + 1 == docs.length">Add</base-button>
                    <base-button type="default" outline @click="activeDoc++" v-if="activeDoc + 1 < docs.length">Next</base-button>
                </div>

                <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
                <b-collapse visible id="collapse1">
                    <p class="text-gray-500 mt-2 mb-0">Domicile and residence is relevant because it affects the law that governs succession. Since 17.8.2016 a new European Regulation affects succession within EU member states. The UK and Eire have not opted in to the Regulation (Denmark has opted out) but it will nonetheless affect individuals connected with the EU. If you are a beneficiary of this estate and there are non-UK assets involved, you should consider your own Will now. Do not wait until the estate has been administered.</p>
                </b-collapse>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section13'})">Next section</button>
        </content-box>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import YesNo from '../form-snippets/YesNo';
import Honorific from '../form-snippets/Honorific';
import BaseFileUpload from '../../base-components/BaseFileUpload';
import SwitchWithText from '../form-snippets/SwitchWithText';
export default {
    components: {
        YesNo,
        Honorific,
        Datepicker,
        BaseFileUpload,
        SwitchWithText
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