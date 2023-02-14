<template>
    <div class="container">
        <content-box title="Section 18 - Houses, flats and all other assets">
            <p class="text-gray-500 m-0">Use this section to include assets which are known to you but not otherwise
                included in this form.</p>
        </content-box>

        <content-box title="18.1 All other assets">
            <yes-no collapse :label="formData[0].query" v-model="formData[0].answer" class="mb-4" @input="addRowIfNone">
                <div class="mt-4 accordion-asset-table" v-show="viewData == false">
                    <template v-for="(row, i) in formData[0].onTrue" :key="`toggle${i}`">
                        <base-button :class="{ active: activeTab == i }" type="default" outline
                            class="d-block mb-2 asset-toggle" @click="activeTab = i">{{ i+ 1}} -
                            {{ row.description }}</base-button>
                        <b-collapse :id="`accordion${i}`" accordion="the-accordion" role="tabpanel"
                            :visible="activeTab == i">
                            <card shadow class="mb-2 relative">
                                <div class="d-flex">
                                    <label class="d-lock">Description of asset</label>
                                    <a class="ml-auto d-block" href="#" v-if="formData[0].onTrue.length > 1"
                                        @click.prevent="removeRow(i)">Remove asset</a>
                                </div>
                                <textarea
                                    placeholder="e.g. The deceased’s freehold home at 12 Acacia Avenue London, England, EW1 123"
                                    rows="2" class="form-control form-group" v-model="row.description"></textarea>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Mortgage if applicable (£)</label>
                                        <base-input placeholder="£300,000" v-model="row.mortgage" type="number"
                                            min="0"></base-input>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Value (£)</label>
                                        <base-input placeholder="£740,000" v-model="row.value" type="number"
                                            min="0"></base-input>
                                    </div>
                                </div>

                            </card>
                        </b-collapse>
                    </template>
                </div>
                <div class="asset-table mt-4" v-if="viewData == true">
                    <div class="row no-gutters">
                        <div class="col-6 cell-header">Description of asset</div>
                        <div class="col-3 cell-header">Mortgage</div>
                        <div class="col-3 cell-header">Value</div>
                    </div>
                    <div class="row no-gutters table-row" v-for="(row, i) in formData[0].onTrue" :key="i">
                        <div class="col-6 cell">
                            {{ row.description }}
                        </div>
                        <div class="col-3 cell text-center">
                            <money-format v-if="row.mortgage" :value="parseFloat(row.mortgage)" currency-code='GBP'
                                :subunits-value=true>
                            </money-format>
                        </div>
                        <div class="col-3 cell text-center">
                            <money-format v-if="row.value" :value="parseFloat(row.value)" currency-code='GBP'
                                :subunits-value=true>
                            </money-format>
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-4">
                    <base-button type="default" outline class="d-block" @click="viewData = !viewData">{{
                        viewData?
                                            'Edit': 'Overview'
                    }}</base-button>
                    <base-button type="default" outline class="ml-auto d-block" @click="addRow"
                        v-if="!viewData">Add</base-button>
                </div>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData(); routerPush('section20');">Next section</button>
        </content-box>
    </div>
</template>

<script>
import YesNo from '../form-snippets/YesNo.vue';
import MoneyFormat from 'vue-money-format'
export default {
    components: {
        YesNo,
        MoneyFormat
    },
    data() {
        return {
            section: 'assets',
            formData: [
                {
                    query: 'Did the deceased own, lease or rent assets like those identified above?',
                    answer: null,
                    onTrue: []
                }
            ],
            viewData: false,
            activeTab: 0
        }
    },
    beforeMount() {
        if (this.$store.state.client) {
            if (this.$store.state.client.assets) {
                this.formData = JSON.parse(this.$store.state.client.assets.the_data);
            }
        }
    },
    methods: {
        addRow() {
            this.formData[0].onTrue.push({
                description: '',
                mortgage: '',
                value: ''
            });
            this.activeTab = this.formData[0].onTrue.length - 1;
        },
        removeRow(i) {
            this.formData[0].onTrue.splice(i, 1);
        },
        addRowIfNone(data) {
            if (data && this.formData[0].onTrue.length < 1) {
                this.addRow();
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.relative {
    position: relative;
}

.remove-asset {
    position: absolute;
    top: 40px;

    @include media-breakpoint-down(sm) {
        top: 5px;
    }
}
</style>