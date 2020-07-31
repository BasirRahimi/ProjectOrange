<template>
    <div class="container">
        <content-box title="Section 18 - Houses, flats and all other assets">
            <p class="text-gray-500 m-0">Use this section to include assets which are known to you but not otherwise included in this form.</p>
        </content-box>

        <content-box title="18.1 All other assets">
            <yes-no collapse label="Did the deceased own, lease or rent assets like those identified above?" class="mb-4" @input="addRowIfNone">
                <div class="my-4 asset-table-edit" v-show="viewData == false">
                    <template v-for="(row, i) in rows">
                        <base-button
                            :class="{active: activeTab == i}"
                            type="default" 
                            outline 
                            class="d-block mb-2" 
                            :key="`toggle${i}`" 
                            @click="activeTab = i">{{i+1}} - {{row.description}}</base-button>
                        <b-collapse 
                            :key="`collapse${i}`"
                            :id="`accordion${i}`" 
                            accordion="the-accordion"
                            role="tabpanel"
                            :visible="activeTab == i">
                            <card shadow class="mb-2">
                                <label>Description of asset</label>
                                <textarea
                                    placeholder="e.g. The deceased’s freehold home at 12 Acacia Avenue London, England, EW1 123"
                                    rows="2" 
                                    class="form-control form-group" 
                                    v-model="row.description"></textarea>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Mortgage if applicable (£)</label>
                                        <base-input
                                            placeholder="£300,000"
                                            v-model="row.mortgage"
                                            type="number"
                                            step=".01" 
                                            min="0"></base-input>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Value</label>
                                        <base-input 
                                            placeholder="£740,000"
                                            v-model="row.value"
                                            type="number"
                                            step=".01" 
                                            min="0"></base-input>
                                    </div>
                                </div>
                                
                            </card>
                        </b-collapse>
                    </template>
                </div>
                <table class="asset-table mt-4" v-if="viewData == true">
                    <thead>
                        <tr>
                            <th>Description of asset</th>
                            <th>Mortgage if applicable (£)</th>
                            <th>Value</th>
                        </tr>
                        <tr class="spacer"></tr>
                    </thead>
                    <tbody>
                        <template v-for="(row, i) in rows">
                            <tr :key="i">
                                <td>{{row.description}}</td>
                                <td>
                                    <money-format
                                        v-if="row.mortgage"
                                        :value="parseFloat(row.mortgage)"
                                        currency-code='GBP' 
                                        :subunits-value=true>
                                    </money-format>
                                </td>
                                <td>
                                    <money-format
                                        v-if="row.value"
                                        :value="parseFloat(row.value)"
                                        currency-code='GBP' 
                                        :subunits-value=true>
                                    </money-format>
                                </td>
                            </tr>
                            <tr class="spacer-sm" :key="`spacer${i}`"></tr>
                        </template>
                    </tbody>
                </table>
                <div class="d-flex">
                    <base-button type="default" outline class="d-block" @click="viewData = !viewData">{{viewData ? 'Edit' : 'Overview'}}</base-button>
                    <base-button type="default" outline class="ml-auto d-block" @click="addRow" v-if="!viewData">Add</base-button>
                </div>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section20'})">Next section</button>
        </content-box>
  </div>
</template>

<script>
import YesNo from '../form-snippets/YesNo';
import MoneyFormat from 'vue-money-format'
export default {
    components: {
        YesNo,
        MoneyFormat
    },
    data() {
        return {
            rows: [],
            viewData: false,
            activeTab: 0
        }
    },
    methods: {
        addRow() {
            this.rows.push({
                description: '',
                mortgage: '',
                value: ''
            });
        },
        addRowIfNone(data) {
            if(data && this.rows.length < 1) {
                this.addRow();
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>