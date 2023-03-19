<template>
    <div class="row g-2 mb-4">
        <div class="col-12 col-lg-6">
            <div class="row g-2 h-100">
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <base-button
                        @click="updateHonorific('Mr.')"
                        :class="{ active: modelValue == 'Mr.' }"
                        class="w-100 px-0 h-100"
                        outline
                        type="default"
                        >Mr.</base-button
                    >
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <base-button
                        @click="updateHonorific('Mrs.')"
                        :class="{ active: modelValue == 'Mrs.' }"
                        class="w-100 px-0 h-100"
                        outline
                        type="default"
                        >Mrs.</base-button
                    >
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <base-button
                        @click="updateHonorific('Miss')"
                        :class="{ active: modelValue == 'Miss' }"
                        class="w-100 px-0 h-100"
                        outline
                        type="default"
                        >Miss</base-button
                    >
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <base-button
                        @click="updateHonorific('Ms')"
                        :class="{ active: modelValue == 'Ms' }"
                        class="w-100 px-0 h-100"
                        outline
                        type="default"
                        >Ms</base-button
                    >
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <base-input
                :mb-4="false"
                placeholder="Other"
                v-model="customHonorific"
                :formGroup="false"></base-input>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Honorific',
    props: {
        modelValue: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            customHonorific: ''
        };
    },
    methods: {
        updateHonorific(val) {
            if (['Mr.', 'Mrs.', 'Miss', 'Ms'].includes(val)) {
                this.customHonorific = '';
            }
            this.$emit('update:modelValue', val);
        },
        setCustomHonorific(val) {
            if (!['Mr.', 'Mrs.', 'Miss', 'Ms'].includes(val)) {
                this.customHonorific = val;
            }
        }
    },
    mounted() {
        this.setCustomHonorific(this.modelValue);
    },
    updated() {
        this.setCustomHonorific(this.modelValue);
    },
    watch: {
        customHonorific(val) {
            if (val) {
                this.updateHonorific(val);
            }
        }
    }
};
</script>
