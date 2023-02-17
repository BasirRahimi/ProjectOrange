import Badge from '@/components/base-components/Badge.vue';
import BaseAlert from '@/components/base-components/BaseAlert.vue';
import BaseButton from '@/components/base-components/BaseButton.vue';
import BaseCheckbox from '@/components/base-components/BaseCheckbox.vue';
import BaseDropdown from '@/components/base-components/BaseDropdown.vue';
import BaseInput from '@/components/base-components/BaseInput.vue';
import BasePagination from '@/components/base-components/BasePagination.vue';
import BaseProgress from '@/components/base-components/BaseProgress.vue';
import BaseRadio from '@/components/base-components/BaseRadio.vue';
import BaseSlider from '@/components/base-components/BaseSlider.vue';
import BaseSwitch from '@/components/base-components/BaseSwitch.vue';
import BCollapse from '@/components/base-components/BCollapse.vue';
import Card from '@/components/base-components/Card.vue';
import Icon from '@/components/base-components/Icon.vue';
import BModal from '@/components/base-components/BModal.vue';
import ContentBox from '@/components/client-form/ContentBox.vue';
import ClientForm from '@/components/ClientForm.vue';
import UserDashboard from '@/components/UserDashboard.vue';
import GrantAccess from '@/components/GrantAccess.vue';
import AppHeader from '@/components/AppHeader.vue';
import RequestAccess from '@/components/auth/RequestAccess.vue';

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
        app.component('BCollapse', BCollapse);
        app.component('Card', Card);
        app.component('Icon', Icon);
        app.component('BModal', BModal);
        app.component('ClientForm', ClientForm);
        app.component('UserDashboard', UserDashboard);
        app.component('GrantAccess', GrantAccess);
        app.component('AppHeader', AppHeader);
        app.component('ContentBox', ContentBox);
        app.component('RequestAccess', RequestAccess);
    }
};
