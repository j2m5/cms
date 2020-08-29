<template>
  <md-card>
    <md-card-header>
      <div class="md-title">
        Добавить тег
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
import { store } from '../../api/api'
import showErrors from '../../mixins/showErrors'
export default {
  name: 'TagCreate',
  mixins: [showErrors],
  data() {
    return {
      form: {
        name: null,
        slug: null
      }
    }
  },
  methods: {
    save() {
      store('tags', this.form).then((res) => {
        this.$toast.success(res.data.success)
        this.$router.push({ name: 'tags' })
      }).catch((err) => {
        this.showErrors(err)
      })
    }
  }
}
</script>

<style scoped>

</style>
