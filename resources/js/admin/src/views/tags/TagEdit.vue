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
import { edit, update } from '../../api/api'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'TagEdit',
  mixins: [showErrors],
  data() {
    return {
      loading: false,
      form: {
        name: null,
        slug: null
      }
    }
  },
  created() {
    this.getTag()
  },
  methods: {
    getTag() {
      this.loading = true
      edit('tags', this.$route.params.id).then((res) => {
        this.form = res.data.tag
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      update('tags', this.$route.params.id, this.form).then((res) => {
        this.$toast.success(res.data.success)
      }).catch((err) => {
        this.showErrors(err)
      })
    }
  }
}
</script>

<style scoped>

</style>
