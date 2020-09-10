<template>
  <v-container>
    <site-map-generate />
    <sym-link-generate />
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
</template>

<script>
const SiteMapGenerate = () => import('./components/SiteMapGenerate')
const SymLinkGenerate = () => import('./components/SymLinkGenerate')
export default {
  name: 'Index',
  components: {
    SiteMapGenerate,
    SymLinkGenerate
  },
  data() {
    return {
      loading: true
    }
  },
  created() {
    setTimeout(() => {
      this.loading = false
    }, 300)
  }
}
</script>

<style scoped>

</style>
