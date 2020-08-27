<template>
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
</template>

<script>
import items from '../../router/menu'
const MenuItem = () => import('./components/MenuItem')
export default {
  name: 'Navbar',
  components: { MenuItem },
  computed: {
    allowedItems() {
      return items
    }
  }
}
</script>

<style scoped>

</style>
