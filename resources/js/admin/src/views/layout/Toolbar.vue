<template>
  <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" src="/dist/assets/bg.jpg" app dark>
    <v-app-bar-nav-icon @click="updateDrawer" />
    <v-toolbar-title style="cursor: pointer;" @click="openMain">
      {{ siteName }}
    </v-toolbar-title>
    <v-spacer />
    <v-avatar>
      <img :src="siteUrl + '/storage/' + $store.getters.user.avatar" alt="">
    </v-avatar>
    <span style="margin-left: 10px;">{{ $store.getters.user.login }}</span>
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
    }
  },
  created() {
    this.$store.dispatch('getSiteName')
  },
  methods: {
    updateDrawer() {
      this.$store.commit('updateDrawer', this.setDrawer = !this.setDrawer)
    },
    openMain() {
      window.open('/')
    }
  }
}
</script>

<style scoped>

</style>
