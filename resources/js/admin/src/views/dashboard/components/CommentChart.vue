<template>
  <v-card>
    <v-card-title>
      <div>Новые комментарии за выбранный интервал</div>
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
import getInterval from '../../../mixins/getInterval'
import VeLine from 'v-charts/lib/line.common'
export default {
  name: 'CommentChart',
  components: { VeLine },
  mixins: [getYears, getInterval],
  data() {
    return {
      loading: false,
      chartData: null,
      chartSettings: {
        stack: { 'sell': ['Всего'] },
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
      interval = this.getInterval(interval)
      getRequest('dashboard/comments', { params: { interval }}).then((res) => {
        this.chartData = res.data || []
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>

<style scoped>

</style>
