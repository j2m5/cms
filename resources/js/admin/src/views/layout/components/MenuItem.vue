<template>
  <div>
    <md-list-item v-if="children.length" :to="path" md-expand>
      <md-icon>{{ icon }}</md-icon>
      <span class="md-list-item-text">{{ label }}</span>
      <md-list slot="md-expand">
        <md-list-item v-for="(child, key) in children" :key="key" :to="child.path" class="md-inset">
          {{ child.label }}
        </md-list-item>
      </md-list>
    </md-list-item>
    <md-list-item v-else :to="path">
      <md-icon>{{ icon }}</md-icon>
      <span class="md-list-item-text">{{ label }}</span>
    </md-list-item>
  </div>
</template>

<script>
export default {
  name: 'MenuItem',
  props: {
    path: {
      type: String,
      default: () => ''
    },
    icon: {
      type: String,
      default: () => ''
    },
    label: {
      type: String,
      default: () => ''
    },
    children: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style scoped>

</style>
