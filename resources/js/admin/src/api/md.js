import Vue from 'vue'
import VueMaterial from 'vue-material'
Vue.use(VueMaterial)

// глобальный конфиг Vue Material Design

Vue.material = {
  ...Vue.material,
  locale: {
    ...Vue.material,
    startYear: 1900,
    endYear: 2099,

    // date format for date picker
    dateFormat: 'yyyy-MM-dd',

    // i18n strings
    days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    shortDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    shorterDays: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    shortMonths: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
    shorterMonths: ['J', 'F', 'M', 'A', 'M', 'Ju', 'Ju', 'A', 'Se', 'O', 'N', 'D'],

    // `0` stand for Sunday, `1` stand for Monday
    firstDayOfAWeek: 1,

    cancel: 'Отмена',
    confirm: 'Да'
  }
}
