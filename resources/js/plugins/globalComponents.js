import Badge from "../components/Badge.vue";
import BaseAlert from "../components/BaseAlert.vue";
import BaseButton from "../components/BaseButton.vue";
import BaseCheckbox from "../components/BaseCheckbox.vue";
import BaseDropdown from "../components/BaseDropdown.vue";
import BaseInput from "../components/BaseInput.vue";
import BasePagination from "../components/BasePagination.vue";
import BaseProgress from "../components/BaseProgress.vue";
import BaseRadio from "../components/BaseRadio.vue";
import BaseSlider from "../components/BaseSlider.vue";
import BaseSwitch from "../components/BaseSwitch.vue";
import Card from "../components/Card.vue";
import Icon from "../components/Icon.vue";
import ClientForm from '../components/ClientForm.vue';
import UserDashboard from '../components/UserDashboard.vue'
import GrantAccess from '../components/GrantAccess.vue';
import AppHeader from '../components/AppHeader.vue';
import ContentBox from '../components/client-form/ContentBox.vue';
import RequestAccess from '../components/auth/RequestAccess.vue';

export default {
    install: (app) => {
        app.component(Badge.name, Badge);
        app.component(BaseAlert.name, BaseAlert);
        app.component(BaseButton.name, BaseButton);
        app.component(BaseCheckbox.name, BaseCheckbox);
        app.component(BaseDropdown.name, BaseDropdown);
        app.component(BaseInput.name, BaseInput);
        app.component(BasePagination.name, BasePagination);
        app.component(BaseProgress.name, BaseProgress);
        app.component(BaseRadio.name, BaseRadio);
        app.component(BaseSlider.name, BaseSlider);
        app.component(BaseSwitch.name, BaseSwitch);
        app.component(Card.name, Card);
        app.component(Icon.name, Icon);
        app.component(ClientForm.name, ClientForm);
        app.component(UserDashboard.name, UserDashboard);
        app.component(GrantAccess.name, GrantAccess);
        app.component(AppHeader.name, AppHeader);
        app.component(ContentBox.name, ContentBox);
        app.component(RequestAccess.name, RequestAccess);
    }
}