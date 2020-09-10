<template>
  <div>1</div>
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
