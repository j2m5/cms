<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Редактировать страницу
      </v-card-title>
      <v-card-text>
        <form @submit.prevent="save">
          <v-text-field v-model="form.title" label="Название" />
          <v-text-field v-model="form.slug" label="ЧПУ-псевдоним" />
          <v-datetime-picker
            v-model="form.created_at"
            label="Выберите время"
            time-format="HH:mm:ss"
            clear-text="Очистить"
            ok-text="Выбрать"
            :dialog-width="500"
            :date-picker-props="dateTimeConfig.dateOptions"
            :time-picker-props="dateTimeConfig.timeOptions"
          >
            <v-icon slot="dateIcon">
              mdi-calendar
            </v-icon>
            <v-icon slot="timeIcon">
              mdi-clock-time-four-outline
            </v-icon>
          </v-datetime-picker>
          <label>Содержимое страницы</label>
          <editor
            v-model="form.content"
            :init="tinymce"
            api-key="3nqh2ffz2qeynj2rg4jnbqk1cvf14ppmrkrqjfxuq5xhq115"
            class="mb-5"
          />
          <v-text-field v-model="form.md" label="Мета-описание" />
          <v-text-field v-model="form.mk" label="Ключевые слова" />
          <div>
            <v-checkbox v-model="form.is_public" label="Опубликовать страницу" class="d-inline-block" hide-details />
          </div>
          <v-btn type="submit" color="primary" class="mt-3" rounded>
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
import Editor from '@tinymce/tinymce-vue'
import tinymce from '../../api/tinymce'
import showErrors from '../../mixins/showErrors'
import dateTimeConfig from '../../api/datetimepicker'
export default {
  name: 'PageEdit',
  components: {
    'editor': Editor
  },
  mixins: [showErrors],
  data() {
    return {
      loading: false,
      form: {
        title: null,
        slug: null,
        content: null,
        md: null,
        mk: null,
        created_at: null,
        is_public: 0
      },
      tinymce,
      dateTimeConfig
    }
  },
  created() {
    this.getPage()
  },
  methods: {
    getPage() {
      this.loading = true
      edit('pages', this.$route.params.id).then((res) => {
        this.form = res.data.page
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      update('pages', this.$route.params.id, this.form).then((res) => {
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
