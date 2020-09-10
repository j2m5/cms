<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Добавить тег
      </v-card-title>
      <v-card-text>
        <form @submit.prevent="save">
          <v-text-field v-model="form.name" label="Название" />
          <v-text-field v-model="form.slug" label="ЧПУ-псевдоним" />
          <v-btn type="submit" color="primary" rounded>
            Сохранить
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
import { store } from '../../api/api'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'TagCreate',
  mixins: [showErrors],
  data() {
    return {
      loading: true,
      form: {
        name: null,
        slug: null
      }
    }
  },
  created() {
    setTimeout(() => {
      this.loading = false
    }, 300)
  },
  methods: {
    save() {
      store('tags', this.form).then((res) => {
        this.$toast.success(res.data.success)
        this.$router.push({ name: 'tags' })
      }).catch((err) => {
        this.showErrors(err)
      })
    }
  }
}
</script>

<style scoped>

</style>
