<template>
  <v-select
    :items="entity"
    :label="'Выберите ' + label"
    item-text="title"
    item-value="id"
    @change="changeEntity"
  />
</template>

<script>
export default {
  name: 'MenuItemTypes',
  props: {
    entity: {
      type: Array,
      default: () => []
    },
    label: {
      type: String,
      default: () => ''
    },
    type: {
      type: String,
      required: true
    }
  },
  methods: {
    changeEntity(e) {
      const entity = this.entity.find(x => x.id === e)
      this.$emit('select-entity', { type: this.type, entity })
    }
  }
}
</script>

<style scoped>

</style>
