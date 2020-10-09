<template>
  <v-breadcrumbs :items="items" />
</template>

<script>
export default {
  name: 'Breadcrumbs',
  data() {
    return {
      items: []
    }
  },
  watch: {
    '$route': function() {
      this.updateList()
    }
  },
  created() {
    this.updateList()
  },
  methods: {
    updateList() {
      this.items = this.$route.meta.breadcrumb
    }
  }
}
</script>

<style scoped>

</style>
