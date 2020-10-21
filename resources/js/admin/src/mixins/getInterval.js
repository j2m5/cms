export default {
  data() {
    return {
      interval: new Date().getFullYear() + '-' + (Number(new Date().toISOString().substr(0, 4)) + 1)
    }
  },
  methods: {
    getInterval(interval) {
      interval = interval.split('-')
      const startYear = '-01-01'
      return [interval[0] + startYear, interval[1] + startYear]
    }
  }
}
