<template>
    <div class="container">
        <content-box title="Section 20 - Other information">
            <p class="text-gray-500 m-0">Use this section as an opportunity to provide any extra information you believe relevant.</p>
        </content-box>

        <content-box title="20.1 Other information" v-for="(row, i) in formData" :key="`otherInfo${i}`" class="relative">
            <a class="remove-info" href="#" v-if="formData.length > 1" @click.prevent="removeInfo(i)">Remove</a>
            <label>Subject</label>
            <base-input
                placeholder="e.g. Section 13 - policy information finished on it’s way"
                v-model="row.subject"></base-input>

            <label>Description</label>
            <textarea v-model="row.description" class="form-control form-group" placeholder="I do not have the policy information and have asked my IFA to send it to you seperately"></textarea>

            <label>Upload relevant documents:</label><br/>
            <base-file-upload></base-file-upload>
        </content-box>
            
        <content-box class="p-0 text-center" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="addRow">Add information<i data-v-c216df9e="" class="fas fa-plus ml-3"></i></button>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData('other_information');routerPush('overview');">Review</button>
        </content-box>
    </div>
</template>

<script>
import BaseFileUpload from '../../base-components/BaseFileUpload.vue';

export default {
    components: { BaseFileUpload },
    data() {
        return {
            formData: []
        }
    },
    beforeMount() {
        if(this.$store.state.client) {
            if(this.$store.state.client.other_information) {
                this.formData = JSON.parse(this.$store.state.client.other_information.the_data);
            }
        }
    },
    mounted() {
        if(this.formData.length < 1) {
            this.addRow();
        }
    },
    methods: {
        addRow() {
            this.formData.push({
                subject:'',
                description: '',
                documents: []
            });
        },
        removeInfo(i) {
            this.formData.splice(i,1);
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@/argon/vue_sfc.scss'; 

.relative {
    position: relative;
}
.remove-info {
    position: absolute;
    top: 40px;

    @include media-breakpoint-down(sm) {
        top: 5px;
    }
}
</style>