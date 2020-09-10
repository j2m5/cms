<template>
  <v-app id="vuetify">
    <navbar />
    <toolbar />
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
const Toolbar = () => import('./views/layout/Toolbar')
const Navbar = () => import('./views/layout/Navbar')
export default {
  name: 'App',
  components: { Toolbar, Navbar }
}
</script>

<style scoped>

</style>
