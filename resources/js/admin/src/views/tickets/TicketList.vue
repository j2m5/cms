<template>
  <md-table md-card>
    <md-table-toolbar>
      <h1 class="md-title">
        Вопросы
      </h1>
    </md-table-toolbar>
    <md-table-row>
      <md-table-head md-numeric>
        ID
      </md-table-head>
      <md-table-head>Категория</md-table-head>
      <md-table-head>Тема</md-table-head>
      <md-table-head>Вопрос</md-table-head>
      <md-table-head>Приоритет</md-table-head>
      <md-table-head>Статус</md-table-head>
      <md-table-head>Добавлено</md-table-head>
    </md-table-row>
    <md-table-row v-for="ticket in tickets.data" :key="ticket.id">
      <md-table-cell md-numeric>
        {{ ticket.id }}
      </md-table-cell>
      <md-table-cell>{{ ticket.category.title }}</md-table-cell>
      <md-table-cell>{{ ticket.title }}</md-table-cell>
      <md-table-cell>
        <router-link :to="{ name: 'tickets.show', params: { id: ticket.id } }">
          {{ ticket.question }}
        </router-link>
      </md-table-cell>
      <md-table-cell>{{ ticket.priority | ticketPriorities }}</md-table-cell>
      <md-table-cell>{{ ticket.status | ticketStatuses }}</md-table-cell>
      <md-table-cell>{{ ticket.created_at }}</md-table-cell>
    </md-table-row>
  </md-table>
</template>

<script>
import { index } from '../../api/api'
import { truncStr } from '../../filters'
import { ticketPriorities, ticketStatuses } from './filters'
export default {
  name: 'TicketList',
  filters: {
    truncStr,
    ticketPriorities,
    ticketStatuses
  },
  data() {
    return {
      tickets: []
    }
  },
  created() {
    this.getTickets()
  },
  methods: {
    getTickets() {
      index('tickets').then((res) => {
        this.tickets = res.data.tickets || []
      })
    }
  }
}
</script>

<style scoped>

</style>
