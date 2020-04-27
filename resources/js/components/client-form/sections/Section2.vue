<template>
  <div>
    <content-box title="Adding Executors">
      <p class="text-gray-500">Not every Executor may want to take on their role as an Executor for personal or other reasons. When this happens an Executor can choose one of the following:-</p>
      <p class="text-gray-500">
        1. Formally retire as an Executor (‘Renounce Executorship’) for which a form is required to be signed.
        <br />2. Have the power of Executorship reserved on them.
        <br />3. Appoint someone to take on the responsibility on their behalf (appoint an ‘Attorney’).
      </p>
      <p class="text-gray-500">Below is provision for the details of one executor to be inserted but there may be as many as four named in the Will and who may wish to take the Grant of Probate. In this case, click ‘add executor’ to add more.</p>
    </content-box>

    <content-box v-for="(executor, key) in executors" :key="key" :title="`Executor ${key+1}`">
        <p class="h5 text-center mb-4"><b></b></p>

      <div class="row no-gutters mb-4">
        <div class="col-12 col-lg-6 d-flex">
          <button @click="updateHonorific(key, 'Mr.')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':executor.honorific == 'Mr.'}"><b>Mr.</b></button>
          <button @click="updateHonorific(key, 'Mrs.')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':executor.honorific == 'Mrs.'}"><b>Mrs.</b></button>
          <button @click="updateHonorific(key, 'Miss')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':executor.honorific == 'Miss'}"><b>Miss</b></button>
          <button @click="updateHonorific(key, 'Ms')" class="btn btn-outline-secondary active-primary mr-lg-3 col" :class="{'active':executor.honorific == 'Ms'}"><b>Ms</b></button>
        </div>
        <div class="col-12 col-lg-6">
          <input type="text" class="form-control" placeholder="Other" @input="updateHonorific(key, $event)"/>
        </div>
      </div>

      <div class="row">
        <div class="col-12 mb-4">
            <label for="forename">Forename</label>
            <input type="text" id="forename" class="form-control" placeholder="John" v-model="executor.forename" />
        </div>

        <div class="col-12 mb-4">
          <label for="surname">Surname</label>
          <input type="text" id="surname" class="form-control" placeholder="Doe" v-model="executor.surname" />
        </div>

        <div class="col-12 mb-4">
          <label>Last usual address</label>
          <br />
          <div class="form-check form-check-inline">
            <input class="form-check-input custom-radio" type="radio" name="addressInputType" id="findByPostcode" value="postcode" v-model="executor.addressInputType" />
            <label class="form-check-label" for="findByPostcode">Find with postcode</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input custom-radio" type="radio" name="addressInputType" id="addManually" value="manual" v-model="executor.addressInputType" checked />
            <label class="form-check-label" for="addManually">Add manually</label>
          </div>
        </div>
      </div>

        <div class="row">
            <div class="col-lg-5 mb-4" v-show="executor.addressInputType == 'postcode'">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="E.g. TN30 6RN">
                    <div class="input-group-append">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12" v-show="executor.addressInputType == 'manual'">
                <div class="row">
                    <div class="col-lg-5 mb-4" >
                        <label for="addressLine1">Address Line 1</label>
                        <input type="text" id="addressLine1" class="form-control" placeholder="23 Acacia Avenue" v-model="executor.addressLine1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 mb-4">
                        <label for="addressLine2">Address Line 2</label>
                        <input type="text" id="addressLine2" class="form-control" placeholder="Acacia Road" v-model="executor.addressLine2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 mb-4">
                        <label for="town">Town / City</label>
                        <input type="text" id="town" class="form-control" placeholder="Acadia" v-model="executor.town">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 mb-4">
                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" class="form-control" placeholder="TN28 PJ13" v-model="executor.postcode">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <label for="NInumber">National insurance number</label>
                <input type="text" class="form-control" id="NInumber" placeholder="576HDIW7 IE" v-model="executor.niNumber">
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <label for="phone">Phone number</label>
                <input type="text" class="form-control" id="phone" placeholder="+44 012345 67890" v-model="executor.phone">
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="email" placeholder="John.doe@doe.co.uk" v-model="executor.email">
            </div>
        </div>
    </content-box>
    <div class="d-flex mb-3 align-items-center" :class="[
    {'justify-content-between': executors.length < 4},
    {'justify-content-end': executors.length == 4}
    ]">
        <a href="#" @click.prevent="addExecutor" v-show="executors.length < 4">Add executor +</a>
        <button class="btn btn-primary shadow" @click="$router.push({name:'section3'})">Next section</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        executors: [
            {
                honorific: "",
                forename: "",
                surname: "",
                addressLine1: "",
                addressLine2: "",
                town: "",
                postcode: "",
                niNumber: "",
                phone: "",
                email: "",
                addressInputType: "manual"
            }
        ],
    };
  },
  methods: {
    updateHonorific(key, event) {
        if(typeof event == 'string') {
            this.executors[key].honorific = event;
        } else {
            this.executors[key].honorific = event.target.value;
        }
    },
    addExecutor() {
        this.executors.push({
            honorific: "",
            forename: "",
            surname: "",
            addressLine1: "",
            addressLine2: "",
            town: "",
            postcode: "",
            niNumber: "",
            phone: "",
            email: "",
            addressInputType: "manual" 
        })
    }
  }
};
</script>

<style lang="scss" scoped>
</style>