<template>
  <div class="container">
      <content-box title="Section 15 - Stocks and shares (in the sole name of the deceased)">
			<p class="text-gray-500 m-0">HMRC requires information about stocks and shares held by the deceased.</p>
        </content-box>

        <content-box title="15.1 Stocks Information">
            <yes-no collapse label="Did the deceased own any stocks and shares in companies registered in the stock exchange?" class="mb-4">
                <table class="asset-table mt-4">
                    <thead>
                        <tr>
                            <th>Name of company</th>
                            <th>Number of shares held</th>
                            <th>Share Number</th>
                            <th>Share price at D.O.D</th>
                        </tr>
                        <tr class="spacer"></tr>
                    </thead>
                    <tbody>
                        <template v-for="(row, i) in rows">
                            <tr :key="i">
                                <td>
                                    <input type="text" v-model="row.company">
                                </td>
                                <td>
                                    <input type="number" min="0" v-model="row.shares">
                                </td>
                                <td>
                                    <input type="text" v-model="row.shareNumber">
                                </td>
                                <td>
                                    <input type="number" step=".01" min="0" v-model="row.price">
                                </td>
                            </tr>
                            <tr class="spacer-sm" :key="`spacer${i}`"></tr>
                        </template>
                    </tbody>
                </table>
                <base-button type="default" outline class="ml-auto d-block" @click="addRow">Add</base-button>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section17'})">Next section</button>
        </content-box>
  </div>
</template>

<script>
import YesNo from '../form-snippets/YesNo';
export default {
    components: {
        YesNo
    },
    data() {
        return {
            rows: []
        }
    },
    methods: {
        addRow() {
            this.rows.push({
                company: '',
                shares: '',
                shareNumber: '',
                price: ''
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>