<template>
  <md-table md-card>
    <md-table-toolbar>
      <h1 class="md-title">
        Теги
      </h1>
    </md-table-toolbar>
    <md-table-row>
      <md-table-head md-numeric>
        ID
      </md-table-head>
      <md-table-head>Название</md-table-head>
      <md-table-head>Кол-во записей</md-table-head>
      <md-table-head>Добавлено</md-table-head>
      <md-table-head>Обновлено</md-table-head>
      <md-table-head />
    </md-table-row>
    <md-table-row v-for="tag in tags.data" :key="tag.id">
      <md-table-cell md-numeric>
        {{ tag.id }}
      </md-table-cell>
      <md-table-cell>{{ tag.name }}</md-table-cell>
      <md-table-cell>{{ tag.posts.length }}</md-table-cell>
      <md-table-cell>{{ tag.created_at }}</md-table-cell>
      <md-table-cell>{{ tag.updated_at }}</md-table-cell>
      <md-table-cell class="align-content-start">
        <md-button class="md-icon-button md-dense md-raised md-accent">
          <md-icon>delete_forever</md-icon>
        </md-button>
        <md-tooltip md-direction="top">
          Удалить навсегда
        </md-tooltip>
      </md-table-cell>
    </md-table-row>
  </md-table>
</template>

<script>
import { index } from '../../api/api'
export default {
  name: 'TagList',
  data() {
    return {
      tags: []
    }
  },
  created() {
    this.getTags()
  },
  methods: {
    getTags() {
      index('tags').then((res) => {
        this.tags = res.data.tags || []
      })
    }
  }
}
</script>

<style scoped>

</style>
