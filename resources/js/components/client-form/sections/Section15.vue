<template>
    <div class="container">
        <content-box title="Section 14 - Assets held jointly with another person">
			<p class="text-gray-500 m-0">HMRC requires information from you about simple life policies and other investments as follows</p>
        </content-box>

        <content-box title="14.2 Assets in joint names">
            <yes-no collapse label="Did the deceased own any assets in the joint names with another person?" class="mb-4">
                <table class="asset-table mt-4">
                    <thead>
                        <tr>
                            <th>Description of asset</th>
                            <th>Name of other owner</th>
                            <th>Total Value (£)</th>
                            <th>Deceased’s share (%)</th>
                        </tr>
                        <tr class="spacer"></tr>
                    </thead>
                    <tbody>
                        <template v-for="(row, i) in rows">
                            <tr :key="i">
                                <td>
                                    <input type="text" v-model="row.desc">
                                </td>
                                <td>
                                    <input type="text" v-model="row.otherOwner">
                                </td>
                                <td>
                                    <input type="number" step=".01" min="0" v-model="row.value">
                                </td>
                                <td>
                                    <input type="number" step=".01" min="0" max="100" v-model="row.share">
                                </td>
                            </tr>
                            <tr class="spacer-sm" :key="`spacer${i}`"></tr>
                        </template>
                    </tbody>
                </table>
                <base-button type="default" outline class="ml-auto d-block" @click="addRow" v-if="rows.length < 20">Add</base-button>
            </yes-no>
            
            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2 mb-0">If the deceased owned a property jointly with another person, include it here. If there is a mortgage on the property, also include details here.</p>
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
            if(this.rows.length >= 20) return;
            this.rows.push({
                desc: '',
                otherOwner: '',
                value: '',
                share: ''
            });
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@/argon/vue_sfc.scss'; 

.asset-table {
    width: 100%;
    border-collapse: separate; // so border-radius will work on th
    border-spacing: 0;
    thead {
        th {
            text-align: center;
            padding: .5rem 0;
            border: 1px solid $input-border-color;
            border-left: 0;
            &:first-child {
                border-left: 1px solid $input-border-color;
                border-radius: $border-radius 0 0 $border-radius;
            }
            &:last-child {
                border-radius: 0 $border-radius $border-radius 0;
            }
        }
    }
    tbody {
        input {
            width: 100%;
            background-color: $body-bg;
            border: 0;
            padding: .5rem 0;
            text-align: center;
        }
        td {
           &:first-child {
                input {
                    border-radius: $border-radius 0 0 $border-radius;
                }
            }
            &:last-child {
                input {
                    border-radius: 0 $border-radius $border-radius 0;
                }
            } 
        }
    }
    tr {
        &.spacer {
            height: 1rem;
        }
        &.spacer-sm {
            height: .5rem;
        }
    }
}
</style>