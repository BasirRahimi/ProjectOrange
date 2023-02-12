<template>
    <div class="container">
        <content-box title="Section 3 - Other Information">
            <yes-no class="form-group" collapse :label="formData[0].query" v-model="formData[0].answer">
                <client-file-upload class="mt-3" v-model="formData[0].document" @input="saveData" />
                <a v-if="formData[0].document" :href="formData[0].document.path">{{ formData[0].document.filename }}</a>
            </yes-no>
            <yes-no class="form-group" collapse :label="formData[1].query" v-model="formData[1].answer">
                <client-file-upload class="mt-3" v-model="formData[1].document" @input="saveData" />
                <a v-if="formData[1].document" :href="formData[1].document.path">{{ formData[1].document.filename }}</a>
            </yes-no>

            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2">If you hold the original Will (and any codicils), nothing should be
                    pinned, clipped or fastened to it at any time.</p>
            </b-collapse>
        </content-box>

        <content-box title="3.2 The Will (‘Foreign Wills’)">
            <yes-no collapse :label="formData[2].query" v-model="formData[2].answer">
                <yes-no class="mt-4" collapse :label="formData[2].onTrue.query" v-model="formData[2].onTrue.answer">
                    <honorific v-model="formData[2].onTrue.onTrue.honorific" class="mt-4" />
                    <base-input label="Forename" placeholder="John"
                        v-model="formData[2].onTrue.onTrue.forename"></base-input>
                    <base-input label="Surname" placeholder="Doe"
                        v-model="formData[2].onTrue.onTrue.surname"></base-input>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <base-input label="Phone number" placeholder="+44 012345 67890"
                                v-model="formData[2].onTrue.onTrue.phone"></base-input>
                        </div>
                        <div class="col-12 col-lg-6">
                            <base-input label="Email Address" placeholder="John.doe@doe.co.uk" :form-group="false"
                                v-model="formData[2].onTrue.onTrue.email"></base-input>
                        </div>
                    </div>
                </yes-no>
            </yes-no>
        </content-box>

        <content-box title="3.3 If the deceased was a widow or widower">
            <yes-no collapse :label="formData[3].query" v-model="formData[3].answer">
                <label class="my-4">Please add the following details of the spouse who died first:</label>
                <div class="row">
                    <div class="col-lg-4 form-group">
                        <label>Date of death</label>
                        <datepicker input-class="form-control bg-white" v-model="formData[3].onTrue.date_of_death"
                            placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label>Date of marriage</label>
                        <datepicker input-class="form-control bg-white" v-model="formData[3].onTrue.date_of_marriage"
                            placeholder="Date" format="dd / MM / yy"></datepicker>
                    </div>
                </div>
                <base-input label="Forename" placeholder="John" v-model="formData[3].onTrue.forename"></base-input>
                <base-input label="Surname" placeholder="Doe" v-model="formData[3].onTrue.surname"></base-input>

                <label>Please attach the following documents related to the first spouse:</label>
                <p class="text-gray-500 mb-3">All of these documents are necessary to claim Transferable Nil Rate Band.
                    Sometimes the Grant of Probate and Estate accounts are not available, if you cannot locate them,
                    please search.</p>

                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">A marriage certificate</div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload class="mb-0" v-model="formData[3].onTrue.marriage_cert" @input="saveData" />
                        <a v-if="formData[3].onTrue.marriage_cert"
                            :href="formData[3].onTrue.marriage_cert.path">{{ formData[3].onTrue.marriage_cert.filename }}</a>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">Death certificate</div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload class="mb-0" v-model="formData[3].onTrue.death_cert" @input="saveData" />
                        <a v-if="formData[3].onTrue.death_cert"
                            :href="formData[3].onTrue.death_cert.path">{{ formData[3].onTrue.death_cert.filename }}</a>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">Copy of Will</div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload class="mb-0" v-model="formData[3].onTrue.will" @input="saveData" />
                        <a v-if="formData[3].onTrue.will"
                            :href="formData[3].onTrue.will.path">{{ formData[3].onTrue.will.filename }}</a>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">Copy of Codicil(s)</div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload class="mb-0" v-model="formData[3].onTrue.condicils" @input="saveData" />
                        <a v-if="formData[3].onTrue.condicils"
                            :href="formData[3].onTrue.condicils.path">{{ formData[3].onTrue.condicils.filename }}</a>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">Grant of Probate</div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload class="mb-0" v-model="formData[3].onTrue.grant_of_probate"
                            @input="saveData" />
                        <a v-if="formData[3].onTrue.grant_of_probate"
                            :href="formData[3].onTrue.grant_of_probate.path">{{ formData[3].onTrue.grant_of_probate.filename }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-3 d-flex align-items-center mb-1">Estate accounts</div>
                    <div class="col d-flex align-items-center">
                        <client-file-upload class="mb-0" v-model="formData[3].onTrue.estate_accounts"
                            @input="saveData" />
                        <a v-if="formData[3].onTrue.estate_accounts"
                            :href="formData[3].onTrue.estate_accounts.path">{{ formData[3].onTrue.estate_accounts.filename }}</a>
                    </div>
                </div>
            </yes-no>
        </content-box>
        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData(); routerPush('section5');">Next section</button>
        </content-box>
    </div>
</template>

<script>
import ClientFileUpload from '../../base-components/ClientFileUpload.vue';
import Honorific from '../form-snippets/Honorific.vue';
import Datepicker from 'vuejs-datepicker';
import YesNo from '../form-snippets/YesNo.vue';
export default {
    components: {
        ClientFileUpload,
        Honorific,
        Datepicker,
        YesNo
    },
    data() {
        return {
            section: 'will',
            formData: [
                {
                    query: 'Did the deceased make a Will?',
                    answer: null,
                    document: null
                },
                {
                    query: 'Did the deceased make any Codicils?',
                    answer: null,
                    document: null
                },
                {
                    query: 'Did the deceased make a Will under a different law?',
                    answer: null,
                    onTrue: {
                        query: 'Is there another lawyer advising on the non-UK process?',
                        answer: null,
                        onTrue: {
                            honorific: '',
                            forename: '',
                            surname: '',
                            phone: '',
                            email: ''
                        }
                    }
                },
                {
                    query: 'Was the deceased a widow or widower?',
                    answer: null,
                    onTrue: {
                        date_of_death: '',
                        date_of_marriage: '',
                        forename: '',
                        surname: '',
                        marriage_cert: null,
                        death_cert: null,
                        will: null,
                        condicils: null,
                        grant_of_probate: null,
                        estate_accounts: null
                    }
                }
            ],
        }
    },
    beforeMount() {
        if (this.$store.state.client) {
            if (this.$store.state.client.will) {
                this.formData = JSON.parse(this.$store.state.client.will.the_data);
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>