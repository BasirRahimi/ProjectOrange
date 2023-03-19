<template>
    <div class="d-inline-block">
        <label class="file btn btn-outline-default active-primary mb-0">
            <input
                type="file"
                @change="onFileChange"
                ref="fileInput"
                :id="inputId" />
            <span v-if="modelValue">{{ changeText }}</span>
            <span v-else>{{ uploadText }}</span>
        </label>
        <a class="ms-2" v-if="modelValue && showFile" :href="modelValue.path">{{
            modelValue.filename
        }}</a>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useCaseStore } from '@/stores/case';
const store = useCaseStore();
const fileInput = ref(null);
const emit = defineEmits(['update:modelValue']);
const props = defineProps({
    modelValue: {
        default: null
    },
    inputId: {
        type: String,
        default: ''
    },
    wipeAfterInput: {
        default: false,
        type: Boolean
    },
    showFile: {
        default: true,
        type: Boolean
    },
    uploadText: {
        type: String,
        default: 'Upload Copy +'
    },
    changeText: {
        type: String,
        default: 'Change Copy'
    },
    filePrefix: {
        type: String,
        default: ''
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
    formData.append('prefix', props.filePrefix);
    axios
        .post(`/api/cases/${store.activeCase.id}/upload`, formData)
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
