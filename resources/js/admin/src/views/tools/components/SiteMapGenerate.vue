<template>
  <v-card class="mb-5">
    <v-card-title class="headline">
      Карта сайта
    </v-card-title>
    <v-card-text>
      <v-icon>mdi-information</v-icon>
      <span>Эта функция создаст XML-карту сайта, которая увеличит эффективность индексации сайта поисковыми системами</span>
      <div class="mt-3">
        <v-btn type="submit" color="primary" rounded @click="generateSiteMap">
          Создать карту
        </v-btn>
        <v-progress-circular v-if="generating" indeterminate color="primary" />
      </div>
    </v-card-text>
    <v-divider />
    <v-card-actions v-if="success">
      <div>Карта сайта доступна по пути: <b>Корневая директория сайта/public/sitemap.xml</b></div>
    </v-card-actions>
  </v-card>
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
    color: #1976d2 !important;
}
.mb {
    margin-bottom: 15px;
}
.mt {
    margin-top: 15px;
}
</style>
