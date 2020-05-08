<template>
    <div>
        <label v-if="label">{{label}}</label><br />
        <div v-if="sameWidthButtons" class="same-width-buttons-container">
            <button v-for="(option, key) in optionsCopy" :key="key"
                class="btn btn-outline-secondary active-primary"
                :class="{'active': option.active === true}"
                @click="update(key)">{{option.value}}</button>
        </div>
        <template v-else>
            <button v-for="(option, key) in optionsCopy" :key="key"
                class="btn btn-outline-secondary active-primary mr-3"
                :class="{'active': option.active === true}"
                @click="update(key)">{{option.value}}</button>
        </template>
        
        <b-collapse v-if="collapse" :visible="answer === collapseOn">
            <!-- trying to figure out a collapse on buttonGroup -->
            <slot></slot>
        </b-collapse>
    </div>
</template>

<script>
export default {
    name: 'ButtonGroup',
    props: {
        label: {
            type: String,
            default: null
        },
        options: {
            type: Array,
            default: () => ['Yes', 'No']
        },
        multichoice: {
            type: Boolean,
            default: false
        },
        sameWidthButtons: {
            type: Boolean,
            default: false
        },
        collapse: {
            type: Boolean,
            default: false
        },
        collapseOn: {
            type: String,
            default: 'Yes'
        },
    },
    data() {
        return {
            optionsCopy: []
        }
    },
    beforeMount() {
        this.optionsCopy = this.options.map(x=>{
            return {
                value: x,
                active: false
            }
        });
    },
    methods: {
        update(index) {
            if(!this.multichoice) {
                this.optionsCopy.forEach((x,i)=>{
                    if(i === index) {
                        x.active = true;
                        this.$emit('input', x.value);
                    } else {
                        x.active = false;
                    }
                });
            } else {
                this.optionsCopy[index].active = !this.optionsCopy[index].active;
                this.$emit('input', this.optionsCopy);
            }
        }
    }
}
</script>

<style>

</style>