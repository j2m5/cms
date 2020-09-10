<template>
  <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" color="indigo darken-2" app dark>
    <v-app-bar-nav-icon @click="updateDrawer" />
    <v-toolbar-title>{{ siteName }}</v-toolbar-title>
  </v-app-bar>
</template>

<script>
import config from '../../api/config'
export default {
  name: 'Toolbar',
  data() {
    return {
      setDrawer: true
    }
  },
  computed: {
    siteUrl() {
      return config.siteUrl
    },
    siteName() {
      return this.$store.getters.siteName
    },
    siteLogo() {
      return this.$store.getters.siteLogo
    }
  },
  created() {
    this.$store.dispatch('getSiteName')
    this.$store.dispatch('getSiteLogo')
  },
  methods: {
    updateDrawer() {
      this.$store.commit('updateDrawer', this.setDrawer = !this.setDrawer)
    }
  }
}
</script>

<style scoped>

</style>
