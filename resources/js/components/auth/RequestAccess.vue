<template>
<VueSlickCarousel v-bind="slickSettings" ref="carousel">

    <div class="slide">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <h3 class="display-2 m-0">Welcome. Request access here.</h3>
                    <p class="text-gray-600 my-4">We need your work email address to save your data and to continue registering your account with us.</p>
                    <form @submit.prevent="processEmail">
                        <base-input placeholder="Your work email address" type="email" v-model="email" :formGroup="false"></base-input>
                        <p class="text-danger text-center m-0" v-for="(error, i) in errors" :key="i"><small>{{error}}</small></p>
                        <base-button 
                            class="hover-outline shadow w-75 d-block mx-auto mt-3"
                            :class="{'opacity-0': !emailValidity}"
                            type="primary"
                            :disabled="working || !emailValidity"
                            nativeType="submit" 
                            >Continue</base-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <h3 class="display-2 m-0">Enter your phone number</h3>
                    <p class="text-gray-600 my-4">We will only use this number for account setup and for security purposes, such as two-factor authentication. We do not share personal information with third parties.</p>
                    <form @submit.prevent="processMobile(false)" class="pt-2">
                        <vue-tel-input
                            v-model="mobile"
                            placeholder="Your mobile number"
                            required
                            :preferredCountries="['GB']"
                            wrapperClasses="d-flex"
                            inputClasses="form-control"
                            @validate="mobileValidated"
                            ></vue-tel-input>
                        
                        <base-button 
                            class="hover-outline shadow w-75 d-block mx-auto mt-3"
                            :class="{'opacity-0': !mobileIsValid}"
                            :disabled="working || !mobileIsValid"
                            type="primary"
                            nativeType="submit" 
                            >Continue</base-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <h3 class="display-2 mb-3">Confirm your phone number</h3>
                    <p class="display-2 m-0 text-gray-600">{{user.phone}}</p>
                    <p class="text-gray-600 my-4">We sent you an SMS code.<br>Didn't recieve your code? <a href="#" @click.prevent="prevSlide">Edit phone number</a></p>
                    <form @submit.prevent="validateCode" class="pt-2">
                        <base-input 
                            v-model="verificationCode"
                            placeholder="Enter your code"
                            :formGroup="false"></base-input>
                            <p class="text-gray-600 m-0"><small>Haven't received it yet? <a href="#" @click.prevent="processMobile(true)">Resend your code</a></small></p>                        
                        
                        <base-button 
                            class="hover-outline shadow w-75 d-block mx-auto mt-3"
                            :class="{'opacity-0': verificationCode.length < 1}" 
                            :disabled="working || verificationCode.length < 1"
                            type="primary"
                            nativeType="submit" 
                            >Continue</base-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <h3 class="display-2 mb-3">Personal details</h3>
                    <p class="text-gray-600 my-4">Tell us a little bit more about you so we know who we're talking to.</p>
                    <form @submit.prevent="saveUserDetails" class="pt-2">
                        <div class="d-flex align-items-center">
                            <div class="form-group mr-3">
                                <select v-model="title" class="form-control">
                                    <option value="Mr." selected>Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </div>
                            <base-input class="flex-grow-1" v-model="firstname" placeholder="First name"></base-input>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <base-input v-model="lastname" placeholder="Last name"></base-input>
                            </div>
                            <div class="col-12">
                                <base-input v-model="company" placeholder="Company (optional)"></base-input>
                            </div>
                        </div>

                        <base-button 
                            class="hover-outline shadow w-75 d-block mx-auto mt-3"
                            :class="{'opacity-0': firstname.length == 0 || lastname.length == 0}" 
                            :disabled="working || firstname.length == 0 || lastname.length == 0"
                            type="primary"
                            nativeType="submit" 
                            >Submit</base-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
                    <h3 class="display-2 mb-3">Thank you.</h3>
                    <p class="text-gray-600">
                        Information received
                    </p>
                    <p class="text-gray-600">
                        We've received your request for access to Project Orange. We're reviewing your details and will notify you shortly whether we approve your access or not.
                    </p>
                    <p class="text-gray-600">
                        Keep an eye on your email's. We'll follow up shortly.
                    </p>
                    <p class="text-gray-600">Need some help? <a href="#">Contact us</a></p>
                </div>
                <div class="col-12 col-md-6">
                    <img src="/images/email_illustration.svg" alt="email illustration">
                </div>
            </div>
        </div>
    </div>

</VueSlickCarousel>
</template>

<script>
import { VueTelInput } from 'vue-tel-input';
import VueSlickCarousel from 'vue-slick-carousel';
import 'vue-slick-carousel/dist/vue-slick-carousel.css';
export default {
    name: 'request-access',
    components: {
        VueSlickCarousel,
        VueTelInput
    },
    data() {
        return {
            working: false,
            email: '',
            mobile: '',
            errors: [],
            user: {},
            slickSettings: {
                accessibility: false,
                adaptiveHeight: true,
                arrows: false,
                draggable: false,
                infinite: false,
                swipe: false
            },
            mobileIsValid: false,
            verificationCode: '',
            title: 'Mr.',
            firstname: '',
            lastname: '',
            company: ''
        }
    },
    mounted() {
        this.$nextTick(() => {
            $('.slide .vti__input').removeClass('vti__input');
            $('.slide .vue-tel-input').removeClass('vue-tel-input');
            $('.slide .vti__dropdown').addClass('form-control w-auto');
        });

    },
    computed: {
        emailValidity() {
            return this.validateEmail(this.email);
        }
    },
    methods: {
        processEmail() {
            if(this.working) return;
            
            this.errors = [];
            let _self = this;
            
            _self.working = true;
            axios.post('/request-access', {email: _self.email}).then(response=>{
                if(response.data.errors) {
                    response.data.errors.forEach(error => {
                        _self.errors.push(error);
                    });
                    _self.working = false;
                } else {
                    //success
                    _self.user = response.data.user;
                    _self.$refs.carousel.next();
                    _self.working = false;
                }
            }).catch(error=>{
                console.log(error);
                _self.working = false;
            });
        },
        processMobile(resendCode) {
            if(this.working) return;

            this.errors = [];
            let _self = this;

            if(resendCode) {
                axios.post('/request-access/sms-verification', {user: _self.user}).then(response=>{
                    _self.user = response.data.user;
                    _self.working = false;
                }).catch(error=>{
                    console.log(error);
                    _self.working = false;
                })
            } else {
                _self.working = true;
                axios.post('/request-access/sms-verification', {phone: _self.mobile, user: _self.user}).then(response=>{
                    _self.user = response.data.user;
                    _self.$refs.carousel.next();
                    _self.working = false;
                }).catch(error=>{
                    console.log(error);
                    _self.working = false;
                })
            }
        },
        validateCode() {
            let _self = this;
            _self.working = true;

            if(this.verificationCode == '1234') {
                axios.post('/request-access/phone-verified', {user: _self.user}).then(response=>{
                    this.$refs.carousel.next();
                    _self.working = false;
                }).catch(error=>{
                    console.log(error);
                    _self.working = false;
                });
            } else {
                // incorrect verifcation code show error
            }
        },
        saveUserDetails() {
            let _self = this;
            _self.working = true; 

            axios.post('/request-access/save-user-details', {
                user: _self.user,
                firstname: _self.firstname,
                lastname: _self.lastname,
                title: _self.title,
                company: _self.company
            }).then(response=>{
                _self.$refs.carousel.next();
                _self.working = false;
            }).catch(error=>{
                console.log(error);
                _self.working = false;
            })
        },
        mobileValidated(data) {
            this.mobileIsValid = data.isValid;
        },
        prevSlide() {
            this.$refs.carousel.prev();
        }
    }
}
</script>
<style lang="scss">
.slide {
    height: 100vh;
    position: relative;
    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }

    .vti__dropdown {
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #cad1d7;
        border-radius: 0.25rem;
        transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        margin-right: 16px;

    }
}
</style>