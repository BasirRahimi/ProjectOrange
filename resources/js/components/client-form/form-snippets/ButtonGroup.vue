<template>
    <div v-if="cssGrid">
        <label v-if="label">{{label}}</label>
        <div class="button-grid" :class="`colsize-${gridColsize}`">
            <base-button v-for="(option, key) in optionsCopy" :key="key"
                type="default"
                outline
                class="m-0"
                :class="{'active': option.active === true}"
                @click="update(key)">{{option.value}}</base-button>
        </div>
    </div>
    
    <div v-else>
        <label v-if="label">{{label}}</label>
        <div v-if="sameWidthButtons" class="row no-gutters flex-wrap">
            <base-button v-for="(option, key) in optionsCopy" :key="key"
                type="default"
                outline
                class="col"
                :class="[{'active': option.active === true},
                    {'mr-3': key != optionsCopy.length - 1}]"
                @click="update(key)">{{option.value}}</base-button>
            <!-- <button v-for="(option, key) in optionsCopy" :key="key"
                class="btn btn-outline-secondary active-primary"
                :class="{'active': option.active === true}"
                @click="update(key)">{{option.value}}</button> -->
        </div>
        <template v-else>
            <br />
            <base-button v-for="(option, key) in optionsCopy" :key="key"
                type="default"
                outline
                :class="{'active': option.active === true}"
                @click="update(key)">{{option.value}}</base-button>
            <!-- <button v-for="(option, key) in optionsCopy" :key="key"
                class="btn btn-outline-secondary active-primary mr-3"
                :class="{'active': option.active === true}"
                @click="update(key)">{{option.value}}</button> -->
        </template>
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
        cssGrid: {
            type: Boolean,
            default: false
        },
        gridColsize: {
            type: Number,
            default: 150
        }
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

<style scoped lang="scss">
</style>