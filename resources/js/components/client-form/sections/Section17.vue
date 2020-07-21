<template>
  <div class="container">
      <content-box title="Section 16 - Bank and saving accounts (in the sole name of the deceased)">
			<p class="text-gray-500 m-0">HMRC requires information about all assets held by the deceased.</p>
        </content-box>

        <content-box title="16.1 Banking">
            <yes-no collapse label="Did the deceased have any bank or building society accounts etc?" class="mb-4">
                <table class="asset-table mt-4">
                    <thead>
                        <tr>
                            <th>Name of institution</th>
                            <th>Account number</th>
                            <th>Type of account</th>
                            <th>Value at D.O.D</th>
                        </tr>
                        <tr class="spacer"></tr>
                    </thead>
                    <tbody>
                        <template v-for="(row, i) in rows">
                            <tr :key="i">
                                <td>
                                    <input type="text" v-model="row.institution">
                                </td>
                                <td>
                                    <input type="number" v-model="row.accountNumber">
                                </td>
                                <td>
                                    <input type="text" v-model="row.accountType">
                                </td>
                                <td>
                                    <input type="number" step=".01" min="0" v-model="row.value">
                                </td>
                            </tr>
                            <tr class="spacer-sm" :key="`spacer${i}`"></tr>
                        </template>
                    </tbody>
                </table>
                <base-button type="default" outline class="ml-auto d-block" @click="addRow">Add</base-button>
            </yes-no>
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
                institution: '',
                accountNumber: '',
                accountType: '',
                value: ''
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>