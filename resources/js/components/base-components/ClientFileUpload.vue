<template>
    <div class="d-inline-block">
        <label class="file btn btn-outline-default active-primary mb-0">
            <input type="file" @change="onFileChange" ref="fileInput">
            <span v-if="value">Change Copy</span>
            <span v-else>Upload Copy +</span>
        </label>
        <span v-if="value">{{value.name}}</span>
    </div>
</template>

<script>
export default {
    name: 'ClientFileUpload',
    props: {
        value: {
            default: null
        },
        wipeAfterInput: {
            default: false,
            type: Boolean
        }
    },
    methods: {
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if(!files.length) return;
            this.uploadFile(files[0]);
        },
        uploadFile(file) {
            let formData = new FormData();
            formData.append('file', file);
            axios.post(`/clients/${this.$store.state.client.id}/upload`, formData)
            .then(response => {
                this.$emit('input', response.data);
                if(this.wipeAfterInput) {
                    this.$refs.fileInput.value = '';
                }
            });
        }
    }
}
</script>

<style lang="scss" scoped>

.file {
    position: relative;
    
    input {
        position: absolute;
        left: -99999px;
        width: 1;
        height: 1;
        margin: 0;
        filter: alpha(opacity=0);
        opacity: 0;
    }
}
</style>