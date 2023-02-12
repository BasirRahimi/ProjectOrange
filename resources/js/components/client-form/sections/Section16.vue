<template>
    <div class="container">
        <content-box title="Section 15 - Stocks and shares (in the sole name of the deceased)">
            <p class="text-gray-500 m-0">HMRC requires information about stocks and shares held by the deceased.</p>
        </content-box>

        <content-box title="15.1 Stocks Information">
            <yes-no collapse :label="formData[0].query" v-model="formData[0].answer" class="mb-4">
                <div class="asset-table mt-4">
                    <div class="row no-gutters">
                        <div class="col-3 cell-header">Name of company</div>
                        <div class="col-3 cell-header">Number of shares held</div>
                        <div class="col-3 cell-header">Share Number</div>
                        <div class="col-3 cell-header">Share price at D.O.D (£)</div>
                    </div>
                    <div class="row no-gutters table-row" v-for="(row, i) in formData[0].onTrue" :key="i">
                        <div class="row-settings" :class="{ active: rowSettings }">
                            <base-button type="danger" icon="fas fa-window-close" icon-only
                                @click="removeRow(i)"></base-button>
                        </div>
                        <div class="col-3 cell">
                            <input type="text" v-model="row.company">
                        </div>
                        <div class="col-3 cell">
                            <input type="number" step="5" min="0" v-model="row.shares">
                        </div>
                        <div class="col-3 cell">
                            <input type="text" v-model="row.shareNumber">
                        </div>
                        <div class="col-3 cell">
                            <input type="number" step="5" min="0" v-model="row.price">
                        </div>
                    </div>
                </div>

                <div class="text-right mt-2">
                    <base-button type="default" outline :class="{ active: rowSettings }" icon="fas fa-cog" icon-only
                        @click="rowSettings = !rowSettings"></base-button>
                    <base-button type="default" outline class="ml-auto" @click="addRow"
                        v-if="formData[0].onTrue.length < 20">Add</base-button>
                </div>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData(); routerPush('section17');">Next section</button>
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
            section: 'stocks_shares',
            rowSettings: false,
            formData: [
                {
                    query: 'Did the deceased own any stocks and shares in companies registered in the stock exchange?',
                    answer: null,
                    onTrue: []
                }
            ]
        }
    },
    beforeMount() {
        if (this.$store.state.client) {
            if (this.$store.state.client.stocks_shares) {
                this.formData = JSON.parse(this.$store.state.client.stocks_shares.the_data);
            }
        }
    },
    methods: {
        addRow() {
            this.formData[0].onTrue.push({
                company: '',
                shares: '',
                shareNumber: '',
                price: ''
            });
        },
        removeRow(i) {
            this.formData[0].onTrue.splice(i, 1);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>