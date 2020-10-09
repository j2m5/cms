<template>
  <div v-if="attrs.length">
    <v-divider />
    <v-row>
      <v-col cols="12" class="header">
        <v-icon>mdi-information</v-icon>
        <span>Вы можете установить на корневой тег элемента меню любые Html-атрибуты, но используйте эту возможность аккуратно, атрибут должен быть валидным (Например: class=example, style=width: 20px;)</span>
      </v-col>
    </v-row>
    <v-row v-for="(attr, key) in attrs" :key="key" align="center">
      <v-col>
        <v-text-field v-model="attr.key" label="Html-атрибут" />
      </v-col>
      <v-col>
        <v-text-field v-model="attr.value" label="Значение атрибута" />
      </v-col>
      <v-col cols="1">
        <v-btn color="error" fab small dark @click="removeAttr(key)">
          <v-icon>mdi-close</v-icon>
        </v-btn>
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
  },
  methods: {
    removeAttr(key) {
      this.attrs.splice(key, 1)
    }
  }
}
</script>

<style scoped>
.header i {
    color: #1976d2 !important;
}
</style>
