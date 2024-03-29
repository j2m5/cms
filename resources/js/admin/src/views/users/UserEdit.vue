<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Редактировать пользователя
      </v-card-title>
      <v-card-text>
        <div style="margin-bottom: 10px;">
          <v-avatar size="100" tile>
            <img :src="$store.getters.siteUrl + '/storage/' + form.avatar" :alt="form.login">
          </v-avatar>
          <v-file-input
            v-model="avatar"
            accept="image/*"
            label="Загрузить аватар"
            @change="uploadAvatar"
          />
        </div>
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
          <v-btn color="primary" rounded @click="resetAvatar">
            Установить аватар по умолчанию
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
import { edit, update, destroy, postRequest, patchRequest } from '../../api/api'
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
      avatar: null,
      form: {
        id: 0,
        avatar: null,
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
        if (this.$store.getters.user.id === this.form.id) {
          this.$store.commit('updateUserLogin', this.form.login)
        }
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
    },
    uploadAvatar() {
      if (this.avatar) {
        const form = new FormData()
        form.append('avatar', this.avatar)
        postRequest('users/' + this.form.id + '/upload', form, {
          headers: { 'Content-Type': 'multipart/form-data' }
        }).then((res) => {
          this.$toast.success(res.data.success)
          if (this.$store.getters.user.id === this.form.id) {
            this.$store.commit('updateUserAvatar', res.data.newAvatar)
          }
          this.avatar = null
          this.getData()
        }).catch((err) => {
          this.showErrors(err)
          this.avatar = null
        })
      }
    },
    resetAvatar() {
      patchRequest('users/' + this.form.id + '/reset').then((res) => {
        this.$toast.success(res.data.success)
        if (this.$store.getters.user.id === this.form.id) {
          this.$store.commit('updateUserAvatar', res.data.newAvatar)
        }
        this.getData()
      })
    }
  }
}
</script>

<style scoped>

</style>
