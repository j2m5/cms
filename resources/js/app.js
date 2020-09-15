/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

import Vue from 'vue'
import App from './admin/src/App'
import store from './admin/src/store'
import router from './admin/src/router'
import vuetify from './admin/src/plugins/vuetify'

import VueToast from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-sugar.css'
Vue.use(VueToast, {
  position: 'top',
  duration: 3000
})

import DatetimePicker from 'vuetify-datetime-picker'
Vue.use(DatetimePicker)

import VuetifyConfirm from 'vuetify-confirm'
Vue.use(VuetifyConfirm, {
  vuetify,
  buttonTrueText: 'Да',
  buttonFalseText: 'Отмена',
  color: 'error',
  icon: 'mdi-alert',
  title: 'Внимание'
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
  el: '#app',
  components: { App },
  vuetify,
  router,
  store
})
