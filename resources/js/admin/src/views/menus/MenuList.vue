<template>
  <v-container>
    <v-row>
      <v-col v-for="(menu, key) in menus" :key="key" cols="6">
        <v-card class="menu-container">
          <v-card-title>{{ menu.name }}</v-card-title>
          <v-divider />
          <v-card-text>
            <div v-if="menu.menu_items.length">
              Структура меню:
            </div>
            <div v-else>
              Пустое меню
            </div>
            <menu-list-item :data="menu.menu_items" />
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="6">
        <div class="create-menu mb-3" @click="visible = true">
          <div class="text-center">
            <div>
              <v-icon>mdi-plus</v-icon>
            </div>
            <div class="create-menu-text">
              Добавить меню
            </div>
          </div>
        </div>
      </v-col>
    </v-row>
    <menu-create :visible.sync="visible" />
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
</template>

<script>
import { index } from '../../api/api'
const MenuListItem = () => import('./components/MenuListItem')
const MenuCreate = () => import('./components/MenuCreate')
export default {
  name: 'MenuList',
  components: { MenuListItem, MenuCreate },
  data() {
    return {
      loading: false,
      visible: false,
      menus: []
    }
  },
  created() {
    this.getMenus()
  },
  methods: {
    getMenus() {
      this.loading = true
      index('menus').then((res) => {
        this.menus = res.data.menus || []
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>

<style scoped>
.menu-container {
    height: 400px;
}
.create-menu {
    border: 3px dashed #c5c5c5;
    border-radius: 0.25rem;
    color: #c5c5c5;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px;
    max-height: 400px;
}
.create-menu i {
    color: #c5c5c5;
    font-size: 5rem;
}
.create-menu .create-menu-text {
    font-size: 1.5rem;
}
</style>
