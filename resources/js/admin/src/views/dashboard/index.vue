<template>
  <div class="md-layout md-alignment-left">
    <div>
      <dashboard-card :count="countCategories" model="разделов" />
    </div>
    <div>
      <dashboard-card :count="countPosts" model="записей" />
    </div>
    <div>
      <dashboard-card :count="countTags" model="тегов" />
    </div>
    <div>
      <dashboard-card :count="countUsers" model="пользователей" />
    </div>
    <div>
      <dashboard-card :count="countComments" model="комментариев" />
    </div>
  </div>
</template>

<script>
import { index } from '../../api/api'
const DashboardCard = () => import('./components/DashboardCard')
export default {
  name: 'Dashboard',
  components: { DashboardCard },
  data() {
    return {
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
      index('dashboard').then((res) => {
        this.countCategories = res.data.categories
        this.countPosts = res.data.posts
        this.countTags = res.data.tags
        this.countUsers = res.data.users
        this.countComments = res.data.comments
      })
    }
  }
}
</script>

<style scoped>

</style>
