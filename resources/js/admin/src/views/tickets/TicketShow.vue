<template>
  <div>1</div>
</template>

<script>
import { show, patchRequest, postRequest } from '../../api/api'
import { ticketStatuses, ticketMessageIsRead } from './filters'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'TicketShow',
  filters: {
    ticketStatuses,
    ticketMessageIsRead
  },
  mixins: [showErrors],
  data() {
    return {
      ticket: {},
      messages: [],
      message: null
    }
  },
  computed: {
    user() {
      return this.$store.getters.user
    }
  },
  created() {
    this.getTicket()
    this.$store.dispatch('getUser')
  },
  methods: {
    getTicket() {
      show('tickets', this.$route.params.id).then((res) => {
        this.ticket = res.data.ticket || {}
        this.messages = res.data.messages || []
      })
    },
    closeTicket() {
      patchRequest('tickets/' + this.$route.params.id + '/close', {}).then((res) => {
        this.$toast.success(res.data.success)
        this.getTicket()
      })
    },
    saveMessage() {
      const form = new FormData()
      form.append('ticket_id', this.ticket.id)
      form.append('from', this.user.id)
      form.append('to', this.ticket.user_id)
      form.append('message', this.message)
      postRequest('tickets/message/store', form).then((res) => {
        this.$toast.success(res.data.success)
        this.getTicket()
        this.message = ''
      }).catch((err) => {
        this.showErrors(err)
      })
    }
  }
}
</script>

<style scoped>
.mt {
    margin-top: 15px;
}
.mb {
    margin-bottom: 15px;
}
.ml {
    margin-left: 15px;
}
.w100 {
    width: 100%;
}
.flex {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.space-between {
    justify-content: space-between !important;
}
.padding {
    padding: 4px 16px;
}
.avatar > img {
    border-radius: 50%;
    height: 40px;
    width: 40px;
}
</style>
