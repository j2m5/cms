<template>
  <v-dialog v-model="setVisible" width="75%">
    <v-card>
      <v-card-title>Редактировать пункт меню</v-card-title>
      <v-card-text>
        <form>
          <div v-if="item.slug !== 'links'">
            <menu-item-types v-if="item.slug === 'pages'" :entity="entities.pages" type="pages" label="страницу" @select-entity="typeHandler" />
            <menu-item-types v-else-if="item.slug === 'posts'" :entity="entities.posts" type="posts" label="запись" @select-entity="typeHandler" />
            <menu-item-types v-else-if="item.slug === 'categories'" :entity="entities.categories" type="categories" label="раздел" @select-entity="typeHandler" />
          </div>
          <v-text-field v-model="item.label" label="Отображаемый текст" />
          <v-text-field v-if="item.slug !== 'links'" v-model="item.url" label="URL" disabled />
          <v-text-field v-else v-model="item.url" label="URL" />
          <v-checkbox v-model="item.external" label="Открывать в новой вкладке" class="d-inline-block" hide-details />
          <menu-item-attribute :attrs="item.attributes" />
        </form>
      </v-card-text>
      <v-divider />
      <v-card-actions>
        <v-spacer />
        <v-btn color="primary" rounded @click="addAttribute">
          Добавить Html-атрибут
        </v-btn>
        <v-btn color="primary" rounded @click="editItem">
          Сохранить
        </v-btn>
        <v-btn color="error" rounded @click="closeDialog">
          Отмена
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { update } from '../../../api/api'
import config from '../../../api/config'
import showErrors from '../../../mixins/showErrors'
const MenuItemTypes = () => import('../components/MenuItemTypes')
const MenuItemAttribute = () => import('../components/MenuItemAttribute')
export default {
  name: 'MenuItemEdit',
  components: {
    MenuItemTypes,
    MenuItemAttribute
  },
  mixins: [showErrors],
  props: {
    visible: {
      type: Boolean,
      default: () => false
    },
    item: {
      type: Object,
      default: () => {}
    },
    entities: {
      type: [Object, Array],
      default: () => {}
    }
  },
  data() {
    return {
      setVisible: false,
      siteUrl: config.siteUrl
    }
  },
  watch: {
    setVisible(val) {
      this.$emit('update:visible', val)
    },
    visible() {
      this.setVisible = this.visible
    }
  },
  methods: {
    editItem() {
      update('menu-items', this.item.id, this.item).then((res) => {
        this.$toast.success(res.data.success)
      }).catch((err) => {
        this.showErrors(err)
      })
    },
    addAttribute() {
      this.item.attributes.push({
        key: '',
        value: ''
      })
    },
    typeHandler(e) {
      this.item.label = e.entity.title
      this.item.url = this.siteUrl + '/' + e.type + '/' + e.entity.slug
    },
    closeDialog() {
      this.$emit('close-settings')
    }
  }
}
</script>

<style scoped>

</style>
