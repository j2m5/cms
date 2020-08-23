<template>
  <div>
    <md-toolbar class="md-transparent" md-elevation="0">
      Navigation
    </md-toolbar>
    <md-list>
      <md-list-item v-for="(item, key) in allowedItems" :key="key" :to="item.path">
        <md-icon>{{ item.icon }}</md-icon>
        <span class="md-list-item-text">{{ item.label }}</span>
      </md-list-item>
    </md-list>
  </div>
</template>

<script>
import items from '../../router/menu'
export default {
  name: 'Navbar',
  computed: {
    allowedItems: () => {
      return items
    }
  }
}
</script>

<style scoped>

</style>
