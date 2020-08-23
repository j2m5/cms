<template>
  <div id="app">
    <md-app md-mode="fixed">
      <md-app-toolbar class="md-primary">
        <toolbar/>
      </md-app-toolbar>
      <md-app-drawer md-permanent="full">
        <navbar/>
      </md-app-drawer>
      <md-app-content>
        <router-view/>
      </md-app-content>
    </md-app>
  </div>
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
  @import url("https://fonts.googleapis.com/css?family=Material+Icons");
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }
</style>
