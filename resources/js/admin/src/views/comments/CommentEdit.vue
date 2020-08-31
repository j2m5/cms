<template>
  <md-card>
    <md-card-header>
      <div class="md-title">
        Редактировать комментарий
      </div>
    </md-card-header>
    <md-card-content>
      <p>Логин автора: <b>{{ form.user.login }}</b></p>
      <div v-if="form.updated_at !== form.created_at">
        <p>Отредактирован когда: <b>{{ form.updated_at }}</b></p>
        <p>Отредактирован кем: <b>{{ form.updated_by }}</b></p>
      </div>
      <form @submit.prevent="save">
        <ckeditor v-model="form.content" :config="ckeditor" />
        <md-button type="submit" class="md-raised md-primary">
          Сохранить
        </md-button>
      </form>
    </md-card-content>
  </md-card>
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
      edit('comments', this.$route.params.id).then((res) => {
        this.form = res.data.comment
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
button {
    margin: 10px 0 0;
}
</style>
