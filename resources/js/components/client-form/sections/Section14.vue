<template>
    <div class="container">
        <content-box title="Section 13 - Life Assurance">
			<p class="text-gray-500 m-0">HMRC requires information from you about simple life policies and other investments as follows</p>
        </content-box>

        <content-box title="13.1 Sums payable from insurance companies">
            <yes-no collapse label="Were any sums payable from insurance companies to the estate as a result of the death of the deceased?">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"></base-input>
                
                <label>Please describe the policies</label>
                <textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"></base-input>
                
                <label>If you have any relevant documents or correspondence to this, please upload copies</label><br/>
                <base-file-upload class="mb-0"></base-file-upload>
            </yes-no>
        </content-box>

        <content-box title="13.2 Investment Bonds">
            <yes-no collapse label="Did the deceased have any unit-linked investment bonds with insurance companies or other financial service providers that pay 101% of the value of the unit trusts to the estate?">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"></base-input>
                
                <label>Please describe the policies</label>
                <textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"></base-input>
                
                <label>If you have any relevant documents or correspondence to this, please upload copies</label><br/>
                <base-file-upload class="mb-0"></base-file-upload>
            </yes-no>
        </content-box>
        
        <content-box title="13.3 Investment or reinvestment">
            <yes-no collapse label="Did the deceased have any investment or reinvestment plans, bonds or contracts with financial services providers that pay out to the estate on death?">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"></base-input>
                
                <label>Please describe the policies</label>
                <textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"></base-input>
                
                <label>If you have any relevant documents or correspondence to this, please upload copies</label><br/>
                <base-file-upload class="mb-0"></base-file-upload>
            </yes-no>
        </content-box>
        
        <content-box title="13.3 Unit-linked investment bonds">
            <yes-no collapse label="Did the deceased have any insurance policies and unit-linked investment bonds that are payable to beneficiaries under trust and do not form part of the estate?">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"></base-input>
                
                <label>Please describe the policies</label>
                <textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"></base-input>
                
                <label>If you have any relevant documents or correspondence to this, please upload copies</label><br/>
                <base-file-upload class="mb-0"></base-file-upload>
            </yes-no>
        </content-box>
        
        <content-box title="13.4 Joint life assurances">
            <yes-no collapse label="Did the deceased have any joint life assurance policies under which the deceased was one of the lives assured but which remain in force after the death?">
                <div class="mt-4"></div>
                <base-input
                    label="Company name"
                    placeholder="Insurance Company"></base-input>
                
                <label>Please describe the policies</label>
                <textarea class="form-control mb-4" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>

                <base-input
                    label="Value of lump sum"
                    placeholder="£1,000,000"
                    type="number"
                    min="0"></base-input>
                
                <label>If you have any relevant documents or correspondence to this, please upload copies</label><br/>
                <base-file-upload class="mb-0"></base-file-upload>
            </yes-no>
        </content-box>
    </div>
</template>

<script>
import BaseFileUpload from '../../base-components/BaseFileUpload';
import YesNo from '../form-snippets/YesNo';
export default {
    components: {
        BaseFileUpload,
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