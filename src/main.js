// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false;
window.axios = require('axios');


/* eslint-disable no-new */
const app = new Vue({
  el: '#app',
  // router,
  components: { App },
  template: '<App/>'
});
