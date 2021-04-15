require('./bootstrap');

require('alpinejs');

import moment from "moment"
import Vue from 'vue/dist/vue.common.js';
import 'font-awesome/css/font-awesome.min.css';

window.Vue = Vue;

require('./load-components');
require('./forms/bootstrap');

Vue.filter('date', value => moment(value).format('MMMM d, Y'));

const app = new Vue({
    el: '#app',
});
