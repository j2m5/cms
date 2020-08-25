<template>
  <md-card>
    <md-card-header>
      <div class="md-title">
        Добавить тег
      </div>
    </md-card-header>
    <md-card-content>
      <form class="md-layout" @submit.prevent="save">
        <md-field>
          <label>Название</label>
          <md-input v-model="form.name" />
        </md-field>
        <md-field>
          <label>ЧПУ-псевдоним</label>
          <md-input v-model="form.slug" />
        </md-field>
        <md-button type="submit" class="md-raised md-primary">
          Сохранить
        </md-button>
        <md-snackbar md-position="center" :md-duration="3000" :md-active.sync="showErrors" md-persistent>
          <span v-for="(error, key) in errors" :key="key">{{ error }}</span>
        </md-snackbar>
      </form>
    </md-card-content>
  </md-card>
</template>

<script>
import { store } from '../../api/api'
export default {
  name: 'TagCreate',
  data() {
    return {
      showErrors: false,
      errors: {},
      form: {
        name: null,
        slug: null
      }
    }
  },
  methods: {
    save() {
      store('tags', this.form).then(() => {
        this.$router.push({ name: 'tags' })
      }).catch((err) => {
        this.showErrors = true
        this.errors = err.response.data.errors || {}
      })
    }
  }
}
</script>

<style scoped>

</style>
