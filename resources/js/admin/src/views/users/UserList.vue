<template>
  <md-table md-card>
    <md-table-toolbar>
      <h1 class="md-title">
        Пользователи
      </h1>
    </md-table-toolbar>
    <md-table-row>
      <md-table-head md-numeric>
        ID
      </md-table-head>
      <md-table-head>Логин</md-table-head>
      <md-table-head>E-mail</md-table-head>
      <md-table-head>Роль</md-table-head>
      <md-table-head>IP-адрес</md-table-head>
      <md-table-head>Регистрация</md-table-head>
      <md-table-head />
    </md-table-row>
    <md-table-row v-for="user in users.data" :key="user.id">
      <md-table-cell md-numeric>
        {{ user.id }}
      </md-table-cell>
      <md-table-cell>{{ user.login }}</md-table-cell>
      <md-table-cell>{{ user.email }}</md-table-cell>
      <md-table-cell>{{ user.role.role_value }}</md-table-cell>
      <md-table-cell>{{ user.ip }}</md-table-cell>
      <md-table-cell>{{ user.created_at }}</md-table-cell>
      <md-table-cell class="align-content-start">
        <md-button class="md-icon-button md-dense md-raised md-accent">
          <md-icon>remove_circle_outline</md-icon>
        </md-button>
        <md-tooltip md-direction="top">
          Забанить
        </md-tooltip>
      </md-table-cell>
    </md-table-row>
  </md-table>
</template>

<script>
import { index } from '../../api/api'
export default {
  name: 'UserList',
  data() {
    return {
      users: []
    }
  },
  created() {
    this.getUsers()
  },
  methods: {
    getUsers() {
      index('users').then((res) => {
        this.users = res.data.users || []
      })
    }
  }
}
</script>

<style scoped>

</style>
