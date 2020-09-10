<template>
  <v-card>
    <v-card-title class="headline">
      <count-to :start-val="0" :end-val="count" :duration="1500" />
    </v-card-title>
    <v-card-subtitle>{{ model }}</v-card-subtitle>
  </v-card>
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

</style>
