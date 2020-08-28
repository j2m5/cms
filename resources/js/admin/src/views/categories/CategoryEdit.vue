<template>
  <md-card>
    <md-card-header>
      <div class="md-title">
        Редактировать раздел
      </div>
    </md-card-header>
    <md-card-content>
      <form class="md-layout" @submit.prevent="save">
        <md-field>
          <label>Название</label>
          <md-input v-model="form.title" />
        </md-field>
        <md-field>
          <label>ЧПУ-псевдоним</label>
          <md-input v-model="form.slug" />
        </md-field>
        <md-field>
          <label>Выберите раздел</label>
          <md-select v-model="form.parent_id">
            <md-option v-for="(category, key) in categories" :key="key" :value="category.id">
              {{ category.title }}
            </md-option>
          </md-select>
        </md-field>
        <md-field>
          <label>Описание раздела</label>
          <md-textarea v-model="form.description" md-autogrow />
        </md-field>
        <md-field>
          <label>Мета-описание</label>
          <md-input v-model="form.md" />
        </md-field>
        <md-field>
          <label>Ключевые слова</label>
          <md-input v-model="form.mk" />
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
import { edit, update } from '../../api/api'
export default {
  name: 'CategoryEdit',
  data() {
    return {
      showErrors: false,
      categories: [],
      errors: {},
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
      edit('categories', this.$route.params.id).then((res) => {
        this.categories = res.data.categories
        this.form = res.data.category
      })
    },
    save() {
      update('categories', this.$route.params.id, this.form).then((res) => {
        this.$toast.success(res.data.success)
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
