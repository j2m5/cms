<template>
  <md-toolbar class="md-transparent align-center" md-elevation="0" style="padding-left: 0">
    <a v-if="!siteLogo" :href="siteUrl" target="_blank">{{ siteName }}</a>
    <a v-else :href="siteUrl" target="_blank">
      <img :src="siteLogo" :alt="siteName" style="width: 205px; height: 52px;">
    </a>
  </md-toolbar>
</template>

<script>
import config from '../../api/config'
export default {
  name: 'Toolbar',
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
  }
}
</script>

<style scoped>

</style>
