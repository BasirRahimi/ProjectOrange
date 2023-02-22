// A component must be globally registered so we can use it outside of .vue files
import BaseButton from '@/components/simple/BaseButton.vue';
import UserDashboard from '@/views/UserDashboard.vue';
import GrantAccess from '@/views/GrantAccess.vue';
import ClientForm from '@/views/ClientForm.vue';
import BaseDropdown from '@/components/simple/BaseDropdown.vue';

// import Badge from '@/components/simple/Badge.vue';
// import BaseAlert from '@/components/simple/BaseAlert.vue';
// import BaseCheckbox from '@/components/simple/BaseCheckbox.vue';
import BaseInput from '@/components/simple/BaseInput.vue';
// import BasePagination from '@/components/simple/BasePagination.vue';
// import BaseProgress from '@/components/simple/BaseProgress.vue';
// import BaseRadio from '@/components/simple/BaseRadio.vue';
// import BaseSlider from '@/components/simple/BaseSlider.vue';
// import BaseSwitch from '@/components/simple/BaseSwitch.vue';
// import BCollapse from '@/components/simple/BCollapse.vue';
// import Card from '@/components/simple/Card.vue';
// import Icon from '@/components/simple/Icon.vue';
// import BModal from '@/components/simple/BModal.vue';
// import ContentBox from '@/components/forms/ContentBox.vue';
import RequestAccess from '@/components/auth/RequestAccess.vue';

export default {
    install: (app) => {
        // app.component('Badge', Badge);
        // app.component('BaseAlert', BaseAlert);
        app.component('BaseButton', BaseButton);
        // app.component('BaseCheckbox', BaseCheckbox);
        app.component('BaseDropdown', BaseDropdown);
        app.component('BaseInput', BaseInput);
        // app.component('BasePagination', BasePagination);
        // app.component('BaseProgress', BaseProgress);
        // app.component('BaseRadio', BaseRadio);
        // app.component('BaseSlider', BaseSlider);
        // app.component('BaseSwitch', BaseSwitch);
        // app.component('BCollapse', BCollapse);
        // app.component('Card', Card);
        // app.component('Icon', Icon);
        // app.component('BModal', BModal);
        app.component('ClientForm', ClientForm);
        app.component('UserDashboard', UserDashboard);
        app.component('GrantAccess', GrantAccess);
        // app.component('AppHeader', AppHeader);
        // app.component('ContentBox', ContentBox);
        app.component('RequestAccess', RequestAccess);
    }
};
