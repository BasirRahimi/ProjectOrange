<template>
    <div class="container">
        <content-box title="Section 7 - Swiss and assets in other ‘tax havens’">
            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2 mb-0">Domicile and residence is relevant because it affects the law that governs succession. Since 17.8.2016 a new European Regulation affects succession within EU member states. The UK and Eire have not opted in to the Regulation (Denmark has opted out) but it will nonetheless affect individuals connected with the EU. If you are a beneficiary of this estate and there are non-UK assets involved, you should consider your own Will now. Do not wait until the estate has been administered.</p>
            </b-collapse>
        </content-box>

        <content-box title="7.1 Swiss and assets in other ‘tax havens’">
            <yes-no v-for="(row,i) in formData" :key="i" class="form-group" :label="row.query" v-model="row.answer" collapse>
                <textarea v-model="row.onTrue" class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData(); routerPush('section9');">Next section</button>
        </content-box>
    </div>
</template>

<script>
import YesNo from '../form-snippets/YesNo.vue';
export default {
    components: {
        YesNo
    },
    data() {
        return {
            section: 'tax_havens',
            formData: [
                {
                    query: 'Did the deceased have any assets in Switzerland?',
                    answer: null,
                    onTrue: ''
                },
                {
                    query: 'Did the deceased have any assets in a tax haven?',
                    answer: null,
                    onTrue: ''
                }
            ]
        }
    },
    beforeMount() {
        if(this.$store.state.client) {
            if(this.$store.state.client.tax_havens) {
                this.formData = JSON.parse(this.$store.state.client.tax_havens.the_data);
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>