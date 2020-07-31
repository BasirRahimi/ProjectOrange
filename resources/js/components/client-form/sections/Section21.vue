<template>
    <div class="container">
        <content-box title="Section 20 - Other information">
            <p class="text-gray-500 m-0">Use this section as an opportunity to provide any extra information you believe relevant.</p>
        </content-box>

        <content-box title="20.1 Other information" v-for="(row, i) in rows" :key="`otherInfo${i}`">
            <label>Subject</label>
            <base-input
                placeholder="e.g. Section 13 - policy information finished on it’s way"
                v-model="row.subject"></base-input>

            <label>Description</label>
            <textarea class="form-control form-group" placeholder="I do not have the policy information and have asked my IFA to send it to you seperately"></textarea>

            <label>Upload relevant documents:</label><br/>
            <base-file-upload></base-file-upload>
        </content-box>
            
        <content-box class="p-0 text-center" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="addRow">Add information<i data-v-c216df9e="" class="fas fa-plus ml-3"></i></button>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'overview'})">Review</button>
        </content-box>
    </div>
</template>

<script>
import BaseFileUpload from '../../base-components/BaseFileUpload.vue';

export default {
    components: { BaseFileUpload },
    data() {
        return {
            rows: []
        }
    },
    mounted() {
        if(this.rows.length < 1) {
            this.addRow();
        }
    },
    methods: {
        addRow() {
            this.rows.push({
                subject:'',
                description: ''
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>