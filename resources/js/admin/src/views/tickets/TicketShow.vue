<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        <v-list>
          <v-list-item>
            <v-list-item-avatar>
              <img :src="'/storage/' + ticket.user.avatar" :alt="ticket.user.login">
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>{{ ticket.user.login }}</v-list-item-title>
              <v-list-item-subtitle>{{ ticket.created_at }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>
        <v-spacer />
        <v-menu v-if="ticket.status !== 'closed'" offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-btn icon v-bind="attrs" v-on="on">
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-item @click="closeTicket">
              <v-list-item-title>Закрыть тикет</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-card-title>
      <v-divider />
      <v-card-text>
        <p>
          <b>{{ ticket.title }}</b>
        </p>
        <div>{{ ticket.question }}</div>
        <div class="flex space-between mt">
          <div class="text--disabled">
            {{ ticket.messages_count }} сообщений
          </div>
          <div class="text--disabled">
            Статус: {{ ticket.status | ticketStatuses }}
          </div>
        </div>
      </v-card-text>
      <v-divider />
      <v-card-text v-if="ticket.status !== 'closed'">
        <div>
          <form @submit.prevent="saveMessage">
            <div class="flex">
              <v-avatar>
                <img :src="'/storage/' + user.avatar" :alt="user.login">
              </v-avatar>
              <v-text-field v-model="message" class="ml" placeholder="Напишите сообщение и нажмите Enter чтобы отправить" />
            </div>
          </form>
        </div>
      </v-card-text>
      <v-divider />
      <v-card-text v-for="(item, key) in messages" :key="key">
        <v-container>
          <v-row class="mb-4" align="center">
            <v-avatar>
              <v-img :src="'/storage/' + item.user_from.avatar" :alt="item.user_from.login" />
            </v-avatar>
            <span class="subtitle-1 ml">{{ item.user_from.login }}</span>
            <v-spacer />
            <span class="text-caption text--disabled">{{ item.created_at }}</span>
          </v-row>
          <div>{{ item.message }}</div>
        </v-container>
        <v-divider />
      </v-card-text>
    </v-card>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
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
      loading: false,
      ticket: {
        user: {}
      },
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
      this.loading = true
      show('tickets', this.$route.params.id).then((res) => {
        this.ticket = res.data.ticket || {}
        this.messages = res.data.messages || []
      }).finally(() => {
        this.loading = false
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
