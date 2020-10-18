<template>
  <v-card>
    <v-card-title>
      <div>Новые пользователи за выбранный интервал</div>
      <v-spacer />
      <v-select v-model="interval" :items="years.grouped" label="Выберите интервал" @change="changeInterval" />
    </v-card-title>
    <v-divider />
    <ve-line :loading="loading" :data="chartData" :settings="chartSettings" />
  </v-card>
</template>

<script>
import 'v-charts/lib/style.css'
import { getRequest } from '../../../api/api'
import getYears from '../../../mixins/getYears'
import VeLine from 'v-charts/lib/line.common'
export default {
  name: 'UserChart',
  components: { VeLine },
  mixins: [getYears],
  data() {
    return {
      loading: false,
      visible: false,
      interval: [new Date().getFullYear() + '-01-01', new Date().toISOString().substr(0, 10)],
      chartData: null,
      chartSettings: {
        stack: { 'sell': ['Всего', 'Пользователи', 'Потенциальные боты'] },
        area: true
      }
    }
  },
  computed: {
    intervalText() {
      return this.interval.join(' => ')
    }
  },
  created() {
    this.getChart(this.interval)
  },
  methods: {
    getChart(interval) {
      this.loading = true
      getRequest('dashboard/users', { params: { interval: interval }}).then((res) => {
        this.chartData = res.data || []
      }).finally(() => {
        this.loading = false
        if (this.visible) this.visible = false
      })
    },
    changeInterval(event) {
      const interval = event.split('-')
      const startYear = '-01-01'
      this.getChart([interval[0] + startYear, interval[1] + startYear])
    }
  }
}
</script>

<style scoped>

</style>
