<template>
  <v-container>
    <v-row>
      <v-col v-for="(theme, key) in themes" :key="key" md="6">
        <v-card>
          <v-img
            :src="theme | themeImage"
            class="white--text align-end"
            gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
            height="400px"
          >
            <v-card-title>{{ theme | ucFirst }}</v-card-title>
          </v-img>
          <v-card-actions>
            <v-btn v-if="theme === currentTheme" href="/" target="_blank" color="success" rounded>
              Активно: перейти на сайт
            </v-btn>
            <v-btn v-else color="primary" rounded @click="setTheme(theme)">
              Активировать
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
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
      loading: false,
      themes: [],
      currentTheme: ''
    }
  },
  created() {
    this.getThemes()
  },
  methods: {
    getThemes() {
      this.loading = true
      index('themes').then((res) => {
        this.themes = res.data.themes
        this.currentTheme = res.data.currentTheme
      }).finally(() => {
        this.loading = false
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

</style>
