<template>
    <div class="container">
        <content-box title="Section 8 - Nil Rate Band Discretionary Trusts">
            <p class="text-gray-500">
                The nil rate band is also called the Inheritance tax threshold.
                It represents the first part of the estate which is taxed at 0%.
                On 5.4.2016 this threshold was £325,000.
            </p>
            <p class="text-gray-500">
                If the deceased was a widow or widower, you have been asked in
                section to give details of the estate of the first spouse to
                die. This is necessary to claim both the deceased’s nil-rate
                band plus the nil rate band of the first spouse to die.<br />
                Therefore, up to £650,000 of the estate can pass free of tax,
                but this is not always so.<br />
                If the first spouse to die created a Nil Rate Band Discretionary
                Trust in their Will, the transferrable nil rate band may not be
                available.<br />
                If you have provided a copy of the Will of the first spouse to
                die in response to the questions in 3.3 then details of any
                Trust will be seen.
            </p>
        </content-box>

        <content-box
            title="8.1 - Nil Rate Band Discretionary relative"
            class="relative"
            v-for="(trust, key) in formData"
            :key="key">
            <a
                class="remove-trustee"
                href="#"
                v-if="formData.length > 1"
                @click.prevent="removeTrustee(key)"
                >Remove Trustee</a
            >
            <p class="text-gray-500">
                If you know details of any Nil Rate Band Discretionary Trust,
                then please provide the following information:-
            </p>
            <honorific v-model="trust.honorific" />
            <base-input
                label="Forename"
                placeholder="John"
                v-model="trust.forename"></base-input>
            <base-input
                label="Surname"
                placeholder="Doe"
                v-model="trust.surname"></base-input>

            <yes-no
                class="mb-4"
                :label="trust.query1.query"
                v-model="trust.query1.answer"
                collapse>
                <textarea
                    v-model="trust.query1.onTrue"
                    class="form-control mt-3"
                    rows="4"
                    placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <div class="mb-4">
                <label>{{ trust.query2.query }}</label>
                <BaseSwitch
                    v-model="trust.query2.answer"
                    left-text="The Trustee"
                    label="The trustee’s solicitors or accountants" />
            </div>
            <b-collapse
                :visible="
                    trust.query2.answer ==
                    'The trustee’s solicitors or accountants'
                ">
                <honorific v-model="trust.query2.onTrue.honorific" />
                <base-input
                    label="Forename"
                    placeholder="John"
                    v-model="trust.query2.onTrue.forename"></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="trust.query2.onTrue.surname"></base-input>
            </b-collapse>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <base-input
                        label="Phone number"
                        placeholder="+44 012345 67890"
                        v-model="trust.phone"></base-input>
                </div>
                <div class="col-12 col-lg-6">
                    <base-input
                        label="Email Address"
                        placeholder="John.doe@doe.co.uk"
                        v-model="trust.email"></base-input>
                </div>
            </div>
        </content-box>

        <content-box
            title="8.1 - Nil Rate Band Discretionary Trusts"
            v-if="formData.length < 4">
            <div class="text-center">
                <base-button type="default" outline @click="addTrustee"
                    >Add trustee<i class="fas fa-plus ms-3"></i
                ></base-button>
            </div>
        </content-box>

        <content-box class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('nil_rate_band', formData);
                    router.push({ name: 'section10' });
                ">
                Next section
            </button>
        </content-box>
    </div>
</template>
<script setup>
import YesNo from '../form-snippets/YesNo.vue';
import Honorific from '../form-snippets/Honorific.vue';
import { reactive, onBeforeMount } from 'vue';
import { useSaveData as saveData } from '../../../composables/helper';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
let formData = reactive([]);

const addTrustee = () => {
    formData.push({
        honorific: '',
        forename: '',
        surname: '',
        query1: {
            query: 'Did the deceased have any charge/debit arrangements with this trustee?',
            answer: null,
            onTrue: ''
        },
        query2: {
            query: 'Select dependent on which contact details you know:',
            answer: 'The Trustee',
            onTrue: {
                honorific: '',
                forename: '',
                surname: ''
            }
        },
        phone: '',
        email: ''
    });
};
const removeTrustee = (i) => {
    formData.splice(i, 1);
};
onBeforeMount(() => {
    if (store.client) {
        if (store.client.nil_rate_band) {
            formData = reactive(
                JSON.parse(store.client.nil_rate_band.the_data)
            );
        }
    }
});
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.relative {
    position: relative;
}

.remove-trustee {
    position: absolute;
    top: 40px;

    @include media-breakpoint-down(sm) {
        top: 5px;
    }
}
</style>
