<template>
  <md-card class="md-primary" md-theme="green-card">
    <md-card-header>
      <md-card-header-text>
        <div class="md-title">
          <count-to :start-val="0" :end-val="count" :duration="1500" />
        </div>
      </md-card-header-text>
      <md-card-media>
        <div>Кол-во {{ model }}</div>
      </md-card-media>
    </md-card-header>
  </md-card>
</template>

<script>
import countTo from 'vue-count-to'
export default {
  name: 'DashboardCard',
  components: { countTo },
  props: {
    count: {
      type: Number,
      required: true
    },
    model: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>
  .md-card {
    width: 350px;
  }
</style>
