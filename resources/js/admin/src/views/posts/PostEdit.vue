<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Редактировать запись
      </v-card-title>
      <v-card-text>
        <form @submit.prevent="save">
          <v-text-field v-model="form.title" label="Название" />
          <v-text-field v-model="form.slug" label="ЧПУ-псевдоним" />
          <v-select
            v-model="form.category_id"
            :items="categories"
            item-text="title"
            item-value="id"
            label="Выберите раздел"
          />
          <v-select
            v-model="form.tags"
            :items="tags"
            item-text="text"
            item-value="id"
            label="Выберите теги"
            chips
            multiple
            deletable-chips
          />
          <v-datetime-picker
            v-model="form.created_at"
            label="Выберите время"
            date-format="yyyy-MM-dd"
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
          <div class="hint mb-3">
            <v-icon>mdi-information</v-icon>
            <span>Можно установить дату и время на будущее, в таком случае запись появится на сайте в установленное время</span>
          </div>
          <label>Короткая запись</label>
          <ckeditor v-model="form.excerpt" :config="ckeditor" class="mb-5" />
          <label>Полная запись</label>
          <ckeditor v-model="form.content" :config="ckeditor" class="mb-5" />
          <v-text-field v-model="form.md" label="Мета-описание" />
          <v-text-field v-model="form.mk" label="Ключевые слова" />
          <v-file-input
            v-model="image"
            show-size
            accept="image/*"
            label="Загрузить превью"
            @change="uploadPreviewImage"
          />
          <div v-if="form.image">
            <v-img :src="$store.getters.siteUrl + '/storage/' + form.image" max-height="150" max-width="250" />
          </div>
          <div>
            <v-checkbox v-model="form.is_public" label="Опубликовать запись" class="d-inline-block" hide-details />
          </div>
          <div>
            <v-checkbox v-model="form.is_discuss" label="Разрешить комментирование" class="d-inline-block" hide-details />
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
import { edit, postRequest, update } from '../../api/api'
import CKEditor from 'ckeditor4-vue'
import ckeditor from '../../api/ckeditor'
import showErrors from '../../mixins/showErrors'
import dateTimeConfig from '../../api/datetimepicker'
export default {
  name: 'PostEdit',
  components: {
    ckeditor: CKEditor.component
  },
  mixins: [showErrors],
  data() {
    return {
      loading: false,
      categories: [],
      tags: [],
      image: null,
      form: {
        id: 0,
        title: null,
        slug: null,
        category_id: null,
        tags: [],
        created_at: null,
        excerpt: null,
        content: null,
        md: null,
        mk: null,
        image: null,
        is_public: false,
        is_discuss: true
      },
      ckeditor,
      dateTimeConfig
    }
  },
  created() {
    this.getPost()
  },
  methods: {
    getPost() {
      this.loading = true
      edit('posts', this.$route.params.id).then((res) => {
        this.form = res.data.post
        this.form.tags = res.data.relatedTags || null
        this.categories = res.data.categories
        this.tags = res.data.tags
        this.form.image = res.data.post.image
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      update('posts', this.$route.params.id, this.form).then((res) => {
        this.$toast.success(res.data.success)
      }).catch((err) => {
        this.showErrors(err)
      })
    },
    uploadPreviewImage() {
      if (this.image) {
        const form = new FormData()
        form.append('image', this.image)
        postRequest('posts/upload', form, {
          headers: { 'Content-Type': 'multipart/form-data' }
        }).then((res) => {
          this.$toast.success(res.data.success)
          this.form.image = res.data.newImage
          this.image = null
        }).catch((err) => {
          this.showErrors(err)
          this.image = null
        })
      }
    }
  }
}
</script>

<style scoped>
.hint > i {
    color: #1976d2 !important;
}
</style>
