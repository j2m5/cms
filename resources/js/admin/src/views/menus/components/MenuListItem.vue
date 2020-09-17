<template>
  <div v-if="data.length" class="tree">
    <div v-for="(item, key) in data" :key="key" class="tree-list">
      <v-icon>mdi-chevron-double-right</v-icon>
      <b>{{ item.label }}</b>
      <menu-list-item :data="item.items" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'MenuListItem',
  props: {
    data: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style scoped>
    .tree-list {
        margin-left: 20px;
    }
</style>
