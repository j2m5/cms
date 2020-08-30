<template>
  <md-card class="padding">
    <md-card-header class="flex space-between">
      <div class="flex">
        <div class="avatar">
          <img :src="'/storage/' + user.avatar" :alt="user.login">
        </div>
        <div class="ml">
          <div class="md-body-1">
            {{ user.login }}
          </div>
          <div class="md-caption">
            {{ ticket.created_at }}
          </div>
        </div>
      </div>
      <md-menu v-if="ticket.status !== 'closed'" md-size="big" md-direction="bottom-end">
        <md-button class="md-icon-button" md-menu-trigger>
          <md-icon>more_vert</md-icon>
        </md-button>
        <md-menu-content>
          <md-menu-item @click="closeTicket">
            <span>Закрыть</span>
            <md-icon>remove_circle_outline</md-icon>
          </md-menu-item>
        </md-menu-content>
      </md-menu>
    </md-card-header>
    <md-divider />
    <md-card-content>
      <div>{{ ticket.question }}</div>
      <div class="flex space-between mt">
        <div class="md-caption">
          {{ ticket.messages_count }} сообщений
        </div>
        <div class="md-caption">
          Статус: {{ ticket.status | ticketStatuses }}
        </div>
      </div>
    </md-card-content>
    <md-divider />
    <md-card-actions md-alignment="left">
      <div class="w100">
        <form v-if="ticket.status !== 'closed'" @submit.prevent="saveMessage">
          <md-field>
            <md-input v-model="message" placeholder="Напишите сообщение и нажмите Enter чтобы отправить" />
          </md-field>
        </form>
        <div v-for="item in messages" :key="item.id">
          <div class="flex">
            <div class="avatar mt">
              <img :src="'/storage/' + item.user_from.avatar" :alt="item.user_from.login">
            </div>
            <div style="margin-left: 15px;">
              <span>{{ item.user_from.login }}</span>
              <span class="md-caption">[{{ item.read | ticketMessageIsRead }}]</span>
            </div>
          </div>
          <div>
            <div class="mb">
              {{ item.message }}
            </div>
            <div class="md-caption mb">
              {{ item.created_at }}
            </div>
          </div>
          <md-divider />
        </div>
      </div>
    </md-card-actions>
  </md-card>
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
