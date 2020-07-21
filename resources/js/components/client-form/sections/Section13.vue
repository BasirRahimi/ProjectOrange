<template>
	<div class="container">
		<content-box title="Section 12 - Pensions">
			<p class="text-gray-500 m-0">If the deceased received, or had made provision for, a pension or benefit from an employer or under a personal pension policy (other than the State Pension) you are required to submit details to HMRC.</p>
		</content-box>

		<content-box title="12.1 Pension Details">
			<yes-no collapse label="Other than small arrears of pension due to the date of death, did any payments under a pension scheme or personal pension policy continue after the death of the deceased?">
				<div class="mt-4"></div>
                <base-input
					label="Name of pension scheme or title of pension policy"
					placeholder="Personal pension programme"></base-input>

				<label>Please describe the pension</label>
				<textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <label>Contact details of the scheme administrators </label>
				<honorific />
                <base-input
                    label="Company name"
                    placeholder="Appleseed Holdings"></base-input>
				<base-input
                    label="Forename"
                    placeholder="John"></base-input>
				<base-input
                    label="Surname"
                    placeholder="Doe"></base-input>

				<div class="row">
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Phone number"
                            placeholder="+44 012345 67890"></base-input>
                    </div>
                    <div class="col-12 col-lg-6">
                        <base-input
                            label="Email Address"
                            placeholder="John.doe@doe.co.uk"></base-input>
                    </div>
				</div>
			</yes-no>
		</content-box>

		<content-box title="12.2 Pension Payment">
			<yes-no collapse label="Was a lump sum payable under the scheme as a result of the death of the deceased?">
				<div class="mt-4"></div>
                <base-input 
                    label="Name of pension scheme or title of pension policy"
                    placeholder="Personal pension programme"></base-input>
                
                <label>Please describe the pension</label>
				<textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="What is the value of the lump sum?"
                    placeholder="£300,000"
                    type="number"
                    min="0"></base-input>
			</yes-no>
		</content-box>

		<content-box title="12.3 Pension Payment">
			<yes-no collapse label="Did the deceased, within two-years of their death, transfer or dispose of any benefits payable under a pension scheme or person pension policy?">
                <div class="mt-4"></div>
                <base-input
                    label="Name of pension scheme or title of pension policy"
                    placeholder="Personal pension programme"></base-input>
                
                <label>Please describe the pension</label>
				<textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
			</yes-no>
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

				}
		}
}
</script>

<style lang="scss" scoped>

</style>