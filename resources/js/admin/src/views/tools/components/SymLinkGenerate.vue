<template>
  <v-card class="mb-5">
    <v-card-title class="headline">
      Создать ссылку на папку для хранения загруженных пользователями файлов
    </v-card-title>
    <v-card-text>
      <v-icon>mdi-information</v-icon>
      <span>Эта функция создаст символьную ссылку для папки, в которой хранятся все загруженные на сервер файлы</span>
      <div class="mt-3">
        <v-btn type="submit" color="primary" rounded @click="generateSymLink">
          Создать ссылку
        </v-btn>
        <v-progress-circular v-if="generating" indeterminate color="primary" />
      </div>
    </v-card-text>
    <v-divider />
    <v-card-actions v-if="success">
      <div>
        <div class="warn">
          <v-icon>mdi-alert</v-icon>
          <span> Рекомендуется обновить страницу</span>
        </div>
        <div>Ссылка на папку доступна по пути: <b>Корневая директория сайта/public/storage</b></div>
      </div>
    </v-card-actions>
  </v-card>
</template>

<script>
import { postRequest } from '../../../api/api'
export default {
  name: 'SymLinkGenerate',
  data() {
    return {
      generating: false,
      success: false
    }
  },
  methods: {
    generateSymLink() {
      this.generating = true
      postRequest('tools/sym-link-generate', {}).then((res) => {
        this.$toast.success(res.data.success)
        this.success = true
      }).catch(() => {
        this.$toast.warning('Произошла ошибка')
      }).finally(() => {
        setTimeout(() => {
          this.generating = false
        }, 1000)
      })
    }
  }
}
</script>

<style scoped>
i {
    color: #1976d2 !important;
}
.warn > i {
    color: #fb8c00 !important;
}
.mb {
    margin-bottom: 15px;
}
.mt {
    margin-top: 15px;
}
</style>
