<template>
  <div>
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
      <md-table-row v-for="item in categories.data" :key="item.id">
        <md-table-cell md-numeric>
          {{ item.id }}
        </md-table-cell>
        <md-table-cell>{{ item.title }}</md-table-cell>
        <md-table-cell>{{ item.description || 'Не указано' }}</md-table-cell>
        <md-table-cell>{{ item.created_at }}</md-table-cell>
        <md-table-cell>{{ item.updated_at }}</md-table-cell>
        <md-table-cell class="align-content-start">
          <md-button class="md-accent">
            В корзину
          </md-button>
        </md-table-cell>
      </md-table-row>
    </md-table>
  </div>
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
    this.get()
  },
  methods: {
    get() {
      index('categories').then((res) => {
        this.categories = res.data.categories || []
      })
    }
  }
}
</script>

<style scoped>

</style>
