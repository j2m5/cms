<template>
  <v-list>
    <v-list-item v-for="(type, key) in types" :key="key" @click="setType(type)">
      <v-list-item-icon>
        <v-icon>{{ type.icon }}</v-icon>
      </v-list-item-icon>
      <v-list-item-content>
        <v-list-item-title v-text="type.name" />
      </v-list-item-content>
    </v-list-item>
    <menu-item-create
      :menu-id="Number(menuId)"
      :visible.sync="visible"
      :item="currentType"
      :items="items"
      :entities="entities"
      @close-settings="clearType"
      @updated-items="updateItems"
    />
  </v-list>
</template>

<script>
const MenuItemCreate = () => import('../components/MenuItemCreate')
export default {
  name: 'MenuItemTemplate',
  components: { MenuItemCreate },
  props: {
    menuId: {
      type: Number,
      required: true
    },
    types: {
      type: Array,
      required: true
    },
    items: {
      type: Array,
      default: () => []
    },
    entities: {
      type: [Object, Array],
      default: () => {}
    }
  },
  data() {
    return {
      visible: false,
      currentType: {},
      index: 0
    }
  },
  methods: {
    setType(type) {
      this.visible = true
      this.currentType = type
    },
    clearType() {
      this.visible = false
      this.currentType = {}
    },
    updateItems() {
      this.$emit('update-items')
    }
  }
}
</script>

<style scoped>

</style>
