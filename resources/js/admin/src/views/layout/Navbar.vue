<template>
  <v-navigation-drawer v-model="drawer" :clipped="$vuetify.breakpoint.lgAndUp" app>
    <v-list dense>
      <div v-for="(item, key) in allowedItems" :key="key">
        <v-list-item v-if="!item.children.length" :to="item.path" color="primary" link exact>
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-title>{{ item.label }}</v-list-item-title>
        </v-list-item>
        <v-list-group v-else :prepend-icon="item.icon" color="primary" no-action>
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title v-text="item.label" />
            </v-list-item-content>
          </template>
          <v-list-item v-for="subItem in item.children" :key="subItem.title" :to="subItem.path" link exact>
            <v-list-item-content>
              <v-list-item-title v-text="subItem.label" />
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </div>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import items from '../../router/menu'
export default {
  name: 'Navbar',
  data() {
    return {
      setDrawer: true
    }
  },
  computed: {
    allowedItems() {
      return items
    },
    drawer: {
      get() {
        return this.$store.getters.drawer
      },
      set(val) {
        this.setDrawer = val
      }
    }
  }
}
</script>

<style scoped>

</style>
