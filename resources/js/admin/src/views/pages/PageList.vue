<template>
  <md-table md-card>
    <md-table-toolbar>
      <h1 class="md-title">
        Страницы
      </h1>
    </md-table-toolbar>
    <md-table-row>
      <md-table-head md-numeric>
        ID
      </md-table-head>
      <md-table-head>Автор</md-table-head>
      <md-table-head>Название</md-table-head>
      <md-table-head>Добавлено</md-table-head>
      <md-table-head>Обновлено</md-table-head>
      <md-table-head>Опубликовано</md-table-head>
      <md-table-head />
    </md-table-row>
    <md-table-row v-for="page in pages.data" :key="page.id">
      <md-table-cell md-numeric>
        {{ page.id }}
      </md-table-cell>
      <md-table-cell>{{ page.user.login }}</md-table-cell>
      <md-table-cell>
        <router-link :to="{ name: 'pages.edit', params: { id: page.id } }">
          {{ page.title }}
        </router-link>
      </md-table-cell>
      <md-table-cell>{{ page.created_at }}</md-table-cell>
      <md-table-cell>{{ page.updated_at }}</md-table-cell>
      <md-table-cell>{{ page.is_public ? 'Да' : 'Нет' }}</md-table-cell>
      <md-table-cell class="align-content-start">
        <md-button class="md-icon-button md-dense md-raised md-accent">
          <md-icon>delete_forever</md-icon>
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
  name: 'PageList',
  data() {
    return {
      pages: []
    }
  },
  created() {
    this.getPages()
  },
  methods: {
    getPages() {
      index('pages').then((res) => {
        this.pages = res.data.pages || []
      })
    }
  }
}
</script>

<style scoped>

</style>
