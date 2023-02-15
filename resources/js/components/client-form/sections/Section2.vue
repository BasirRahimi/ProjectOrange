<template>
    <div class="container">
        <content-box title="Adding Executors">
            <p class="text-gray-500">
                Not every Executor may want to take on their role as an Executor
                for personal or other reasons. When this happens an Executor can
                choose one of the following:-
            </p>
            <p class="text-gray-500">
                1. Formally retire as an Executor (‘Renounce Executorship’) for
                which a form is required to be signed.
                <br />2. Have the power of Executorship reserved on them.
                <br />3. Appoint someone to take on the responsibility on their
                behalf (appoint an ‘Attorney’).
            </p>
            <p class="text-gray-500">
                Below is provision for the details of one executor to be
                inserted but there may be as many as four named in the Will and
                who may wish to take the Grant of Probate. In this case, click
                ‘add executor’ to add more.
            </p>
        </content-box>

        <content-box
            class="relative"
            v-for="(executor, key) in formData"
            :key="key"
            :title="`Executor ${key + 1}`">
            <a
                class="remove-executor"
                href="#"
                v-if="formData.length > 1"
                @click.prevent="removeExecutor(key)"
                >Remove Executor</a
            >
            <honorific v-model="executor.honorific" />

            <base-input
                label="Forename"
                placeholder="John"
                v-model="executor.forename"></base-input>
            <base-input
                label="Surname"
                placeholder="Doe"
                v-model="executor.surname"></base-input>

            <div class="form-group">
                <label>Last usual address</label><br />
                <base-radio
                    inline
                    name="postcode"
                    v-model="executor.addressInputType"
                    value="manual"
                    >Find with postcode</base-radio
                >
                <base-radio
                    inline
                    name="manual"
                    v-model="executor.addressInputType"
                    value="manual"
                    >Add manually</base-radio
                >
            </div>

            <div class="row">
                <div
                    class="col-lg-5 mb-4"
                    v-show="executor.addressInputType == 'postcode'">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="E.g. TN30 6RN" />
                        <div class="input-group-append">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="col-12"
                    v-show="executor.addressInputType == 'manual'">
                    <div class="row">
                        <div class="col-lg-5">
                            <base-input
                                label="Address Line 1"
                                placeholder="23 Acacia Avenue"
                                v-model="executor.addressLine1"></base-input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <base-input
                                label="Address Line 2"
                                placeholder="Acacia Road"
                                v-model="executor.addressLine2"></base-input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <base-input
                                label="Town / City"
                                placeholder="Acacia"
                                v-model="executor.town"></base-input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <base-input
                                label="Postcode"
                                placeholder="TN28 PJ13"
                                v-model="executor.postcode"></base-input>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <base-input
                        label="National insurance number"
                        placeholder="576HDIW7 IE"
                        v-model="executor.niNumber"></base-input>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <base-input
                        label="Phone number"
                        placeholder="+44 012345 67890"
                        v-model="executor.phone"></base-input>
                </div>
                <div class="col-12 col-lg-6">
                    <base-input
                        label="Email Address"
                        placeholder="John.doe@doe.co.uk"
                        v-model="executor.email"></base-input>
                </div>
            </div>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <div
                class="d-flex mb-3 align-items-center"
                :class="[
                    { 'justify-content-between': formData.length < 4 },
                    { 'justify-content-end': formData.length == 4 }
                ]">
                <a
                    href="#"
                    @click.prevent="addExecutor"
                    v-show="formData.length < 4"
                    >Add executor +</a
                >
                <button
                    class="btn btn-primary shadow"
                    @click="
                        saveData('executors', formData);
                        router.push({ name: 'section3' });
                    ">
                    Next section
                </button>
            </div>
        </content-box>
    </div>
</template>
<script setup>
import Honorific from '../form-snippets/Honorific.vue';
import { useClientStore } from '@/stores/client.js';
import { onBeforeMount, ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useSaveData as saveData } from '@/composables/helper.js';

const router = useRouter();
const store = useClientStore();
let formData = reactive([
    {
        honorific: '',
        forename: '',
        surname: '',
        addressLine1: '',
        addressLine2: '',
        town: '',
        postcode: '',
        niNumber: '',
        phone: '',
        email: '',
        addressInputType: 'manual'
    }
]);

const addExecutor = () => {
    formData.push({
        honorific: '',
        forename: '',
        surname: '',
        addressLine1: '',
        addressLine2: '',
        town: '',
        postcode: '',
        niNumber: '',
        phone: '',
        email: '',
        addressInputType: 'manual'
    });
};
const removeExecutor = (i) => {
    formData.splice(i, 1);
};

onBeforeMount(() => {
    if (store.client) {
        if (store.client.executors) {
            formData = JSON.parse(store.client.executors.the_data);
        }
    }
});
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.relative {
    position: relative;
}

.remove-executor {
    position: absolute;
    top: 40px;

    @include media-breakpoint-down(sm) {
        top: 5px;
    }
}
</style>
