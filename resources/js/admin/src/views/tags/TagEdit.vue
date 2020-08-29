<template>
  <md-card>
    <md-card-header>
      <div class="md-title">
        Редактировать тег
      </div>
    </md-card-header>
    <md-card-content>
      <form class="md-layout" @submit.prevent="save">
        <md-field>
          <label>Название</label>
          <md-input v-model="form.name" />
        </md-field>
        <md-field>
          <label>ЧПУ-псевдоним</label>
          <md-input v-model="form.slug" />
        </md-field>
        <md-button type="submit" class="md-raised md-primary">
          Сохранить
        </md-button>
      </form>
    </md-card-content>
  </md-card>
</template>

<script>
import { edit, update } from '../../api/api'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'TagEdit',
  mixins: [showErrors],
  data() {
    return {
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
      edit('tags', this.$route.params.id).then((res) => {
        this.form = res.data.tag
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
