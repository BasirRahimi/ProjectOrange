// A component must be globally registered so we can use it outside of .vue files
import BaseButton from '@/components/simple/BaseButton.vue';
import GrantAccess from '@/views/GrantAccess.vue';
import ClientForm from '@/views/ClientForm.vue';
import BaseInput from '@/components/simple/BaseInput.vue';
import RequestAccess from '@/components/auth/RequestAccess.vue';
import PageLoad from '@/views/PageLoad.vue';
export default {
    install: (app) => {
        app.component('BaseButton', BaseButton);
        app.component('BaseInput', BaseInput);
        app.component('ClientForm', ClientForm);
        app.component('GrantAccess', GrantAccess);
        app.component('RequestAccess', RequestAccess);
        app.component('PageLoad', PageLoad);
    }
};
