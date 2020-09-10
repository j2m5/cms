<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Редактировать раздел
      </v-card-title>
      <v-card-text>
        <form>
          <v-text-field v-model="form.title" label="Название" />
          <v-text-field v-model="form.slug" label="ЧПУ-псевдоним" />
          <v-select v-model="form.parent_id" :items="categories" item-text="title" item-value="id" label="Выберите раздел" />
          <v-textarea v-model="form.description" label="Описание" hint="Введите описание" />
          <v-text-field v-model="form.md" label="Мета-описание" />
          <v-text-field v-model="form.mk" label="Ключевые слова" />
          <v-btn color="primary" rounded @click="save">
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
  name: 'CategoryEdit',
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
    this.getCategory()
  },
  methods: {
    getCategory() {
      this.loading = true
      edit('categories', this.$route.params.id).then((res) => {
        this.categories = res.data.categories
        this.form = res.data.category
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      update('categories', this.$route.params.id, this.form).then((res) => {
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
