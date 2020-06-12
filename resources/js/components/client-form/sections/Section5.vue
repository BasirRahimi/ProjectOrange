<template>
    <div class="container">
        <content-box title="Section 4 - Lifetime Gifs">
            <p class="text-gray-500">There is an obligation upon the Executors to make the fullest enquiries as appear to be relevant to establish whether any lifetime gifts were made on of after 18th March 1986. The Executors need to be able to prove that they made fullest enquiries and so this means that the Executors should seek information from those individuals who appear to be obvious recipients of gifts from the deceased (e.g. close relative, etc) but also consider less obvious recipients of gifts (e.g. friend, employee, housekeeper, distant relative, etc).</p>
            <p class="text-gray-500"><b>HMRC has made it clear that it will, in some circumstances, examine closely the activities of an Executor making enquiries and will hold them to account for failure to disclose gifts.</b></p>
            <p class="text-gray-500">The principle is that a gift of an asset will reduce the value of a person’s estate. Since Inheritance Tax could have been payable if the asset was retained, there are rules which allow HMRC to take gifts, normally made within seven years of death, to be taken into account in determining whether Inheritance tax is due.</p>
            <ul class="text-gray-500 m-0 pl-4">
                <li>Gifts to spouses or civil partners do not need to be disclosed.</li>
                <li>Small cash gifts of £250 do not need to be disclosed.</li>
                <li>Other gifts in total of £3,000 do not need to be disclosed.</li>
            </ul>
        </content-box>

        <content-box title="4.2 Details of lifetime videos">
            <yes-no v-show="slide === 1" class="form-group flash-label" label="Did the deceased make any gifts or transfer assets to or for the benefit of another individual, charity or other organisation?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <yes-no v-show="slide === 2" class="form-group flash-label" label="Did the deceased create a trust or settlement?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <yes-no v-show="slide === 3" class="form-group flash-label" label="Did the deceased transfer/gift additional assets to an existing trust or settlement?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <yes-no v-show="slide === 4" class="form-group flash-label" label="Did the deceased pay a premium on any life insurance policy to for the benefit of someone else?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <yes-no v-show="slide === 5" class="form-group flash-label" label="Was the deceased entitled to benefit from any assets held in trust or in a settlement which during their life had come to an end either in whole or in part?" collapse>
                <textarea class="form-control mt-3" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
            </yes-no>

            <div class="d-sm-flex align-items-center">
                <div class="flex-grow-1">Step {{slide}}/5</div>
                <base-button v-if="slide > 1" type="default" outline @click="prevSlide">Previous</base-button>
                <base-button v-if="slide < 5" type="default" outline @click="nextSlide">Next</base-button>
            </div>

            <a v-b-toggle.collapse2 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse2">
                <p class="text-gray-500 mt-2">Domicile and residence is relevant because it affects the law that governs succession. Since 17.8.2016 a new European Regulation affects succession within EU member states. The UK and Eire have not opted in to the Regulation (Denmark has opted out) but it will nonetheless affect individuals connected with the EU. If you are a beneficiary of this estate and there are non-UK assets involved, you should consider your own Will now. Do not wait until the estate has been administered.</p>
            </b-collapse>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section6'})">Next section</button>
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
            slide: 1,
        }
    },
    methods: {
        nextSlide() {
            if(this.slide < 5) {
                this.slide++;
                this.flashLabel();
            }
        },
        prevSlide() {
            if(this.slide > 1) {
                this.slide--;
                this.flashLabel();
            }
        },
        flashLabel() {
            let label = $($('.flash-label > label')[this.slide - 1]);
            label.css('background-color', 'yellow');
            setTimeout(() => {
                label.css('transition', 'all .9s');
                label.css('background-color', 'transparent');
            }, 100);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>