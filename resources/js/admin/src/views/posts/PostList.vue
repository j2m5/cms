<template>
  <md-table md-card>
    <md-table-toolbar>
      <h1 class="md-title">
        Записи
      </h1>
    </md-table-toolbar>
    <md-table-row>
      <md-table-head md-numeric>
        ID
      </md-table-head>
      <md-table-head>Раздел</md-table-head>
      <md-table-head>Автор</md-table-head>
      <md-table-head>Название</md-table-head>
      <md-table-head>Опубликовано</md-table-head>
      <md-table-head>Добавлено</md-table-head>
      <md-table-head>Обновлено</md-table-head>
      <md-table-head />
    </md-table-row>
    <md-table-row v-for="post in posts.data" :key="post.id">
      <md-table-cell md-numeric>
        {{ post.id }}
      </md-table-cell>
      <md-table-cell>{{ post.category.title }}</md-table-cell>
      <md-table-cell>{{ post.user.login }}</md-table-cell>
      <md-table-cell>{{ post.title }}</md-table-cell>
      <md-table-cell>{{ post.is_public ? 'Да' : 'Нет' }}</md-table-cell>
      <md-table-cell>{{ post.created_at }}</md-table-cell>
      <md-table-cell>{{ post.updated_at }}</md-table-cell>
      <md-table-cell class="align-content-start">
        <md-button class="md-icon-button md-dense md-raised md-accent">
          <md-icon>delete</md-icon>
        </md-button>
        <md-tooltip md-direction="top">
          В корзину
        </md-tooltip>
      </md-table-cell>
    </md-table-row>
  </md-table>
</template>

<script>
import { index } from '../../api/api'
export default {
  name: 'PostList',
  data() {
    return {
      posts: []
    }
  },
  created() {
    this.getPosts()
  },
  methods: {
    getPosts() {
      index('posts').then((res) => {
        this.posts = res.data.posts || []
      })
    }
  }
}
</script>

<style scoped>

</style>
