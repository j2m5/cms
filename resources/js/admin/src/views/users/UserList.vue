<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Пользователи
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
                  Логин
                </th>
                <th class="text-left">
                  Email-адрес
                </th>
                <th class="text-left">
                  IP-адрес
                </th>
                <th class="text-left">
                  Роль
                </th>
                <th class="text-left">
                  Зарегистрирован
                </th>
                <th class="text-left" />
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, key) in users.data" :key="key">
                <td>{{ user.id }}</td>
                <td>
                  <router-link :to="{ name: 'users.edit', params: { id: user.id } }">
                    {{ user.login }}
                  </router-link>
                </td>
                <td>{{ user.email }}</td>
                <td>{{ user.ip }}</td>
                <td>{{ user.role.role_value }}</td>
                <td>{{ user.created_at }}</td>
                <td>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn v-if="!user.banned" color="error" fab x-small v-bind="attrs" v-on="on" @click="ban(user.id, 'забанить')">
                        <v-icon>mdi-cancel</v-icon>
                      </v-btn>
                      <v-btn v-else color="success" fab x-small v-bind="attrs" v-on="on" @click="ban(user.id, 'разбанить')">
                        <v-icon>mdi-check-circle-outline</v-icon>
                      </v-btn>
                    </template>
                    <span v-if="!user.banned">Забанить</span>
                    <span v-else>Разбанить</span>
                  </v-tooltip>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
      <v-divider />
      <v-card-actions v-if="users.total && users.total > users.per_page">
        <div class="text-center w-100">
          <v-pagination
            v-model="query.page"
            :length="users.last_page"
            :total-visible="11"
            circle
            @input="getUsers"
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
import { index, patchRequest } from '../../api/api'
import { truncStr } from '../../filters'
export default {
  name: 'UserList',
  filters: { truncStr },
  data() {
    return {
      loading: false,
      query: {
        page: 1
      },
      users: []
    }
  },
  created() {
    this.getUsers()
  },
  methods: {
    getUsers() {
      this.loading = true
      index('users', { params: { page: this.query.page }}).then((res) => {
        this.users = res.data.users || []
      }).finally(() => {
        this.loading = false
      })
    },
    ban(id, action) {
      this.$confirm('Вы уверены что хотите ' + action + ' пользователя?').then((e) => {
        if (e) {
          patchRequest('users/' + id + '/ban').then((res) => {
            this.$toast.success(res.data.success)
            this.getUsers()
          }).catch((err) => {
            this.$toast.warning(err.response.data.errors)
          })
        }
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
