<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Вопросы
      </v-card-title>
      <v-card-text>
        <v-simple-table fixed-header>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">
                  ID
                </th>
                <th class="text-left">
                  Категория
                </th>
                <th class="text-left">
                  Тема
                </th>
                <th class="text-left">
                  Вопрос
                </th>
                <th class="text-left">
                  Приоритет
                </th>
                <th class="text-left">
                  Статус
                </th>
                <th class="text-left">
                  Добавлено
                </th>
                <th class="text-left">
                  Обновлено
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(ticket, key) in tickets.data" :key="key">
                <td>{{ ticket.id }}</td>
                <td>{{ ticket.category.title }}</td>
                <td>{{ ticket.title }}</td>
                <td>
                  <router-link :to="{ name: 'tickets.show', params: { id: ticket.id } }">
                    {{ ticket.question | truncStr }}
                  </router-link>
                </td>
                <td>{{ ticket.priority | ticketPriorities }}</td>
                <td>{{ ticket.status | ticketStatuses }}</td>
                <td>{{ ticket.created_at }}</td>
                <td>{{ ticket.updated_at }}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
      <v-divider />
      <v-card-actions v-if="tickets.total && tickets.total > tickets.per_page">
        <div class="text-center w-100">
          <v-pagination
            v-model="query.page"
            :length="tickets.last_page"
            :total-visible="11"
            circle
            @input="getTickets"
          />
        </div>
      </v-card-actions>
    </v-card>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
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
      loading: false,
      query: {
        page: 1
      },
      tickets: []
    }
  },
  created() {
    this.getTickets()
  },
  methods: {
    getTickets() {
      this.loading = true
      index('tickets', { params: { page: this.query.page }}).then((res) => {
        this.tickets = res.data.tickets || []
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>

<style scoped>
.w-100 {
    width: 100%;
}
</style>
