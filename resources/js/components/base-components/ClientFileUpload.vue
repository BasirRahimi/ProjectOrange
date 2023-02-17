<template>
    <div class="d-inline-block">
        <label class="file btn btn-outline-default active-primary mb-0">
            <input type="file" @change="onFileChange" ref="fileInput" />
            <span v-if="modelValue">Change Copy</span>
            <span v-else>Upload Copy +</span>
        </label>
        <span v-if="modelValue" class="ms-3">{{ modelValue.name }}</span>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useClientStore } from '@/stores/client.js';
const store = useClientStore();
const fileInput = ref(null);
const emit = defineEmits(['update:modelValue']);
const props = defineProps({
    modelValue: {
        default: null
    },
    wipeAfterInput: {
        default: false,
        type: Boolean
    }
});
const onFileChange = (e) => {
    let files = e.target.files || e.dataTransfer.files;
    if (!files.length) return;
    uploadFile(files[0]);
};
const uploadFile = (file) => {
    let formData = new FormData();
    formData.append('file', file);
    axios
        .post(`/clients/${store.client.id}/upload`, formData)
        .then((response) => {
            console.log(response.data);
            emit('update:modelValue', response.data);
            if (props.wipeAfterInput) {
                fileInput.value.value = '';
            }
        });
};
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
