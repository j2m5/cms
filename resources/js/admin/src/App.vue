<template>
  <v-app id="vuetify" :style="{background: $vuetify.theme.themes.light.background}">
    <navbar />
    <toolbar />
    <v-main>
      <breadcrumbs />
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
const Toolbar = () => import('./views/layout/Toolbar')
const Navbar = () => import('./views/layout/Navbar')
const Breadcrumbs = () => import('../src/components/Breadcrumbs')
export default {
  name: 'App',
  components: { Toolbar, Navbar, Breadcrumbs }
}
</script>

<style scoped>

</style>
