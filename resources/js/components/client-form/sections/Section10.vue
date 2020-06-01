<template>
    <div class="container">
        <content-box title="Section 9 - Business interests or partnerships">
            <yes-no class="form-group" label="Did the deceased own shares in a private company?" collapse>
                <div class="form-group mt-4">
                    <label>Company name</label>
                    <input type="text" class="form-control" placeholder="John Appleseed Ltd">
                </div>
                <div class="form-group">
                    <label>Company number</label>
                    <input type="text" class="form-control" placeholder="1235 1235 08311">
                </div>
                <div class="form-group">
                    <label>Business activity</label>
                    <input type="text" class="form-control" placeholder="Import & export">
                </div>

                <label class="my-3">Company accountant details</label>
                <honorific v-model="formData.accountant.honorific" />
                <div class="form-group">
                    <label>Forename</label>
                    <input type="text" placeholder="John" class="form-control">
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" placeholder="Doe" class="form-control">
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control" placeholder="+44 012345 67890">
                    </div>
                    <div class="col-12 col-lg-6 form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" placeholder="John.doe@doe.co.uk">
                    </div>
                </div>

                <label>If the company accountants have valued the shares in the business in line with HMRC guidelines then please provide a copy</label><br />
                <base-file-upload />
            </yes-no>

            <a v-b-toggle.collapse1 class="pointer">Tip<i class="icon-xs fas fa-chevron-down ml-2"></i></a>
            <b-collapse visible>
                <p class="text-gray-500 mt-2 mb-0">You should take care that the deceased had regularised their affairs with HMRC. For example, the Jersey Disclosure Facility provides for a voluntary disclosure facility to UK residents from 6 April 2013 to 30 September 2016 for UK residents with a beneficial interest in Jersey “relevant property”, with undisclosed UK tax liabilities, with a chance to regularise their UK tax affairs in a controlled manner on beneficial terms.</p>
            </b-collapse>
        </content-box>

        <content-box title="9.2 Partnerships">
            <yes-no label="Did the deceased a member of a partnership?" collapse>
                <div class="form-group mt-4">
                    <label>Company name</label>
                    <input type="text" class="form-control" placeholder="John Appleseed Ltd">
                </div>
                <div class="form-group">
                    <label>Company number</label>
                    <input type="text" class="form-control" placeholder="1235 1235 08311">
                </div>
                <div class="form-group">
                    <label>Business activity</label>
                    <input type="text" class="form-control" placeholder="Import & export">
                </div>

                <label class="my-3">Company accountant details</label>
                <honorific v-model="formData.accountant.honorific" />
                <div class="form-group">
                    <label>Forename</label>
                    <input type="text" placeholder="John" class="form-control">
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" placeholder="Doe" class="form-control">
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control" placeholder="+44 012345 67890">
                    </div>
                    <div class="col-12 col-lg-6 form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" placeholder="John.doe@doe.co.uk">
                    </div>
                </div>

                <label>If the company accountants have valued the shares in the business in line with HMRC guidelines then please provide a copy</label><br />
                <base-file-upload />
            </yes-no>
        </content-box>

        <content-box class="p-0 text-right" :shadow="false" :whiteBg="false">
            <button class="btn btn-primary shadow" @click="$router.push({name:'section11'})">Next section</button>
        </content-box>
    </div>
</template>

<script>
import BaseFileUpload from '../../base-components/BaseFileUpload.vue';
import YesNo from '../form-snippets/YesNo.vue';
import Honorific from '../form-snippets/Honorific.vue';
export default {
    components: {
        YesNo,
        Honorific,
        BaseFileUpload
    },
    data() {
        return {
            formData: {
                accountant: {
                    honorific: ''
                }
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>