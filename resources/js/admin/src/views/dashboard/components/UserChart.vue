<template>
  <v-card>
    <v-card-title>
      <div>Новые пользователи за выбранный интервал</div>
      <v-spacer />
      <v-select v-model="interval" :items="years.grouped" label="Выберите интервал" @change="getChart" />
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
      interval: new Date().getFullYear() + '-' + (Number(new Date().toISOString().substr(0, 4)) + 1),
      chartData: null,
      chartSettings: {
        stack: { 'sell': ['Всего', 'Пользователи', 'Потенциальные боты'] },
        area: true
      }
    }
  },
  created() {
    this.getChart(this.interval)
  },
  methods: {
    getChart(interval) {
      this.loading = true
      interval = this.prepareDates(interval)
      getRequest('dashboard/users', { params: { interval }}).then((res) => {
        this.chartData = res.data || []
      }).finally(() => {
        this.loading = false
      })
    },
    prepareDates(interval) {
      interval = interval.split('-')
      const startYear = '-01-01'
      return [interval[0] + startYear, interval[1] + startYear]
    }
  }
}
</script>

<style scoped>

</style>
