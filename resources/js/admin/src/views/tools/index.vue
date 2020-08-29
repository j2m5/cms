<template>
  <div>
    <site-map-generate />
    <sym-link-generate />
  </div>
</template>

<script>
const SiteMapGenerate = () => import('./components/SiteMapGenerate')
const SymLinkGenerate = () => import('./components/SymLinkGenerate')
export default {
  name: 'Index',
  components: {
    SiteMapGenerate,
    SymLinkGenerate
  }
}
</script>

<style scoped>

</style>
