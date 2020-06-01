<template>
    <div class="container">
        <content-box title="Section 6 - England & Wales and he rest of the UK and British Isles">
            <div class="mb-3">
                <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
                <b-collapse visible id="collapse1">
                    <p class="text-gray-500 mt-2 mb-0">Certain investments can be placed with investment institutions in these jurisdictions. They each have separate legal systems and you may be required to apply for a similar Grant of Probate there.</p>
                </b-collapse>
            </div>
            <div>
                <a v-b-toggle.collapse2 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
                <b-collapse visible id="collapse2">
                    <p class="text-gray-500 mt-2 mb-0">You should take care that the deceased had regularised their affairs with HMRC. For example, the Jersey Disclosure Facility provides for a voluntary disclosure facility to UK residents from 6 April 2013 to 30 September 2016 for UK residents with a beneficial interest in Jersey “relevant property”, with undisclosed UK tax liabilities, with a chance to regularise their UK tax affairs in a controlled manner on beneficial terms.</p>
                </b-collapse>
            </div>
        </content-box>

        <content-box title="6.1 - England & Wales and the rest of the UK and British Isles">
            <yes-no class="form-group" label="Did the deceased have any assets in Jersey?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <yes-no class="form-group" label="Did the deceased have any assets in Guernsey?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <yes-no class="form-group" label="Did the deceased have any assets in Isle of Man?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section8'})">Next section</button>
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

        }
    }
}
</script>

<style lang="scss" scoped>

</style>