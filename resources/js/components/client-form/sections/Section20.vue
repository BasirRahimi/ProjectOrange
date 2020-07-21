<template>
    <div class="container">
        <content-box title="Section 19 - Liabilities (owed solely by the deceased)">
            <p class="text-gray-500 m-0">Use this section to include liabilities owed by the deceased.</p>
        </content-box>

        <content-box title="19.1 Liabilities">
            <yes-no collapse label="Are there any liabilities owed by the deceased?" class="mb-4">
                <table class="asset-table mt-4">
                    <thead>
                        <tr>
                            <th>Description of liability</th>
                            <th>Value (£)</th>
                        </tr>
                        <tr class="spacer"></tr>
                    </thead>
                    <tbody>
                        <template v-for="(row, i) in rows">
                            <tr :key="i">
                                <td>
                                    <input type="text" v-model="row.description">
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

            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2 mb-0">When you do not know the value of a liability at the time of completing this section, note ‘approximately’ by the figure</p>
            </b-collapse>
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
                description: '',
                value: ''
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>