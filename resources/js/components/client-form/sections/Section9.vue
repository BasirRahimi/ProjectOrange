<template>
    <div class="container">
        <content-box title="Section 8 - Nil Rate Band Discretionary Trusts">
            <p class="text-gray-500">The nil rate band is also called the Inheritance tax threshold. It represents the first part of the estate which is taxed at 0%. On 5.4.2016 this threshold was £325,000.</p>
            <p class="text-gray-500">
                If the deceased was a widow or widower, you have been asked in section to give details of the estate of the first spouse to die. This is necessary to claim both the deceased’s nil-rate band plus the nil rate band of the first spouse to die.<br />
                Therefore, up to £650,000 of the estate can pass free of tax, but this is not always so.<br />
                If the first spouse to die created a Nil Rate Band Discretionary Trust in their Will, the transferrable nil rate band may not be available.<br />
                If you have provided a copy of the Will of the first spouse to die in response to the questions in 3.3 then details of any Trust will be seen.
            </p>
        </content-box>
        
        <content-box title="8.1 - Nil Rate Band Discretionary Trusts" v-for="(trust, key) in trusts" :key="key">
            <p class="text-gray-500">If you know details of any Nil Rate Band Discretionary Trust, then please provide the following information:-</p>
            <honorific v-model="trust.honorific" />
            <base-input
                label="Forename"
                placeholder="John"></base-input>
            <base-input
                label="Surname"
                placeholder="Doe"></base-input>

            <yes-no class="form-group" label="Did the deceased have any charge/debit arrangements with this trustee?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <div class="form-group">
                <label>Select dependent on which contact details you know:</label>
                <switch-with-text 
                    v-model="trust.hasDependant"
                    left-text="The Trustee"
                    right-text="The trustee’s solicitors or accountants"/>
            </div>
            <!-- <base-switch v-model="trust.hasDependant"/> -->
            <!-- <div class="form-group d-flex">
                <div :class="{'text-gray-500':trust.hasDependant}" @click="trust.hasDependant = true">The Trustee</div>
                <div>
                    <base-switch coloured @input="val=>{trust.hasDependant = val}" class="m-0"></base-switch>
                </div>
                <div :class="{'text-gray-500':!trust.hasDependant}" @click="trust.hasDependant = false">The trustee’s solicitors or accountants</div>
            </div> -->
            <b-collapse :visible="trust.hasDependant == true">
                <honorific v-model="trust.dependant.honorific"/>
                <base-input
                    label="Forename"
                    placeholder="John"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"></base-input>
            </b-collapse>

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
        </content-box>

        <content-box title="8.1 - Nil Rate Band Discretionary Trusts" v-if="trusts.length < 4">
            <div class="text-center">
                <base-button
                    type="default"
                    outline
                    @click="addTrustee">Add trustee<i class="fas fa-plus ml-3"></i></base-button>
            </div>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section10'})">Next section</button>
        </content-box>
    </div>
</template>

<script>
import YesNo from '../form-snippets/YesNo.vue';
import Honorific from '../form-snippets/Honorific.vue';
import SwitchWithText from '../form-snippets/SwitchWithText.vue';
export default {
    components: {
        YesNo,
        Honorific,
        SwitchWithText
    },
    data() {
        return {
            trusts: []
        }
    },
    methods: {
        addTrustee() {
            this.trusts.push({
                honorific: '',
                hasDependant: false,
                forename: '',
                surname: '',
                phone: '',
                email: '',
                dependant: {
                    honorific: '',
                    forename: '',
                    surname: ''
                }
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>