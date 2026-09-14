import signUp from './components/signUp.js';
import registrationForm from './components/registrationForm.js';
import setPassword from './components/setPassword.js';

const template = `
<div class="panel" :class="'panel-' + widgetParams.colorTheme">
    <div
        v-if="successMessage"
        v-html="successMessage"
        class="panel-body text-center"
    ></div>
    <template v-else-if="!isConfirmationPage">
        <signUp
            :whySignUp="widgetParams.whySignUp"
        />
        <hr>
        <registrationForm
            :whyDoWeNeedThisInfo="widgetParams.whyDoWeNeedThisInfo"
            :termsAndConditions="widgetParams.termsAndConditions"
            :optionsData="optionsData"
            :captcha="captcha"
            :localizationDateFormat="localizationDateFormat"
        />
    </template>
    <setPassword
        v-else
        :captcha="captcha"
    />
</div>
`;

export default {
    name: 'camsCustomerRegistration',
    template,
    components: {
        signUp,
        registrationForm,
        setPassword,
    },
    props: {
        captcha: String,
        widgetParams: Object,
        optionsData: Object,
        isConfirmationPage: Boolean,
        successMessage: String,
        localizationDateFormat: String,
    },
};
