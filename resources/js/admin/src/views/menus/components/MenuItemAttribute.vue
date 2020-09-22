<template>
  <div v-if="attrs.length">
    <v-divider />
    <v-row>
      <v-col cols="12">
        <v-icon>mdi-information</v-icon>
        <span>Вы можете установить на корневой тег элемента меню любые Html-атрибуты, но используйте эту возможность аккуратно, атрибут должен быть валидным (Например: class=example, style=width: 20px;)</span>
      </v-col>
    </v-row>
    <v-row v-for="(attr, key) in attrs" :key="key">
      <v-col cols="6">
        <v-text-field v-model="attr.key" label="Html-атрибут" />
      </v-col>
      <v-col cols="6">
        <v-text-field v-model="attr.value" label="Значение атрибута" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  name: 'MenuItemAttribute',
  props: {
    attrs: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style scoped>
i {
    color: #1976d2 !important;
}
</style>
