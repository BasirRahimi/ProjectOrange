<template>
    <div class="container">
        <content-box title="Section 10 - Inheritance from other people">
            <p class="text-gray-500">If the deceased received a legacy of money or of an asset from another person in the last five years then please be alert to the details below.</p>
        </content-box>

        <content-box title="10.1 Inheritance">
            <button-group 
                label="In the 5 years before their death, did the deceased inherit money or assets from another person’s estate on which Inheritance Tax was paid?"
                v-model="query1.q1.answer">
            </button-group>
            <b-collapse :visible="query1.q1.answer === 'Yes'">
                HI
            </b-collapse>
        </content-box>
    </div>
</template>

<script>
import ButtonGroup from '../form-snippets/ButtonGroup.vue';
export default {
    components: {
        ButtonGroup
    },
    data() {
        return {
            query1: {
                q1: {
                    answer: null
                }
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>