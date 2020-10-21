<template>
  <v-container>
    <v-row>
      <v-col md="4">
        <dashboard-card :count="countCategories" model="разделов" />
      </v-col>
      <v-col md="4">
        <dashboard-card :count="countPosts" model="записей" />
      </v-col>
      <v-col md="4">
        <dashboard-card :count="countTags" model="тегов" />
      </v-col>
    </v-row>
    <v-row>
      <v-col md="4">
        <dashboard-card :count="countUsers" model="пользователей" />
      </v-col>
      <v-col md="4">
        <dashboard-card :count="countComments" model="комментариев" />
      </v-col>
    </v-row>
    <v-row>
      <v-col md="12">
        <user-chart />
      </v-col>
    </v-row>
    <v-row>
      <v-col md="12">
        <comment-chart />
      </v-col>
    </v-row>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
</template>

<script>
import { index } from '../../api/api'
const DashboardCard = () => import('./components/DashboardCard')
const UserChart = () => import('./components/UserChart')
const CommentChart = () => import('./components/CommentChart')
export default {
  name: 'Dashboard',
  components: { DashboardCard, UserChart, CommentChart },
  data() {
    return {
      loading: false,
      countCategories: 0,
      countPosts: 0,
      countTags: 0,
      countUsers: 0,
      countComments: 0
    }
  },
  created() {
    this.getCounters()
  },
  methods: {
    getCounters() {
      this.loading = true
      index('dashboard').then((res) => {
        this.countCategories = res.data.categories
        this.countPosts = res.data.posts
        this.countTags = res.data.tags
        this.countUsers = res.data.users
        this.countComments = res.data.comments
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>

<style scoped>

</style>
