<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Редактировать пользователя
      </v-card-title>
      <v-card-text>
        <form @submit.prevent="save">
          <v-text-field v-model="form.login" label="Логин пользователя" />
          <v-text-field v-model="form.name" label="Имя пользователя" />
          <v-text-field v-model="form.email" label="E-mail" />
          <v-text-field v-model="password" label="Пароль" />
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
          <v-btn v-if="authUser.id !== form.id" color="error" rounded @click="del">
            Удалить пользователя
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
import { edit, update, destroy } from '../../api/api'
import { randomStr } from './helpers'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'UserEdit',
  mixins: [showErrors],
  data() {
    return {
      loading: false,
      roles: [],
      password: null,
      form: {
        id: 0,
        login: null,
        name: null,
        email: null,
        password: null,
        role_id: null
      }
    }
  },
  computed: {
    authUser() {
      return this.$store.getters.user
    }
  },
  watch: {
    password(val) {
      this.form.password = val
    }
  },
  created() {
    this.$store.dispatch('getUser')
    this.getData()
  },
  methods: {
    getData() {
      this.loading = true
      edit('users', this.$route.params.id).then((res) => {
        this.form = res.data.user
        this.roles = res.data.roles
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      update('users', this.$route.params.id, this.form).then((res) => {
        this.$toast.success(res.data.success)
        this.$store.dispatch('updateUser', this.form)
        this.getData()
      }).catch((err) => {
        this.showErrors(err)
      })
    },
    del() {
      this.$confirm('Вы уверены что хотите удалить пользователя?').then((e) => {
        if (e) {
          destroy('users', this.$route.params.id).then((res) => {
            this.$toast.success(res.data.success)
            this.$router.push({ name: 'users' })
          }).catch((err) => {
            this.$toast.warning(err.response.data.errors)
          })
        }
      })
    },
    generatePassword() {
      this.password = randomStr(16)
    }
  }
}
</script>

<style scoped>

</style>
