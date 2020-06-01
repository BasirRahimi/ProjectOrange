<template>
    <div class="container">
        <content-box title="Section 2 - Powers of Attorney and non-UK elements">
            <yes-no class="form-group" label="Did the deceased make an ENDURING power of attorney?" collapse>
                <base-file-upload class="mt-3"></base-file-upload>
            </yes-no>
            <yes-no class="form-group" label="Did the deceased make a LASTING power of attorney?" collapse>
                <base-file-upload class="mt-3"></base-file-upload>
            </yes-no>
            
            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse1">
                <p class="text-gray-500 mt-2">When a person dies, the Power of Attorney ceases to have effect. The Attorney must hand over their responsibilities to the Executors. If a Power of Attorney has been registered with the Office of the Public Guardian then the death certificate must be registered with that office.</p>
            </b-collapse>
        </content-box>

        <content-box title="2.2 Domicile, residence and non-UK assets">
            <yes-no collapse label="Was the deceased born in the UK and did they spend all of their life as a UK resident?">
                <div class="form-group mt-4">
                    <label for="query3q1">In what City/Country was the deceased born?</label>
                    <input type="text" name="birthCountry" id="query3q1" class="form-control" placeholder="Paris, France">
                </div>
                <div class="form-group">
                    <label for="query3q2">What was their father’s domicile when the deceased was born?</label>
                    <input type="text" name="fathersDomicile" id="query3q2" class="form-control" placeholder="French">
                </div>
                
                <button-group class="form-group" label="Was the deceased treated as a UK resident for Income Tax purposes?" :options="['Yes', 'No', 'Unsure']" v-model="formData.query3.question3.answer"></button-group>
                
                <button-group class="form-group" label="Do you know if Sharia Law applies to this estate?" :options="['Yes', 'No', 'Unsure']" v-model="formData.query3.question4.answer"></button-group>
            </yes-no>
        </content-box>

        <content-box title="2.3 A brief narrative of the life of the deceased">
            <div v-show="formData.query4.slide === 1">
                <div class="form-group">
                    <label for="educationHistory">Education history</label>
                    <textarea id="educationHistory" class="form-control" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
                </div>
            </div>
            <div v-show="formData.query4.slide === 2">
                <div class="form-group">
                    <label for="educationHistory">Employment history</label>
                    <textarea id="educationHistory" class="form-control" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
                </div>
            </div>
            <div v-show="formData.query4.slide === 3">
                <div class="form-group">
                    <label for="educationHistory">Nationality at Birth</label>
                    <textarea id="educationHistory" class="form-control" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
                </div>
            </div>    
            <div v-show="formData.query4.slide === 4">
                <div class="form-group">
                    <label for="educationHistory">Nationality at Death</label>
                    <textarea id="educationHistory" class="form-control" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
                </div>
            </div>    
            <div v-show="formData.query4.slide === 5">
                <p>Estate Duty and Capital Transfer Tax details:</p>

                <yes-no class="form-group" label="Was the deceased female?" v-model="formData.query4.slide5.answer">
                </yes-no>
                
                <yes-no class="form-group" label="Was the deceased born before 1/2/1974?" v-model="formData.query4.slide5.answer2">
                </yes-no>
                
                <b-collapse :visible="formData.query4.slide5.answer === true">
                    <div class="form-group">
                        <label for="husbandbirthplace">Where was their husband born?</label>
                        <input id="husbandbirthplace" type="text" class="form-control" placeholder="France">
                    </div>
                    <div class="form-group">
                        <label for="husbandbirthnationality">What was his nationality at birth?</label>
                        <input id="husbandbirthnationality" type="text" class="form-control" placeholder="French">
                    </div>
                    <div class="form-group">
                        <label for="husbanddeathnationality">What was his nationality at death?</label>
                        <input id="husbanddeathnationality" type="text" class="form-control" placeholder="French">
                    </div>
                </b-collapse>
            </div>
            <div v-show="formData.query4.slide === 6">
                <div class="form-group">
                    <label for="ukvisitdetails">Details of visits to the UK and the length of those visits</label>
                    <textarea id="ukvisitdetails" class="form-control" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
                </div>
            </div>    
            <div v-show="formData.query4.slide === 7">
                <div class="form-group">
                    <label for="countrieslivedin">The countries the deceased lived in</label>
                    <textarea id="countrieslivedin" class="form-control" rows="4" placeholder="Please include a full overview of relevant details to this question"></textarea>
                </div>
                <div class="form-group">
                    <label>Do you know if the deceased intended to live in the UK for the rest of their lives?</label><br/>
                    <button class="btn btn-outline-secondary active-primary mr-3 mb-3" :class="{'active': formData.query4.slide7.answer === 'yes'}" @click="formData.query4.slide7.answer = 'yes'">Yes</button>
                    <button class="btn btn-outline-secondary active-primary mr-3 mb-3" :class="{'active': formData.query4.slide7.answer === 'no'}" @click="formData.query4.slide7.answer = 'no'">No</button>
                    <button class="btn btn-outline-secondary active-primary mr-3 mb-3" :class="{'active': formData.query4.slide7.answer === 'unsure'}" @click="formData.query4.slide7.answer = 'unsure'">Unsure</button>

                </div>
            </div> 

            <div class="d-flex align-items-center justify-content-between">
                <div>Step {{formData.query4.slide}}/7</div>
                <div>
                    <button v-if="formData.query4.slide > 1" class="btn btn-outline-secondary mr-3" @click="prevSlide">Previous</button>
                    <button v-if="formData.query4.slide < 7" class="btn btn-outline-secondary" @click="nextSlide">Next</button>
                </div>
            </div>

            <a v-b-toggle.collapse2 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible id="collapse2">
                <p class="text-gray-500 mt-2">Domicile and residence is relevant because it affects the law that governs succession. Since 17.8.2016 a new European Regulation affects succession within EU member states. The UK and Eire have not opted in to the Regulation (Denmark has opted out) but it will nonetheless affect individuals connected with the EU. If you are a beneficiary of this estate and there are non-UK assets involved, you should consider your own Will now. Do not wait until the estate has been administered.</p>
            </b-collapse>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section4'})">Next section</button>
        </content-box>
    </div>
</template>

<script>
import BaseFileUpload from '../../base-components/BaseFileUpload.vue';
import YesNo from '../form-snippets/YesNo.vue';
import ButtonGroup from '../form-snippets/ButtonGroup.vue';
export default {
    components: {
        BaseFileUpload,
        YesNo,
        ButtonGroup
    },
    data() {
        return {
            formData: {
                query1: {
                    answer: null,
                },
                query2: {
                    answer: null,
                },
                query3: {
                    answer: null,
                    question3: {
                        answer: null
                    },
                    question4: {
                        answer: null
                    }
                },
                query4: {
                    slide: 1,
                    slide5: {
                        answer: null,
                        answer2: null
                    },
                    slide7: {
                        answer: null
                    }
                }
            }
        };
    },
    methods: {
        nextSlide() {
            if(this.formData.query4.slide < 7) {
                this.formData.query4.slide++;
            }
        },
        prevSlide() {
            if(this.formData.query4.slide > 1) {
                this.formData.query4.slide--;
            }
        }
    }
};
</script>

<style lang="scss" scoped>
</style>