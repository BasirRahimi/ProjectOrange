<template>
    <div class="container">
        <content-box title="Section 14 - Assets held jointly with another person">
            <p class="text-gray-500 m-0">HMRC requires information from you about simple life policies and other
                investments as follows</p>
        </content-box>

        <content-box title="14.1 Assets in joint names">
            <yes-no collapse :label="formData[0].query" v-model="formData[0].answer" class="mb-4">
                <div class="asset-table mt-4">
                    <div class="row no-gutters">
                        <div class="col-3 cell-header">Description of asset</div>
                        <div class="col-3 cell-header">Name of other owner</div>
                        <div class="col-3 cell-header">Total Value (£)</div>
                        <div class="col-3 cell-header">Deceased’s share (%)</div>
                    </div>
                    <div class="row no-gutters table-row" v-for="(row, i) in formData[0].onTrue" :key="i">
                        <div class="row-settings" :class="{ active: rowSettings }">
                            <base-button type="danger" icon="fas fa-window-close" icon-only
                                @click="removeRow(i)"></base-button>
                        </div>
                        <div class="col-3 cell">
                            <input type="text" v-model="row.desc">
                        </div>
                        <div class="col-3 cell">
                            <input type="text" v-model="row.otherOwner">
                        </div>
                        <div class="col-3 cell">
                            <input type="number" step=".01" min="0" v-model="row.value">
                        </div>
                        <div class="col-3 cell">
                            <input type="number" step=".01" min="0" max="100" v-model="row.share">
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

            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2 mb-0">If the deceased owned a property jointly with another person, include
                    it here. If there is a mortgage on the property, also include details here.</p>
            </b-collapse>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData(); routerPush('section16');">Next section</button>
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
            section: 'joint_held_assets',
            rowSettings: false,
            formData: [
                {
                    query: 'Did the deceased own any assets in the joint names with another person?',
                    answer: null,
                    onTrue: []
                }
            ]
        }
    },
    beforeMount() {
        if (this.$store.state.client) {
            if (this.$store.state.client.joint_held_assets) {
                this.formData = JSON.parse(this.$store.state.client.joint_held_assets.the_data);
            }
        }
    },
    methods: {
        addRow() {
            if (this.formData[0].onTrue.length >= 20) return;
            this.formData[0].onTrue.push({
                desc: '',
                otherOwner: '',
                value: '',
                share: ''
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