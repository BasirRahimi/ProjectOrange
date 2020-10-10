<template>
	<div class="container">
		<content-box title="Section 12 - Pensions">
			<p class="text-gray-500 m-0">If the deceased received, or had made provision for, a pension or benefit from an employer or under a personal pension policy (other than the State Pension) you are required to submit details to HMRC.</p>
		</content-box>

		<content-box title="12.1 Pension Details">
			<yes-no collapse :label="formData[0].query" v-model="formData[0].answer">
				<div class="mt-4"></div>
                <base-input
					label="Name of pension scheme or title of pension policy"
					placeholder="Personal pension programme"
                    v-model="formData[0].onTrue.name_of_pension"></base-input>

				<label>Please describe the pension</label>
				<textarea v-model="formData[0].onTrue.description" class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <label>Contact details of the scheme administrators </label>
				<honorific v-model="formData[0].onTrue.honorific"/>
                <base-input
                    label="Company name"
                    placeholder="Appleseed Holdings" v-model="formData[0].onTrue.company_name"></base-input>
				<base-input
                    label="Forename"
                    placeholder="John" v-model="formData[0].onTrue.forename"></base-input>
				<base-input
                    label="Surname"
                    placeholder="Doe" v-model="formData[0].onTrue.surname"></base-input>

				<div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890" v-model="formData[0].onTrue.phone"></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk" v-model="formData[0].onTrue.email"></base-input>
                    </div>
				</div>
			</yes-no>
		</content-box>

		<content-box title="12.2 Pension Payment">
			<yes-no collapse :label="formData[1].query" v-model="formData[1].answer">
				<div class="mt-4"></div>
                <base-input 
                    label="Name of pension scheme or title of pension policy"
                    placeholder="Personal pension programme"
                    v-model="formData[1].onTrue.name_of_pension"></base-input>
                
                <label>Please describe the pension</label>
				<textarea v-model="formData[1].onTrue.description" class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="What is the value of the lump sum?"
                    placeholder="£300,000"
                    type="number"
                    min="0"
                    v-model="formData[1].onTrue.value"></base-input>
			</yes-no>
		</content-box>

		<content-box title="12.3 Pension Payment">
			<yes-no collapse :label="formData[2].query" v-model="formData[2].answer">
                <div class="mt-4"></div>
                <base-input
                    label="Name of pension scheme or title of pension policy"
                    placeholder="Personal pension programme"
                    v-model="formData[2].onTrue.name_of_pension"></base-input>
                
                <label>Please describe the pension</label>
				<textarea v-model="formData[2].onTrue.description" class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
			</yes-no>
		</content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="saveData();routerPush('section14');">Next section</button>
        </content-box>
	</div>
</template>

<script>
import Honorific from '../form-snippets/Honorific';
import YesNo from '../form-snippets/YesNo';
export default {
    components: {
        Honorific,
        YesNo
    },
    data() {
        return {
            section: 'pensions',
            formData:[
                {
                    query: 'Other than small arrears of pension due to the date of death, did any payments under a pension scheme or personal pension policy continue after the death of the deceased?',
                    answer: null,
                    onTrue: {
                        name_of_pension: '',
                        description: '',
                        honorific: '',
                        company_name: '',
                        forename: '',
                        surname: '',
                        phone: '',
                        email: ''
                    }
                },
                {
                    query: 'Was a lump sum payable under the scheme as a result of the death of the deceased?',
                    answer: null,
                    onTrue: {
                        name_of_pension: '',
                        description: '',
                        value: ''
                    }
                },
                {
                    query: 'Did the deceased, within two-years of their death, transfer or dispose of any benefits payable under a pension scheme or person pension policy?',
                    answer: null,
                    onTrue: {
                        name_of_pension: '',
                        description: ''
                    }
                }
            ]
        }
    },
    beforeMount() {
        if(this.$store.state.client) {
            if(this.$store.state.client.pensions) {
                this.formData = JSON.parse(this.$store.state.client.pensions.the_data);
            }
        }
    },
}
</script>

<style lang="scss" scoped>

</style>