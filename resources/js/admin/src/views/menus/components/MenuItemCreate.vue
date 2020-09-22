<template>
  <v-dialog v-model="setVisible" width="75%">
    <v-card>
      <v-card-title>Добавить в меню</v-card-title>
      <v-card-text>
        <form>
          <div v-if="item.slug !== 'links'">
            <menu-item-types v-if="item.slug === 'pages'" :entity="entities.pages" type="pages" label="страницу" @select-entity="typeHandler" />
            <menu-item-types v-else-if="item.slug === 'posts'" :entity="entities.posts" type="posts" label="запись" @select-entity="typeHandler" />
            <menu-item-types v-else-if="item.slug === 'categories'" :entity="entities.categories" type="categories" label="раздел" @select-entity="typeHandler" />
          </div>
          <v-text-field v-model="form.label" label="Отображаемый текст" />
          <v-text-field v-if="item.slug !== 'links'" v-model="form.url" label="URL" disabled />
          <v-text-field v-else v-model="form.url" label="URL" />
          <v-checkbox v-model="form.external" label="Открывать в новой вкладке" class="d-inline-block" hide-details />
          <menu-item-attribute :attrs="form.attributes" />
        </form>
      </v-card-text>
      <v-divider />
      <v-card-actions>
        <v-spacer />
        <v-btn color="primary" rounded @click="addAttribute">
          Добавить Html-атрибут
        </v-btn>
        <v-btn color="primary" rounded @click="addItem">
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
import { store } from '../../../api/api'
import config from '../../../api/config'
import showErrors from '../../../mixins/showErrors'
const MenuItemTypes = () => import('../components/MenuItemTypes')
const MenuItemAttribute = () => import('../components/MenuItemAttribute')
export default {
  name: 'MenuItemCreate',
  components: { MenuItemTypes, MenuItemAttribute },
  mixins: [showErrors],
  props: {
    menuId: {
      type: Number,
      required: true
    },
    visible: {
      type: Boolean,
      default: () => false
    },
    item: {
      type: Object,
      default: () => {}
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
      setVisible: false,
      siteUrl: config.siteUrl,
      form: {
        label: '',
        url: '',
        external: 0,
        attributes: []
      }
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
    addItem() {
      const form = {
        menu_id: this.menuId,
        type_id: this.item.id,
        position: this.items.length,
        label: this.form.label,
        url: this.form.url,
        attributes: this.form.attributes,
        external: this.form.external
      }
      store('menu-items', form).then((res) => {
        this.closeDialog()
        this.$toast.success(res.data.success)
        this.$emit('updated-items')
      }).catch((err) => {
        this.showErrors(err)
      })
    },
    addAttribute() {
      this.form.attributes.push({
        key: '',
        value: ''
      })
    },
    typeHandler(e) {
      this.form.label = e.entity.title
      this.form.url = this.siteUrl + '/' + e.type + '/' + e.entity.slug
    },
    closeDialog() {
      this.form.label = ''
      this.form.url = ''
      this.form.external = 0
      this.form.attributes = []
      this.$emit('close-settings')
    }
  }
}
</script>

<style scoped>

</style>
