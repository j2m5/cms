<template>
  <v-container>
    <v-row>
      <v-col cols="4">
        <v-card>
          <v-card-title>Шаблоны пунктов меню</v-card-title>
          <v-divider />
          <v-card-text>
            <div class="bordered">
              <v-icon>mdi-information</v-icon>
              <span>Для добавления в формируемое меню нужного шаблона, нужно кликнуть по нему</span>
            </div>
            <div>
              <menu-item-template :menu-id="Number(menuId)" :types="types" :entities="entities" :items.sync="menu.menu_items" @update-items="save" />
            </div>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="8">
        <v-card>
          <v-card-title>Выбранные пункты меню</v-card-title>
          <v-divider />
          <v-card-text>
            <div class="bordered">
              <v-icon>mdi-information</v-icon>
              <span>Перетаскивайте пункты меню в нужном порядке, заполните необходимую информацию и сохраните меню (Внимание: редактировать URL-адрес можно только для шаблона типа Ссылка, в остальных случаях он подставится автоматически)</span>
            </div>
            <div v-if="menu.menu_items">
              <menu-draggable-item :items="menu.menu_items" :entities="Array(entities)" @updated-item="save" @deleted-item="getMenu" />
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-text>
            <v-row align="baseline">
              <v-col cols="9">
                <v-text-field v-model="menuName" label="Название меню" />
              </v-col>
              <v-col cols="3">
                <v-btn color="primary" rounded @click="save">
                  Сохранить
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
</template>

<script>
import { edit, update } from '../../api/api'
import showErrors from '../../mixins/showErrors'
const MenuItemTemplate = () => import('./components/MenuItemTemplate')
const MenuDraggableItem = () => import('./components/MenuDraggableItem')
export default {
  name: 'MenuEdit',
  components: { MenuItemTemplate, MenuDraggableItem },
  mixins: [showErrors],
  data() {
    return {
      loading: false,
      menuId: this.$route.params.id,
      menuName: '',
      menu: {},
      entities: {},
      types: []
    }
  },
  provide() {
    return {
      getMenu: this.getMenu,
      save: this.save
    }
  },
  created() {
    this.getMenu()
  },
  methods: {
    getMenu() {
      this.loading = true
      edit('menus', this.menuId).then((res) => {
        this.menuName = res.data.menu.name || ''
        this.menu = res.data.menu || {}
        this.types = res.data.types || []
        this.entities = res.data.entities || {}
      }).finally(() => {
        this.loading = false
      })
    },
    save() {
      update('menus', this.menuId, { name: this.menuName, items: this.menu.menu_items }).then((res) => {
        this.$toast.success(res.data.success)
        this.getMenu()
      }).catch((err) => {
        this.showErrors(err)
      })
    }
  }
}
</script>

<style scoped>
.bordered i {
    color: #1976d2 !important;
}
.bordered {
    border-bottom: 1px dashed #7e7e7e;
    padding-bottom: 10px;
}
</style>
