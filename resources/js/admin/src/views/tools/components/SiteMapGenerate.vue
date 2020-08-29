<template>
  <md-card class="mb">
    <md-card-header>
      <div class="md-title">
        Создать карту сайта
      </div>
    </md-card-header>
    <md-card-content>
      <md-icon>info</md-icon>
      <span>Эта функция создаст XML-карту сайта, которая увеличит эффективность индексации сайта поисковыми системами</span>
      <div class="mt">
        <md-button class="md-raised md-primary" @click="generateSiteMap">
          Создать карту
        </md-button>
        <md-progress-spinner v-if="generating" :md-diameter="40" md-mode="indeterminate" />
      </div>
    </md-card-content>
    <md-card-actions v-if="success" md-alignment="left">
      <div>Карта сайта доступна по пути: <b>Корневая директория сайта/public/sitemap.xml</b></div>
    </md-card-actions>
  </md-card>
</template>

<script>
import { postRequest } from '../../../api/api'
export default {
  name: 'SiteMapGenerate',
  data() {
    return {
      generating: false,
      success: false
    }
  },
  methods: {
    generateSiteMap() {
      this.generating = true
      postRequest('tools/site-map-generate', {}).then((res) => {
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
.mb {
    margin-bottom: 15px;
}
.mt {
    margin-top: 15px;
}
</style>
