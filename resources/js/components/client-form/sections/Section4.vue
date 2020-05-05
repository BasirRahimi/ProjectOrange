<template>
    <div>
        <content-box title="Section 3 - Other Information">
            <div class="row">
                <div class="col-12 mb-3">
                    <label>Did the deceased make a Will?</label><br />
                    <button class="btn btn-outline-secondary active-primary mr-3 mb-3" :class="{'active': formData.query1.answer === true}" @click="formData.query1.answer = true">Yes</button>
                    <button class="btn btn-outline-secondary active-primary mr-3 mb-3" :class="{'active': formData.query1.answer === false}" @click="formData.query1.answer = false">No</button><br />
                    <b-collapse :visible="formData.query1.answer === true">
                        <base-file-upload class="mb-3"></base-file-upload>
                    </b-collapse>
                </div>
                <div class="col-12 mb-3">
                    <label>Did the deceased make any Codicils?</label><br />
                    <button class="btn btn-outline-secondary active-primary mr-3 mb-3" :class="{'active': formData.query2.answer === true}" @click="formData.query2.answer = true">Yes</button>
                    <button class="btn btn-outline-secondary active-primary mr-3 mb-3" :class="{'active': formData.query2.answer === false}" @click="formData.query2.answer = false">No</button><br />
                    <b-collapse :visible="formData.query2.answer === true">
                        <base-file-upload class="mb-3"></base-file-upload>
                    </b-collapse>
                </div>
            </div>

            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2">If you hold the original Will (and any codicils), nothing should be pinned, clipped or fastened to it at any time.</p>
            </b-collapse>
        </content-box>

        <content-box title="3.2 The Will (‘Foreign Wills’)">
            <div class="row">
                <div class="col-12 mb-4">
                    <label>Did the deceased make a Will under a different law?</label><br />
                    <button class="btn btn-outline-secondary active-primary mr-3" :class="{'active': formData.query3.answer === true}" @click="formData.query3.answer = true">Yes</button>
                    <button class="btn btn-outline-secondary active-primary mr-3" :class="{'active': formData.query3.answer === false}" @click="formData.query3.answer = false">No</button>
                </div>
                <b-collapse :visible="formData.query3.answer === true" class="col-12">
                    <div class="mb-4">
                        <label>Is there another lawyer advising on the non-UK process?</label><br />
                        <button class="btn btn-outline-secondary active-primary mr-3" :class="{'active': formData.query3.answer2 === true}" @click="formData.query3.answer2 = true">Yes</button>
                        <button class="btn btn-outline-secondary active-primary mr-3" :class="{'active': formData.query3.answer2 === false}" @click="formData.query3.answer2 = false">No</button>
                    </div>

                    <b-collapse :visible="formData.query3.answer2 === true">
                        <honorific v-model="formData.query3.honorific" />
                        <div class="mb-4">
                            <label for="forename">Forename</label>
                            <input type="text" id="forename" class="form-control" placeholder="John" v-model="formData.query3.forename">
                        </div>
                        <div class="mb-4">
                            <label for="surname">Surname</label>
                            <input type="text" id="surname" class="form-control" placeholder="Doe" v-model="formData.query3.surname">
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4">
                                <label for="phone">Phone number</label>
                                <input type="text" class="form-control" id="phone" placeholder="+44 012345 67890" v-model="formData.query3.phone">
                            </div>
                            <div class="col-12 col-lg-6 mb-4">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" id="email" placeholder="John.doe@doe.co.uk" v-model="formData.query3.email">
                            </div>
                        </div>
                    </b-collapse>
                </b-collapse>
                
            </div>
        </content-box>

        <content-box title="3.3 If the deceased was a widow or widower">
            <div class="row">
                <div class="col-12">
                    <label>Was the deceased a widow or widower?</label><br />
                    <button class="btn btn-outline-secondary active-primary mr-3" :class="{'active': formData.query4.answer === true}" @click="formData.query4.answer = true">Yes</button>
                    <button class="btn btn-outline-secondary active-primary mr-3" :class="{'active': formData.query4.answer === false}" @click="formData.query4.answer = false">No</button><br />
                </div>
            </div>
            <b-collapse :visible="formData.query4.answer === true">
                <label class="my-4">Please add the following details of the spouse who died first:</label>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <label>Date of death</label>
                        <datepicker input-class="form-control bg-white" v-model="formData.query4.deathDate" placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <label>Date of marriage</label>
                        <datepicker input-class="form-control bg-white" v-model="formData.query4.marriageDate" placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="forename">Forename</label>
                    <input type="text" id="forename" class="form-control" placeholder="John" v-model="formData.query4.forename">
                </div>
                <div class="mb-4">
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" class="form-control" placeholder="Doe" v-model="formData.query4.surname">
                </div>
                <label>Please attach the following documents related to the first spouse:</label>
                <p class="text-gray-500 mb-3">All of these documents are necessary to claim Transferable Nil Rate Band. Sometimes the Grant of Probate and Estate accounts are not available, if you cannot locate them, please search.</p>
                <div class="row mb-1">
                    <div class="col-6 col-lg-3 d-flex align-items-center">A marriage certificate</div>
                    <div class="col-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-3" /></div>
                </div>
                <div class="row mb-1">
                    <div class="col-6 col-lg-3 d-flex align-items-center">Death certificate</div>
                    <div class="col-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-3" /></div>
                </div>
                <div class="row mb-1">
                    <div class="col-6 col-lg-3 d-flex align-items-center">Copy of Will</div>
                    <div class="col-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-3" /></div>
                </div>
                <div class="row mb-1">
                    <div class="col-6 col-lg-3 d-flex align-items-center">Copy of Codicil(s)</div>
                    <div class="col-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-3" /></div>
                </div>
                <div class="row mb-1">
                    <div class="col-6 col-lg-3 d-flex align-items-center">Grant of Probate</div>
                    <div class="col-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-3" /></div>
                </div>
                <div class="row mb-1">
                    <div class="col-6 col-lg-3 d-flex align-items-center">Estate accounts</div>
                    <div class="col-6 col-lg-3 d-flex align-items-center"><base-file-upload class="mb-3" /></div>
                </div>
            </b-collapse>
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
export default {
    components: {
        BaseFileUpload,
        Honorific,
        Datepicker
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