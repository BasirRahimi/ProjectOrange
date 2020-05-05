<template>
    <div class="row no-gutters">
        <div class="col-12 col-lg-6 mb-4 d-flex">
            <button @click="updateHonorific('Mr.')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':honorific == 'Mr.'}"><b>Mr.</b></button>
            <button @click="updateHonorific('Mrs.')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':honorific == 'Mrs.'}"><b>Mrs.</b></button>
            <button @click="updateHonorific('Miss')" class="btn btn-outline-secondary active-primary mr-3 col" :class="{'active':honorific == 'Miss'}"><b>Miss</b></button>
            <button @click="updateHonorific('Ms')" class="btn btn-outline-secondary active-primary mr-lg-3 col" :class="{'active':honorific == 'Ms'}"><b>Ms</b></button>
        </div>
        <div class="col-12 col-lg-6 mb-4">
            <input type="text" class="form-control" placeholder="Other" @input="updateHonorific($event)"/>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Honorific',
    props: {
        value: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            honorific: ''
        }
    },
    methods: {
        updateHonorific(event) {
            if(typeof event == 'string') {
                this.honorific = event;
            } else {
                this.honorific = event.target.value;
            }
            this.$emit('input', this.honorific);
        }
    },
    beforeMount() {
        this.honorific = this.value;
    }
}
</script>

<style>

</style>