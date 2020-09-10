<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Добавить раздел
      </v-card-title>
      <v-card-text>
        <form @submit.prevent="save">
          <v-text-field v-model="form.title" label="Название" />
          <v-text-field v-model="form.slug" label="ЧПУ-псевдоним" />
          <v-select v-model="form.parent_id" :items="categories" item-text="title" item-value="id" label="Выберите раздел" />
          <v-textarea v-model="form.description" label="Описание" hint="Введите описание" />
          <v-text-field v-model="form.md" label="Мета-описание" />
          <v-text-field v-model="form.mk" label="Ключевые слова" />
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
import { create, store } from '../../api/api'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'CategoryCreate',
  mixins: [showErrors],
  data() {
    return {
      loading: false,
      categories: [],
      form: {
        title: null,
        slug: null,
        parent_id: 0,
        description: null,
        md: null,
        mk: null
      }
    }
  },
  created() {
    this.getCategories()
  },
  methods: {
    getCategories() {
      this.loading = true
      create('categories').then((res) => {
        this.categories = res.data.categories || []
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      store('categories', this.form).then(() => {
        this.$router.push({ name: 'categories' })
      }).catch((err) => {
        this.showErrors(err)
      })
    }
  }
}
</script>

<style scoped>

</style>
