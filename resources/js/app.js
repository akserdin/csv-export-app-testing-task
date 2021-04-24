import Vue from 'vue';
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue';
import CSVGenerator from "./components/CSVGenerator";

Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);

require('./bootstrap');

window.Vue = Vue;

const app = new Vue({
    el: '#app',
    components: {
        'csv-generator': CSVGenerator
    }
});
