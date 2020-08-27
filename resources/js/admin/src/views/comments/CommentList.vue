<template>
  <md-table md-card>
    <md-table-toolbar>
      <h1 class="md-title">
        Комментарии
      </h1>
    </md-table-toolbar>
    <md-table-row>
      <md-table-head md-numeric>
        ID
      </md-table-head>
      <md-table-head>К записи</md-table-head>
      <md-table-head>Автор</md-table-head>
      <md-table-head>Текст</md-table-head>
      <md-table-head>Отправлен</md-table-head>
      <md-table-head>Обновлен</md-table-head>
      <md-table-head />
    </md-table-row>
    <md-table-row v-for="comment in comments.data" :key="comment.id">
      <md-table-cell md-numeric>
        {{ comment.id }}
      </md-table-cell>
      <md-table-cell>{{ comment.post.title }}</md-table-cell>
      <md-table-cell>{{ comment.user.login || comment.author }}</md-table-cell>
      <md-table-cell>{{ comment.content }}</md-table-cell>
      <md-table-cell>{{ comment.created_at }}</md-table-cell>
      <md-table-cell>{{ comment.updated_at }}</md-table-cell>
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
  name: 'CommentList',
  data() {
    return {
      comments: []
    }
  },
  created() {
    this.getComments()
  },
  methods: {
    getComments() {
      index('comments').then((res) => {
        this.comments = res.data.comments || []
      })
    }
  }
}
</script>

<style scoped>

</style>
