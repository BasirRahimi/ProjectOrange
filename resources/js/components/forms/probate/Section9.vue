<template>
    <div class="container">
        <ContentBox title="Section 9 - Business interests or partnerships">
            <yes-no
                :label="formData[0].query"
                v-model="formData[0].answer"
                collapse>
                <base-input
                    label="Company name"
                    label-classes="mt-4"
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
                    label="Forenames"
                    placeholder="John"
                    v-model="
                        formData[0].onTrue.accountant.forename
                    "></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="
                        formData[0].onTrue.accountant.surname
                    "></base-input>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890"
                            v-model="
                                formData[0].onTrue.accountant.phone
                            "></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk"
                            v-model="
                                formData[0].onTrue.accountant.email
                            "></base-input>
                    </div>
                </div>

                <label
                    >If the company accountants have valued the shares in the
                    business in line with HMRC guidelines then please provide a
                    copy</label
                ><br />
                <client-file-upload
                    v-model="formData[0].onTrue.valuation"
                    @input="saveData" />
                <a
                    v-if="formData[0].onTrue.valuation"
                    :href="formData[0].onTrue.valuation.path"
                    >{{ formData[0].onTrue.valuation.filename }}</a
                >
            </yes-no>
        </ContentBox>

        <ContentBox title="9.2 Partnerships">
            <yes-no
                :label="formData[1].query"
                v-model="formData[1].answer"
                collapse>
                <base-input
                    label="Partnership name"
                    label-classes="mt-4"
                    placeholder="John Appleseed Ltd"
                    v-model="formData[1].onTrue.partnership_name"></base-input>
                <base-input
                    label="Partnership number"
                    placeholder="1235 1235 08311"
                    v-model="
                        formData[1].onTrue.partnership_number
                    "></base-input>
                <base-input
                    label="Business activity"
                    placeholder="Import & export"
                    v-model="formData[1].onTrue.business_activity"></base-input>

                <label>Partnership accountant details</label>
                <honorific v-model="formData[1].onTrue.accountant.honorific" />
                <base-input
                    label="Forenames"
                    placeholder="John"
                    v-model="
                        formData[1].onTrue.accountant.forename
                    "></base-input>
                <base-input
                    label="Surname"
                    placeholder="Doe"
                    v-model="
                        formData[1].onTrue.accountant.surname
                    "></base-input>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890"
                            v-model="
                                formData[1].onTrue.accountant.phone
                            "></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk"
                            v-model="
                                formData[1].onTrue.accountant.email
                            "></base-input>
                    </div>
                </div>

                <label
                    >If the Partnership accountants have valued the shares in
                    the business in line with HMRC guidelines then please
                    provide a copy</label
                ><br />
                <client-file-upload
                    v-model="formData[1].onTrue.valuation"
                    @input="saveData" />
                <a
                    v-if="formData[1].onTrue.valuation"
                    :href="formData[1].onTrue.valuation.path"
                    >{{ formData[1].onTrue.valuation.filename }}</a
                >
            </yes-no>
        </ContentBox>

        <ContentBox class="p-0 text-end" :shadow="false" :whiteBg="false">
            <button
                class="btn btn-primary shadow"
                @click="
                    saveData('business_interests', formData);
                    router.push({ name: 'Section10' });
                ">
                Next section
            </button>
        </ContentBox>
    </div>
</template>
<script setup>
import ContentBox from '@/components/simple/ContentBox.vue';
import ClientFileUpload from '@/components/forms/form-snippets/ClientFileUpload.vue';
import YesNo from '@/components/forms/form-snippets/YesNo.vue';
import Honorific from '@/components/forms/form-snippets/Honorific.vue';
import { reactive, onBeforeMount, ref } from 'vue';
import { useSaveData as saveData } from '@/composables/helper.js';
import { useRouter } from 'vue-router';
import { useClientStore } from '@/stores/client.js';
const router = useRouter();
const store = useClientStore();
let formData = reactive([
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
            valuation: null
        }
    },
    {
        query: 'Was the deceased a member of a partnership?',
        answer: null,
        onTrue: {
            partnership_name: '',
            partnership_number: '',
            business_activity: '',
            accountant: {
                honorific: '',
                forename: '',
                surname: '',
                phone: '',
                email: ''
            },
            valuation: null
        }
    }
]);

onBeforeMount(() => {
    if (store.client) {
        if (store.client.business_interests) {
            formData = reactive(
                JSON.parse(store.client.business_interests.the_data)
            );
        }
    }
});
</script>

<style lang="scss" scoped></style>
