<template>
  <div class="container">
      <content-box title="Section 5 - Gifts with reservation of benefit">
            <p class="text-gray-500">There is established anti-avoidance legislation which removes any tax advantage if a person has given away an asset but retained an interest in it. An example of this is where a parent might transfer the title of their home to a son or daughter but remain in occupation of it after the transfer takes place. This is known as a ‘gift with reservation of benefit’ (GWRoB) and Executors have a duty to make fullest enquiries and make full disclosure to HMRC.</p>
            <p class="text-gray-500">It does not matter whether seven-years have elapsed since the original transfer of the title.</p>
        </content-box>

        <content-box title="5.2 Anti-avoidance legislation">
            <yes-no :label="formData[0].query" v-model="formData[0].answer" collapse>
                <textarea v-model="formData[0].onTrue" class="form-control mt-3" rows="4" placeholder="We shall review this information and ask for further details as appropriate to ensure you make full disclosure to HMRC."></textarea>
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData(); routerPush('section7');">Next section</button>
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
            section: 'gifts',
            formData: [
                {
                    query: 'Did the deceased transfer any assets to any individual, trust, company or other organisation during their lifetime where the recipient did not take full possession of them?',
                    answer: null,
                    onTrue: ''
                }
            ]
        }
    },
    beforeMount() {
        if(this.$store.state.client) {
            if(this.$store.state.client.gifts) {
                this.formData = JSON.parse(this.$store.state.client.gifts.the_data);
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>