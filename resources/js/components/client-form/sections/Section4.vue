<template>
    <div class="container">
        <content-box title="Section 3 - Other Information">
            <yes-no class="form-group" collapse label="Did the deceased make a Will?">
                <base-file-upload class="mt-3"></base-file-upload>
            </yes-no>
            <yes-no class="form-group" collapse label="Did the deceased make any Codicils?">
                <base-file-upload class="mt-3"></base-file-upload>
            </yes-no>

            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2">If you hold the original Will (and any codicils), nothing should be pinned, clipped or fastened to it at any time.</p>
            </b-collapse>
        </content-box>

        <content-box title="3.2 The Will (‘Foreign Wills’)">
            <yes-no collapse label="Did the deceased make a Will under a different law?">
                <yes-no class="mt-4" collapse label="Is there another lawyer advising on the non-UK process?">
                    <honorific v-model="formData.query3.honorific" class="mt-4" />
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
                                placeholder="John.doe@doe.co.uk"
                                :form-group="false"></base-input>
                        </div>
                    </div>
                </yes-no>
            </yes-no>
        </content-box>

        <content-box title="3.3 If the deceased was a widow or widower">
            <yes-no collapse label="Was the deceased a widow or widower?">
                <label class="my-4">Please add the following details of the spouse who died first:</label>
                <div class="row">
                    <div class="col-lg-4 form-group">
                        <label>Date of death</label>
                        <datepicker input-class="form-control bg-white" v-model="formData.query4.deathDate" placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label>Date of marriage</label>
                        <datepicker input-class="form-control bg-white" v-model="formData.query4.marriageDate" placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                </div>
                <base-input
                        label="Forename"
                        placeholder="John"></base-input>
                    <base-input
                        label="Surname"
                        placeholder="Doe"></base-input>

                <label>Please attach the following documents related to the first spouse:</label>
                <p class="text-gray-500 mb-3">All of these documents are necessary to claim Transferable Nil Rate Band. Sometimes the Grant of Probate and Estate accounts are not available, if you cannot locate them, please search.</p>
                
                <div class="row mb-2">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center mb-1">A marriage certificate</div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-0" /></div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center mb-1">Death certificate</div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-0" /></div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center mb-1">Copy of Will</div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-0" /></div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center mb-1">Copy of Codicil(s)</div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-0" /></div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center mb-1">Grant of Probate</div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-0" /></div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center mb-1">Estate accounts</div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-0" /></div>
                </div>
            </yes-no>
        </content-box>
        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section5'})">Next section</button>
        </content-box>
    </div>
</template>

<script>
import BaseFileUpload from '../../base-components/BaseFileUpload.vue';
import Honorific from '../form-snippets/Honorific.vue';
import Datepicker from 'vuejs-datepicker';
import YesNo from '../form-snippets/YesNo.vue'
export default {
    components: {
        BaseFileUpload,
        Honorific,
        Datepicker,
        YesNo
    },
    data() {
        return {
            formData: {
                query1: {
                    answer: null
                },
                query2: {
                    answer: null
                },
                query3: {
                    answer: null,
                    answer2: null,
                    forename: '',
                    surname: '',
                    phone: '',
                    email: '',
                    honorific: ''
                },
                query4: {
                    answer: null,
                    deathDate: null,
                    marriageDate: null,
                    forename: '',
                    surname: '',
                }
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>