<template>
  <md-card>
    <md-card-header>
      <div class="md-title">
        Добавить страницу
      </div>
    </md-card-header>
    <md-card-content>
      <form @submit.prevent="save">
        <md-field>
          <label>Название</label>
          <md-input v-model="form.title" />
        </md-field>
        <md-field>
          <label>ЧПУ-псевдоним</label>
          <md-input v-model="form.slug" />
        </md-field>
        <md-field>
          <md-datepicker v-model="form.created_at">
            <label>Выберите дату</label>
          </md-datepicker>
        </md-field>
        <ckeditor v-model="form.content" :config="ckeditor" />
        <md-field>
          <label>Мета-описание</label>
          <md-input v-model="form.md" />
        </md-field>
        <md-field>
          <label>Ключевые слова</label>
          <md-input v-model="form.mk" />
        </md-field>
        <md-checkbox v-model="form.is_public" :true-value="1" :false-value="0" class="md-primary">
          Опубликовать страницу
        </md-checkbox>
        <div>
          <md-button type="submit" class="md-raised md-primary">
            Сохранить
          </md-button>
        </div>
      </form>
    </md-card-content>
  </md-card>
</template>

<script>
import { store } from '../../api/api'
import CKEditor from 'ckeditor4-vue'
import ckeditor from '../../api/ckeditor'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'PageCreate',
  components: {
    ckeditor: CKEditor.component
  },
  mixins: [showErrors],
  data() {
    return {
      form: {
        title: null,
        slug: null,
        content: null,
        md: null,
        mk: null,
        created_at: null,
        is_public: 0
      },
      ckeditor
    }
  },
  methods: {
    save() {
      store('pages', this.form).then((res) => {
        this.$toast.success(res.data.success)
        this.$router.push({ name: 'pages' })
      }).catch((err) => {
        this.showErrors(err)
      })
    }
  }
}
</script>

<style scoped>
button {
    margin: 10px 0 0;
}
</style>
