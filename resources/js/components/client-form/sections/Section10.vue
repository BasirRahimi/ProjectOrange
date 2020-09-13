<template>
    <div class="container">
        <content-box title="Section 9 - Business interests or partnerships">
            <yes-no class="form-group" :label="formData[0].query" v-model="formData[0].answer" collapse>
                <base-input
                    label="Company name"
                    class="mt-4"
                    placeholder="John Appleseed Ltd"
                    v-model="formData[0].onTrue.company_name"></base-input>
                <base-input
                    label="Company number"
                    placeholder="1235 1235 08311"
                    v-model="formData[0].onTrue.company_number"></base-input>
                <base-input
                    label="Business activity"
                    placeholder="Import & export"
                    v-model="formData[0].onTrue.business_activity"></base-input>

                <label>Company accountant details</label>
                <honorific v-model="formData[0].onTrue.accountant.honorific" />
                <base-input
                    label="Forename"
                    placeholder="John"
                    v-model="formData[0].onTrue.accountant.forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="formData[0].onTrue.accountant.surname"></base-input>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890"
                            v-model="formData[0].onTrue.accountant.phone"></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk"
                            v-model="formData[0].onTrue.accountant.email"></base-input>
                    </div>
                </div>

                <label>If the company accountants have valued the shares in the business in line with HMRC guidelines then please provide a copy</label><br />
                <base-file-upload v-model="formData[0].onTrue.valuation" />
            </yes-no>

            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2 mb-0">You should take care that the deceased had regularised their affairs with HMRC. For example, the Jersey Disclosure Facility provides for a voluntary disclosure facility to UK residents from 6 April 2013 to 30 September 2016 for UK residents with a beneficial interest in Jersey “relevant property”, with undisclosed UK tax liabilities, with a chance to regularise their UK tax affairs in a controlled manner on beneficial terms.</p>
            </b-collapse>
        </content-box>

        <content-box title="9.2 Partnerships">
            <yes-no :label="formData[1].query" v-model="formData[1].answer" collapse>
                <base-input
                    label="Company name"
                    class="mt-4"
                    placeholder="John Appleseed Ltd"
                    v-model="formData[1].onTrue.company_name"></base-input>
                <base-input
                    label="Company number"
                    placeholder="1235 1235 08311"
                    v-model="formData[1].onTrue.company_number"></base-input>
                <base-input
                    label="Business activity"
                    placeholder="Import & export"
                    v-model="formData[1].onTrue.business_activity"></base-input>

                <label>Company accountant details</label>
                <honorific v-model="formData[1].onTrue.accountant.honorific" />
                <base-input
                    label="Forename"
                    placeholder="John"
                    v-model="formData[1].onTrue.accountant.forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="formData[1].onTrue.accountant.surname"></base-input>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890"
                            v-model="formData[1].onTrue.accountant.phone"></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk"
                            v-model="formData[1].onTrue.accountant.email"></base-input>
                    </div>
                </div>

                <label>If the company accountants have valued the shares in the business in line with HMRC guidelines then please provide a copy</label><br />
                <base-file-upload v-model="formData[1].onTrue.valuation"/>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData('business_interests'); routerPush('section11');">Next section</button>
        </content-box>
    </div>
</template>

<script>
import BaseFileUpload from '../../base-components/BaseFileUpload.vue';
import YesNo from '../form-snippets/YesNo.vue';
import Honorific from '../form-snippets/Honorific.vue';
export default {
    components: {
        YesNo,
        Honorific,
        BaseFileUpload
    },
    data() {
        return {
            formData: [
                {
                    query: 'Did the deceased own shares in a private company?',
                    answer: null,
                    onTrue: {
                        company_name: '',
                        company_number: '',
                        business_activity: '',
                        accountant: {
                            honorific: '',
                            forename: '',
                            surname: '',
                            phone: '',
                            email: ''
                        },
                        valuation: ''
                    }
                },
                {
                    query: 'Was the deceased a member of a partnership?',
                    answer: null,
                    onTrue: {
                        company_name: '',
                        company_number: '',
                        business_activity: '',
                        accountant: {
                            honorific: '',
                            forename: '',
                            surname: '',
                            phone: '',
                            email: ''
                        },
                        valuation: ''
                    }
                }
            ]
        }
    },
    beforeMount() {
        if(this.$store.state.client) {
            if(this.$store.state.client.business_interests) {
                this.formData = JSON.parse(this.$store.state.client.business_interests.the_data);
            }
        }
    },
}
</script>

<style lang="scss" scoped>

</style>