<template>
  <div>
    <md-toolbar class="md-transparent align-center" md-elevation="0">
      <a v-if="!siteLogo" :href="siteUrl" target="_blank">{{ siteName }}</a>
      <a v-else :href="siteUrl" target="_blank">
        <img :src="siteLogo" :alt="siteName">
      </a>
    </md-toolbar>
    <md-list>
      <menu-item
        v-for="(item, key) in allowedItems"
        :key="key"
        :path="item.path"
        :label="item.label"
        :icon="item.icon"
        :children="item.children"
      />
    </md-list>
  </div>
</template>

<script>
import items from '../../router/menu'
import config from '../../api/config'
const MenuItem = () => import('./components/MenuItem')
export default {
  name: 'Navbar',
  components: { MenuItem },
  computed: {
    siteUrl() {
      return config.siteUrl
    },
    siteName() {
      return this.$store.getters.siteName
    },
    siteLogo() {
      return this.$store.getters.siteLogo
    },
    user() {
      return this.$store.getters.user
    },
    allowedItems() {
      return items
    }
  },
  created() {
    this.$store.dispatch('getSiteName')
    this.$store.dispatch('getSiteLogo')
    this.$store.dispatch('getUser')
  }
}
</script>

<style scoped>
.align-center {
    justify-content: center;
}
</style>
