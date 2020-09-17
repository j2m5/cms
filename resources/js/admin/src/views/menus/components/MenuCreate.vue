<template>
  <v-dialog v-model="setVisible" width="75%">
    <v-card>
      <v-card-title class="headline">
        Добавить меню
      </v-card-title>
      <v-divider />
      <v-card-text>
        <v-text-field v-model="form.name" label="Название" />
      </v-card-text>
      <v-card-actions>
        <v-spacer />
        <v-btn color="primary" rounded @click="addMenu">
          Сохранить
        </v-btn>
        <v-btn color="error" rounded @click="closeDialog">
          Отмена
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { store } from '../../../api/api'
import showErrors from '../../../mixins/showErrors'
export default {
  name: 'MenuCreate',
  mixins: [showErrors],
  props: {
    visible: {
      type: Boolean,
      default: () => false
    }
  },
  data() {
    return {
      setVisible: false,
      form: {
        name: null
      }
    }
  },
  watch: {
    setVisible(val) {
      this.$emit('update:visible', val)
    },
    visible() {
      this.setVisible = this.visible
    }
  },
  methods: {
    addMenu() {
      store('menus', this.form).then((res) => {
        this.$toast.success(res.data.success)
        this.$router.push({ name: 'menus.edit', params: { id: res.data.menu.id }})
      }).catch((err) => {
        this.showErrors(err)
      })
    },
    closeDialog() {
      this.form.name = ''
      this.setVisible = false
    }
  }
}
</script>

<style scoped>

</style>
