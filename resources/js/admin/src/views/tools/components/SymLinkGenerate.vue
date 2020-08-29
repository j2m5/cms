<template>
  <md-card class="mb">
    <md-card-header>
      <div class="md-title">
        Создать ссылку на папку для хранения загруженных пользователями файлов
      </div>
    </md-card-header>
    <md-card-content>
      <md-icon>info</md-icon>
      <span> Эта функция создаст символьную ссылку для папки, в которой хранятся все загруженные на сервер файлы</span>
      <div class="mt">
        <md-button class="md-raised md-primary" @click="generateSymLink">
          Создать ссылку
        </md-button>
        <md-progress-spinner v-if="generating" :md-diameter="40" md-mode="indeterminate" />
      </div>
    </md-card-content>
    <md-card-actions v-if="success" md-alignment="left">
      <div>
        <div class="warning">
          <md-icon>warning</md-icon>
          <span> Рекомендуется обновить страницу</span>
        </div>
        <div>Ссылка на папку доступна по пути: <b>Корневая директория сайта/public/storage</b></div>
      </div>
    </md-card-actions>
  </md-card>
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
    color: #448aff !important;
}
.warning > i {
    color: #ffc107 !important;
}
.mb {
    margin-bottom: 15px;
}
.mt {
    margin-top: 15px;
}
</style>
