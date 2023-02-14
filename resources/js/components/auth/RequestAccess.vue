<template>
    <div ref="carousel">
        <div class="slide">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <h3 class="display-2 m-0">
                            Welcome. Request access here.
                        </h3>
                        <p class="text-gray-600 my-4">
                            We need your work email address to save your data
                            and to continue registering your account with us.
                        </p>
                        <form @submit.prevent="processEmail">
                            <BaseInput
                                placeholder="Your work email address"
                                type="email"
                                v-model="email"
                                :formGroup="false"
                                name="email"></BaseInput>
                            <p
                                class="text-danger text-center m-0"
                                v-for="(error, i) in errors"
                                :key="i">
                                <small v-html="error"></small>
                            </p>
                            <small class="d-block p-1">
                                By confirming your email, you agree to our
                                <a href="#">Terms of Service</a> and that you
                                have read and understood our
                                <a href="#">Privacy Policy</a>
                            </small>
                            <BaseButton
                                class="hover-outline shadow w-75 d-block mx-auto mt-3"
                                :class="{ 'opacity-0': !emailValidity }"
                                type="primary"
                                :disabled="working || !emailValidity"
                                nativeType="submit"
                                >Continue</BaseButton
                            >
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <h3 class="display-2 my-4">Enter a password</h3>
                        <form @submit.prevent="nextSlide">
                            <BaseInput
                                type="password"
                                v-model="password"
                                name="password"
                                placeholder="password"></BaseInput>
                            <BaseInput
                                type="password"
                                v-model="passwordMatch"
                                :formGroup="false"
                                name="passwordMatch"
                                placeholder="confirm password"></BaseInput>
                            <BaseButton
                                class="hover-outline shadow w-75 d-block mx-auto mt-3"
                                :class="{ 'opacity-0': !passwordValid }"
                                type="primary"
                                :disabled="working || !passwordValid"
                                nativeType="submit"
                                >Continue</BaseButton
                            >
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
                        <p class="text-gray-600 my-4">
                            We will only use this number for account setup and
                            for security purposes, such as two-factor
                            authentication. We do not share personal information
                            with third parties.
                        </p>
                        <form @submit.prevent="nextSlide" class="pt-2">
                            <BaseInput
                                type="tel"
                                v-model="mobile"
                                placeholder="Your mobile number"
                                required
                                @input="validateMobile"></BaseInput>
                            <BaseButton
                                class="hover-outline shadow w-75 d-block mx-auto mt-3"
                                :class="{ 'opacity-0': !mobileIsValid }"
                                :disabled="working || !mobileIsValid"
                                type="primary"
                                nativeType="submit"
                                >Continue</BaseButton
                            >
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="slide">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <h3 class="display-2 mb-3">Confirm your phone number</h3>
                        <p class="display-2 m-0 text-gray-600" v-if="user">{{user.phone}}</p>
                        <p class="text-gray-600 my-4">We sent you an SMS code.<br>Didn't recieve your code? <a href="#" @click.prevent="prevSlide">Edit phone number</a></p>
                        <form @submit.prevent="validateCode" class="pt-2">
                            <BaseInput 
                                v-model="verificationCode"
                                placeholder="Enter your code"
                                :formGroup="false"></BaseInput>
                                <p class="text-gray-600 m-0"><small>Haven't received it yet? <a href="#" @click.prevent="processMobile(true)">Resend your code</a></small></p>                        
                            
                            <BaseButton 
                                class="hover-outline shadow w-75 d-block mx-auto mt-3"
                                :class="{'opacity-0': verificationCode.length < 1}" 
                                :disabled="working || verificationCode.length < 1"
                                type="primary"
                                nativeType="submit" 
                                >Continue</BaseButton>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="slide">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <h3 class="display-2 mb-3">Personal details</h3>
                        <p class="text-gray-600 my-4">
                            Tell us a little bit more about you so we know who
                            we're talking to.
                        </p>
                        <form @submit.prevent="saveUserDetails" class="pt-2">
                            <div class="d-flex align-items-center">
                                <div class="form-group mr-3">
                                    <select
                                        v-model="title"
                                        class="form-control">
                                        <option value="Mr." selected>
                                            Mr.
                                        </option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms</option>
                                    </select>
                                </div>
                                <BaseInput
                                    class="flex-grow-1"
                                    v-model="firstname"
                                    placeholder="First name"></BaseInput>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <BaseInput
                                        v-model="lastname"
                                        placeholder="Last name"></BaseInput>
                                </div>
                                <div class="col-12">
                                    <BaseInput
                                        v-model="company"
                                        placeholder="Company (optional)"></BaseInput>
                                </div>
                            </div>

                            <BaseButton
                                class="hover-outline shadow w-75 d-block mx-auto mt-3"
                                :class="{
                                    'opacity-0':
                                        firstname.length == 0 ||
                                        lastname.length == 0
                                }"
                                :disabled="
                                    working ||
                                    firstname.length == 0 ||
                                    lastname.length == 0
                                "
                                type="primary"
                                nativeType="submit"
                                >Submit</BaseButton
                            >
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="container">
                <div class="row justify-content-center">
                    <div
                        class="col-12 col-md-6 d-flex flex-column justify-content-center">
                        <h3 class="display-2 mb-3">Thank you.</h3>
                        <p class="text-gray-600">Information received</p>
                        <p class="text-gray-600">
                            We've received your request for access to Project
                            Orange. We're reviewing your details and will notify
                            you shortly whether we approve your access or not.
                        </p>
                        <p class="text-gray-600">
                            Keep an eye on your email's. We'll follow up
                            shortly.
                        </p>
                        <p class="text-gray-600">
                            Need some help? <a href="#">Contact us</a>
                        </p>
                    </div>
                    <div class="col-12 col-md-6">
                        <img
                            :src="emailIllustration"
                            alt="email illustration" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onBeforeMount, onMounted, nextTick, computed } from 'vue';
import emailIllustration from '@images/email_illustration.svg';
import { useValidateEmail } from '@/composables/helper.js';

const props = defineProps({
    userProp: {
        type: String,
        default: null,
        description: 'Json string'
    }
});

const working = ref(false);
const email = ref('');
const password = ref('');
const passwordMatch = ref('');
const mobile = ref('');
const errors = ref([]);
const user = ref({});
const slickSettings = {
    accessibility: false,
    adaptiveHeight: true,
    arrows: false,
    draggable: false,
    infinite: false,
    swipe: false,
    initialSlide: 0
};
const mobileIsValid = ref(false);
const verificationCode = ref('');
const title = ref('Mr.');
const firstname = ref('');
const lastname = ref('');
const company = ref('');

const carousel = ref(null);

const processEmail = () => {
    if (working.value) return;

    errors.value = [];

    working.value = true;
    axios
        .post('/request-access', { email: email.value })
        .then((response) => {
            if (response.data.errors) {
                response.data.errors.forEach((error) => {
                    errors.value.push(error);
                });
                working.value = false;
            } else {
                //success
                user.value = response.data.user;
                nextSlide();
                working.value = false;
            }
        })
        .catch((error) => {
            console.log(error);
            working.value = false;
        });
};
const processMobile = (resendCode) => {
    if (working.value) return;

    errors.value = [];

    if (resendCode) {
        axios
            .post('/request-access/sms-verification', { user: user.value })
            .then((response) => {
                user.value = response.data.user;
                working.value = false;
            })
            .catch((error) => {
                console.log(error);
                working.value = false;
            });
    } else {
        working.value = true;
        axios
            .post('/request-access/sms-verification', { phone: mobile.value })
            .then((response) => {
                user.value = response.data.user;
                nextSlide();
                working.value = false;
            })
            .catch((error) => {
                console.log(error);
                working.value = false;
            });
    }
};
const validateCode = () => {
    working.value = true;

    if (verificationCode.value == '1234') {
        axios
            .post('/request-access/phone-verified', { user: user.value })
            .then((response) => {
                nextSlide();
                working.value = false;
            })
            .catch((error) => {
                console.log(error);
                working.value = false;
            });
    } else {
        // incorrect verifcation code show error
    }
};
const saveUserDetails = () => {
    working.value = true;

    axios
        .post('/request-access/save-user-details', {
            email: email.value,
            password: password.value,
            phone: mobile.value.trim(),
            title: title.value,
            firstname: firstname.value,
            lastname: lastname.value,
            company: company.value
        })
        .then((response) => {
            nextSlide();
            working.value = false;
        })
        .catch((error) => {
            console.log(error);
            working.value = false;
        });
};
const validateMobile = (data) => {
    // TODO: VALIDATE MOBILE
    mobileIsValid.value = true;
};
const prevSlide = () => {
    $(carousel.value).slick('slickPrev');
};
const nextSlide = () => {
    $(carousel.value).slick('slickNext');
};
const setSlide = (i) => {
    $(carousel.value).slick('slickGoTo', i);
};

const emailValidity = computed(() => {
    return useValidateEmail(email.value);
});

const passwordValid = computed(() => {
    return password.value.length > 0 && password.value === passwordMatch.value;
});

onBeforeMount(() => {
    $('*').on('keydown', (e) => {
        if (e.which == 9) e.preventDefault(); // ACCESSIBILITY ISSUES
    });
    if (props.userProp) {
        user.value = JSON.parse(props.userProp);
        if (!user.value.phone) {
            // no phone entered
            slickSettings.initialSlide = 1;
        } else if (!user.value.phone_verified_at) {
            // phone not verfied
            slickSettings.initialSlide = 2;
            processMobile(true);
        } else if (
            !user.value.honorific ||
            !user.value.name ||
            !user.value.surname
        ) {
            // personal details not entered
            slickSettings.initialSlide = 3;
        } else {
            // waiting for access
            slickSettings.initialSlide = 4;
        }
    }
});

onMounted(async () => {
    $(carousel.value).slick(slickSettings);
    await nextTick();
    $('.slide .vti__input').removeClass('vti__input');
    $('.slide .vue-tel-input').removeClass('vue-tel-input');
    $('.slide .vti__dropdown').addClass('form-control w-auto');
});
</script>

<style lang="scss">
.slide {
    height: 100vh;
    position: relative;

    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
}
</style>
