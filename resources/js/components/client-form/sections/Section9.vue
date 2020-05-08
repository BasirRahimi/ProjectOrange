<template>
    <div>
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
            <div class="form-group">
                <label for="forename">Forename</label>
                <input type="text" id="forename" class="form-control" placeholder="John" v-model="trust.forename">
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="text" id="surname" class="form-control" placeholder="Doe" v-model="trust.surname">
            </div>

            <yes-no class="form-group" label="Did the deceased have any charge/debit arrangements with this trustee?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <label>Select dependent on which contact details you know:</label>
            <div class="mb-3">
                <base-switch offText="The Trustee" onText="The trustee’s solicitors or accountants" v-model="trust.hasDependant"></base-switch>
            </div>
            <b-collapse :visible="trust.hasDependant">
                <honorific v-model="trust.dependant.honorific"/>
                <div class="form-group">
                    <label for="forename">Forename</label>
                    <input type="text" id="forename" class="form-control" placeholder="John" v-model="trust.dependant.forename">
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" class="form-control" placeholder="Doe" v-model="trust.dependant.surname">
                </div>
            </b-collapse>

            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" id="phone" placeholder="+44 012345 67890" v-model="trust.phone">
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label for="email">Email Address</label>
                    <input type="text" class="form-control" id="email" placeholder="John.doe@doe.co.uk" v-model="trust.email">
                </div>
            </div>
        </content-box>

        <content-box title="8.1 - Nil Rate Band Discretionary Trusts" v-if="trusts.length < 4">
           <div class="text-center">
               <button class="btn btn-outline-secondary active-primary" @click="addTrustee">Add trustee<i class="fas fa-plus ml-3"></i></button>
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
import BaseSwitch from '../../base-components/BaseSwitch.vue';
export default {
    components: {
        YesNo,
        Honorific,
        BaseSwitch
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