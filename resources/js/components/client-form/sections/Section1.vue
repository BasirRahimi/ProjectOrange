<template>
    <div>
        <content-box title="Welcome to Project Orange">
            <p class="text-gray-500">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet</p>
        </content-box>
        <content-box title="About the Deceased">
            <div class="row no-gutters mb-4">         
                <div class="col-12 col-lg-6 d-flex">
                    <button @click="updateHonorific('Mr.')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':formData.honorific == 'Mr.'}"><b>Mr.</b></button>
                    <button @click="updateHonorific('Mrs.')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':formData.honorific == 'Mrs.'}"><b>Mrs.</b></button>
                    <button @click="updateHonorific('Miss')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':formData.honorific == 'Miss'}"><b>Miss</b></button>
                    <button @click="updateHonorific('Ms')" class="btn btn-outline-secondary active-primary mr-lg-3 col" :class="{'active':formData.honorific == 'Ms'}"><b>Ms</b></button>
                </div>
                <div class="col-12 col-lg-6">
                    <input type="text" class="form-control" placeholder="Other" @input="updateHonorific()" ref="customHonorific">
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <label for="forename">Forename</label>
                    <input type="text" id="forename" class="form-control" placeholder="John" v-model="formData.forename">
                </div>
                <div class="col-12 mb-4">
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" class="form-control" placeholder="Doe" v-model="formData.surname">
                </div>
                <div class="col-12 mb-4">
                    <label for="aliases">Any aliases in which they held assets?</label>
                    <input type="text" id="aliases" class="form-control" placeholder="Johnathan Doe" v-model="formData.aliases">
                </div>
                <div class="col-12 mb-4">
                    <label>Last usual address</label><br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input custom-radio" type="radio" name="addressInputType" id="findByPostcode" value="postcode" v-model="addressInputType">
                        <label class="form-check-label" for="findByPostcode">Find with postcode</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input custom-radio" type="radio" name="addressInputType" id="addManually" value="manual" v-model="addressInputType" checked>
                        <label class="form-check-label" for="addManually">Add manually</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mb-4" v-show="addressInputType == 'postcode'">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="E.g. TN30 6RN">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12" v-show="addressInputType == 'manual'">
                    <div class="row">
                        <div class="col-lg-5 mb-4" >
                            <label for="addressLine1">Address Line 1</label>
                            <input type="text" id="addressLine1" class="form-control" placeholder="23 Acacia Avenue" v-model="formData.addressLine1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label for="addressLine2">Address Line 2</label>
                            <input type="text" id="addressLine2" class="form-control" placeholder="Acacia Road" v-model="formData.addressLine2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label for="town">Town / City</label>
                            <input type="text" id="town" class="form-control" placeholder="Acadia" v-model="formData.town">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label for="postcode">Postcode</label>
                            <input type="text" id="postcode" class="form-control" placeholder="TN28 PJ13" v-model="formData.postcode">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <label for="aliases">Date of Death</label>
                    <datepicker input-class="form-control bg-white" v-model="formData.dateOfDeath" placeholder="21 / 9 / 2020" format="dd / MM / yy"></datepicker>
                </div>
            </div>
        </content-box>
        <content-box title="1.2 Key Information">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <label for="birthplace">Place of Birth</label>
                    <input type="text" class="form-control" id="birthplace" v-model="formData.placeOfBirth" placeholder="Maidstone, Kent">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="deathplace">Place of Death</label>
                    <input type="text" class="form-control" id="deathplace" v-model="formData.placeOfDeath" placeholder="Wandsworth, London">
                </div>
            </div>
        </content-box>
        <content-box title="1.3 Marital Status">
            <div class="d-flex">
                <button @click="formData.maritalStatus = 'Married'" class="btn btn-outline-secondary active-primary col mr-3" :class="{'active': formData.maritalStatus == 'Married'}">Married</button>
                <button @click="formData.maritalStatus = 'Batchelor'" class="btn btn-outline-secondary active-primary col mr-3" :class="{'active': formData.maritalStatus == 'Batchelor'}">Batchelor</button>
                <button @click="formData.maritalStatus = 'Divorced'" class="btn btn-outline-secondary active-primary col mr-3" :class="{'active': formData.maritalStatus == 'Divorced'}">Divorced</button>
                <button @click="formData.maritalStatus = 'Widowed'" class="btn btn-outline-secondary active-primary col mr-3" :class="{'active': formData.maritalStatus == 'Widowed'}">Widowed</button>
                <button @click="formData.maritalStatus = 'Spinster'" class="btn btn-outline-secondary active-primary col mr-lg-3" :class="{'active': formData.maritalStatus == 'Spinster'}">Spinster</button>
            </div>
        </content-box>
        <content-box title="1.4 Surviving Relatives">
            <div class="d-flex mb-4">
                <button @click="formData.survivingRelatives.spouse === 0 ? formData.survivingRelatives.spouse = 1 : formData.survivingRelatives.spouse = 0" class="btn btn-outline-secondary active-primary col mr-3" :class="{'active': formData.survivingRelatives.spouse > 0}">Spouse</button>
                <button @click="formData.survivingRelatives.parents === 0 ? formData.survivingRelatives.parents = 1 : formData.survivingRelatives.parents = 0" class="btn btn-outline-secondary active-primary col mr-3" :class="{'active': formData.survivingRelatives.parents > 0}">Parents</button>
                <button @click="formData.survivingRelatives.siblings === 0 ? formData.survivingRelatives.siblings = 1 : formData.survivingRelatives.siblings = 0" class="btn btn-outline-secondary active-primary col mr-3" :class="{'active': formData.survivingRelatives.siblings > 0}">Siblings</button>
                <button @click="formData.survivingRelatives.children === 0 ? formData.survivingRelatives.children = 1 : formData.survivingRelatives.children = 0" class="btn btn-outline-secondary active-primary col mr-3" :class="{'active': formData.survivingRelatives.children > 0}">Children</button>
                <button @click="formData.survivingRelatives.grandChildren === 0 ? formData.survivingRelatives.grandChildren = 1 : formData.survivingRelatives.grandChildren = 0" class="btn btn-outline-secondary active-primary col mr-lg-3" :class="{'active': formData.survivingRelatives.grandChildren > 0}">Grand Children</button>
            </div>
            <div class="row mb-4" v-show="formData.survivingRelatives.parents > 0">
                <div class="col-lg-6">
                    <label for="noOfParents">Number of Surviving Parents</label>
                    <input type="number" id="noOfParents" class="form-control" placeholder="John" v-model.number="formData.survivingRelatives.parents">
                </div>
            </div>
            <div class="row mb-4" v-show="formData.survivingRelatives.siblings > 0">
                <div class="col-lg-6">
                    <label for="noOfSiblings">Number of Surviving Siblings</label>
                    <input type="number" id="noOfSiblings" class="form-control" placeholder="John" v-model.number="formData.survivingRelatives.siblings">
                </div>
            </div>
            <div class="row mb-4" v-show="formData.survivingRelatives.children > 0">
                <div class="col-lg-6">
                    <label for="noOfChildren">Number of Surviving Children</label>
                    <input type="number" id="noOfChildren" class="form-control" placeholder="John" v-model.number="formData.survivingRelatives.children">
                </div>
            </div>
            <div class="row mb-4" v-show="formData.survivingRelatives.grandChildren > 0">
                <div class="col-lg-6">
                    <label for="noOfGrandChildren">Number of Surviving Grand Children</label>
                    <input type="number" id="noOfGrandChildren" class="form-control" placeholder="John" v-model.number="formData.survivingRelatives.grandChildren">
                </div>
            </div>
        </content-box>
        <content-box title="1.5 Income tax details">
            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <label for="NInumber">National insurance number</label>
                    <input type="text" class="form-control" id="NInumber" placeholder="576HDIW7 IE" v-model="formData.niNumber">
                </div>
                <div class="col-12 col-lg-6 mb-4">
                    <label for="tax-ref">Income tax reference</label>
                    <input type="text" class="form-control" id="tax-ref" placeholder="5678 DVW 09" v-model="formData.incomeTaxRef">
                </div>
                <div class="col-12 mb-2">
                    <label>The contact details of the deceased’s accountant</label>
                </div>
                <div class="col-12 col-lg-6 mb-4">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" id="phone" placeholder="+44 012345 67890" v-model="formData.phone">
                </div>
                <div class="col-12 col-lg-6 mb-4">
                    <label for="email">Email Address</label>
                    <input type="text" class="form-control" id="email" placeholder="John.doe@doe.co.uk" v-model="formData.email">
                </div>
            </div>
        </content-box>
        <div class="text-right mb-3">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section2'})">Next section</button>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
export default {
    components: {
        Datepicker
    },
    data() {
        return {
            formData: {
                honorific: '',
                forename: '',
                surname: '',
                aliases: '',
                addressLine1: '',
                addressLine2: '',
                town: '',
                postcode: '',
                dateOfDeath: '',
                placeOfBirth: '',
                placeOfDeath: '',
                maritalStatus: '',
                survivingRelatives: {
                    spouse: 0,
                    parents: 0,
                    siblings: 0,
                    children: 0,
                    grandChildren: 0,
                },
                niNumber: '',
                incomeTaxRef: '',
                phone: '',
                email: '',
            },
            addressInputType: 'manual'
        }
    },
    methods: {
        updateHonorific(text) {
            if(text) {
                this.$refs.customHonorific.value = '';
                this.formData.honorific = text;
            } else {
                this.formData.honorific = this.$refs.customHonorific.value;
            }
        }
    }
}
</script>

<style lang="scss" scoped>
</style>