import { getRequest } from '../api/api'
export default {
  data() {
    return {
      years: {
        flatten: [],
        grouped: []
      }
    }
  },
  created() {
    this.getYears()
  },
  methods: {
    getYears() {
      getRequest('dashboard/years').then((res) => {
        this.years = res.data.years || {}
      })
    }
  }
}
