<template>
  <div class="md-layout md-alignment-left md-gutter">
    <div v-for="(theme, key) in themes" :key="key" class="md-layout-item md-size-50">
      <md-card>
        <md-card-media>
          <img :src="theme | themeImage" :alt="theme" class="theme-preview">
        </md-card-media>
        <md-card-actions md-alignment="space-between">
          <div>{{ theme | ucFirst }}</div>
          <div v-if="theme === currentTheme">
            <md-button class="md-icon-button md-raised" href="/" target="_blank">
              <md-icon>home</md-icon>
            </md-button>
            <md-tooltip md-direction="top">
              Активно: посмотреть на сайте
            </md-tooltip>
          </div>
          <div v-else>
            <md-button class="md-icon-button md-raised md-primary" @click="setTheme(theme)">
              <md-icon>edit</md-icon>
            </md-button>
            <md-tooltip md-direction="top">
              Активировать тему
            </md-tooltip>
          </div>
        </md-card-actions>
      </md-card>
    </div>
  </div>
</template>

<script>
import { index, update } from '../../api/api'
import { ucFirst } from '../../filters'
export default {
  name: 'ThemeList',
  filters: {
    ucFirst,
    themeImage(theme) {
      return '/themes/' + theme + '/theme.png'
    }
  },
  data() {
    return {
      themes: [],
      currentTheme: ''
    }
  },
  created() {
    this.getThemes()
  },
  methods: {
    getThemes() {
      index('themes').then((res) => {
        this.themes = res.data.themes
        this.currentTheme = res.data.currentTheme
      })
    },
    setTheme(theme) {
      update('themes', 6, { value: theme }).then((res) => {
        this.$toast.success(res.data.success)
        this.getThemes()
      }).catch((err) => {
        this.$toast.warning(err.response.data.errors)
      })
    }
  }
}
</script>

<style scoped>
.theme-preview {
    height: 400px;
    width: 100%;
    object-fit: cover;
}
</style>
