<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Редактировать комментарий
      </v-card-title>
      <v-card-text>
        <p>Логин автора: <b>{{ form.user.login }}</b></p>
        <div v-if="form.updated_at !== form.created_at">
          <p>Отредактирован когда: <b>{{ form.updated_at }}</b></p>
          <p>Отредактирован кем: <b>{{ form.updated_by }}</b></p>
        </div>
        <form @submit.prevent="save">
          <label>Содержимое страницы</label>
          <ckeditor v-model="form.content" :config="ckeditor" class="mb-5" />
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
import CKEditor from 'ckeditor4-vue'
import ckeditor from '../../api/ckeditor'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'CommentEdit',
  components: {
    ckeditor: CKEditor.component
  },
  mixins: [showErrors],
  data() {
    return {
      loading: false,
      form: {
        user: {},
        content: null
      },
      ckeditor
    }
  },
  created() {
    this.getComment()
  },
  methods: {
    getComment() {
      this.loading = true
      edit('comments', this.$route.params.id).then((res) => {
        this.form = res.data.comment
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      update('comments', this.$route.params.id, this.form).then((res) => {
        this.$toast.success(res.data.success)
        this.getComment()
      }).catch((err) => {
        this.showErrors(err)
      })
    }
  }
}
</script>

<style scoped>

</style>
