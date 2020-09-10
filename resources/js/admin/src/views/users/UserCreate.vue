<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Добавить пользователя
      </v-card-title>
      <v-card-text>
        <form @submit.prevent="save">
          <v-text-field v-model="form.login" label="Логин пользователя" />
          <v-text-field v-model="form.name" label="Имя пользователя" />
          <v-text-field v-model="form.email" label="E-mail" />
          <v-text-field v-model="form.password" label="Пароль" />
          <v-select
            v-model="form.role_id"
            :items="roles"
            item-text="role_value"
            item-value="id"
            label="Выберите роль"
          />
          <v-btn type="submit" color="primary" rounded>
            Сохранить
          </v-btn>
          <v-btn color="primary" rounded @click="generatePassword">
            Сгенерировать пароль
          </v-btn>
        </form>
      </v-card-text>
    </v-card>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
</template>

<script>
import { create, store } from '../../api/api'
import { randomStr } from './helpers'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'UserCreate',
  mixins: [showErrors],
  data() {
    return {
      loading: false,
      roles: [],
      form: {
        login: null,
        name: null,
        email: null,
        password: null,
        role_id: null
      }
    }
  },
  created() {
    this.getData()
  },
  methods: {
    getData() {
      this.loading = true
      create('users').then((res) => {
        this.roles = res.data.roles
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      store('users', this.form).then((res) => {
        this.$toast.success(res.data.success)
        this.$router.push({ name: 'users' })
      }).catch((err) => {
        this.showErrors(err)
      })
    },
    generatePassword() {
      this.form.password = randomStr(16)
    }
  }
}
</script>

<style scoped>

</style>
