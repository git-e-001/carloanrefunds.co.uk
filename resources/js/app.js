require('./bootstrap');

window.Vue = require('vue');


import VueDataScooper from "vue-data-scooper";
import VeeValidate from "vee-validate";

Vue.use(VueDataScooper);
Vue.use(VeeValidate);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('previous-addresses', require('./components/PreviousAddresses.vue').default);

if (document.getElementById("customer-info-form")) {
    const apply_customer_info = new Vue({
        el: '#customer-info-form',
        data() {
            return {
                lived_another_address: false
            }
        },
        created() {
            if ($("#isPreviewAddressradioField").data('isoldpreview')) {
                this.lived_another_address = true
            } else {
                this.lived_another_address = false
            }
        }
    });
}

if(document.getElementById("partial-loans-form")){
    const apply_partial_loans = new Vue({
        el: '#partial-loans-form'
    });
}
