<template>
    <div class="row g-2 mb-4">
        <div class="col-12 col-lg-6">
            <div class="row g-2 h-100">
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <base-button
                        @click="updateHonorific('Mr.')"
                        :class="{ active: honorific == 'Mr.' }"
                        class="w-100 px-0 h-100"
                        outline
                        type="default"
                        >Mr.</base-button
                    >
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <base-button
                        @click="updateHonorific('Mrs.')"
                        :class="{ active: honorific == 'Mrs.' }"
                        class="w-100 px-0 h-100"
                        outline
                        type="default"
                        >Mrs.</base-button
                    >
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <base-button
                        @click="updateHonorific('Miss')"
                        :class="{ active: honorific == 'Miss' }"
                        class="w-100 px-0 h-100"
                        outline
                        type="default"
                        >Miss</base-button
                    >
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <base-button
                        @click="updateHonorific('Ms')"
                        :class="{ active: honorific == 'Ms' }"
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
            honorific: '',
            customHonorific: ''
        };
    },
    methods: {
        updateHonorific(val) {
            this.honorific = val;
            if (this.honorific !== this.customHonorific) {
                this.customHonorific = '';
            }
            this.$emit('update:modelValue', this.honorific);
        }
    },
    beforeMount() {
        this.honorific = this.modelValue;
        if (!['Mr.', 'Mrs.', 'Miss', 'Ms'].includes(this.modelValue)) {
            this.customHonorific = this.modelValue;
        }
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
