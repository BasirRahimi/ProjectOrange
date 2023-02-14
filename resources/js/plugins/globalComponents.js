import Badge from '../components/Badge.vue';
import BaseAlert from '../components/BaseAlert.vue';
import BaseButton from '../components/BaseButton.vue';
import BaseCheckbox from '../components/BaseCheckbox.vue';
import BaseDropdown from '../components/BaseDropdown.vue';
import BaseInput from '../components/BaseInput.vue';
import BasePagination from '../components/BasePagination.vue';
import BaseProgress from '../components/BaseProgress.vue';
import BaseRadio from '../components/BaseRadio.vue';
import BaseSlider from '../components/BaseSlider.vue';
import BaseSwitch from '../components/BaseSwitch.vue';
import Card from '../components/Card.vue';
import Icon from '../components/Icon.vue';
import ClientForm from '../components/ClientForm.vue';
import UserDashboard from '../components/UserDashboard.vue';
import GrantAccess from '../components/GrantAccess.vue';
import AppHeader from '../components/AppHeader.vue';
import ContentBox from '../components/client-form/ContentBox.vue';
import RequestAccess from '../components/auth/RequestAccess.vue';

export default {
    install: (app) => {
        app.component('Badge', Badge);
        app.component('BaseAlert', BaseAlert);
        app.component('BaseButton', BaseButton);
        app.component('BaseCheckbox', BaseCheckbox);
        app.component('BaseDropdown', BaseDropdown);
        app.component('BaseInput', BaseInput);
        app.component('BasePagination', BasePagination);
        app.component('BaseProgress', BaseProgress);
        app.component('BaseRadio', BaseRadio);
        app.component('BaseSlider', BaseSlider);
        app.component('BaseSwitch', BaseSwitch);
        app.component('Card', Card);
        app.component('Icon', Icon);
        app.component('ClientForm', ClientForm);
        app.component('UserDashboard', UserDashboard);
        app.component('GrantAccess', GrantAccess);
        app.component('AppHeader', AppHeader);
        app.component('ContentBox', ContentBox);
        app.component('RequestAccess', RequestAccess);
    }
};
