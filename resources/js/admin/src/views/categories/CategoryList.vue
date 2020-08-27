<template>
  <md-table md-card>
    <md-table-toolbar>
      <h1 class="md-title">
        Разделы
      </h1>
    </md-table-toolbar>
    <md-table-row>
      <md-table-head md-numeric>
        ID
      </md-table-head>
      <md-table-head>Название</md-table-head>
      <md-table-head>Описание</md-table-head>
      <md-table-head>Добавлено</md-table-head>
      <md-table-head>Обновлено</md-table-head>
      <md-table-head />
    </md-table-row>
    <md-table-row v-for="category in categories.data" :key="category.id">
      <md-table-cell md-numeric>
        {{ category.id }}
      </md-table-cell>
      <md-table-cell>
        <router-link :to="{ name: 'categories.edit', params: { id: category.id } }">
          {{ category.title }}
        </router-link>
      </md-table-cell>
      <md-table-cell>{{ category.description || 'Не указано' }}</md-table-cell>
      <md-table-cell>{{ category.created_at }}</md-table-cell>
      <md-table-cell>{{ category.updated_at }}</md-table-cell>
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
  name: 'CategoryList',
  data() {
    return {
      categories: []
    }
  },
  created() {
    this.getCategories()
  },
  methods: {
    getCategories() {
      index('categories').then((res) => {
        this.categories = res.data.categories || []
      })
    }
  }
}
</script>

<style scoped>

</style>
