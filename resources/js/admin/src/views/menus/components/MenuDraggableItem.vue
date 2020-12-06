<template>
  <div>
    <draggable :list="items" ghost-class="move-to" group="items" class="mt-mb" @sort="$emit('updated-item')">
      <div v-for="(item, key) in items" :key="key" class="movable">
        <v-card>
          <v-card-text>
            <div class="flex">
              <div>{{ item.name }}</div>
              <div>
                <v-icon class="clickable" @click="setItem(item)">
                  mdi-pencil-outline
                </v-icon>
                <v-icon class="clickable" @click="del(item.id)">
                  mdi-close
                </v-icon>
              </div>
            </div>
          </v-card-text>
        </v-card>
        <menu-draggable-item
          :items="item.items"
          :entities="entities"
          class="tree-list"
          @updated-item="save"
          @deleted-item="getMenu"
        />
      </div>
    </draggable>
    <menu-item-edit
      :visible.sync="visible"
      :item="currentItem"
      :entities="entities"
      @close-settings="clearItem"
    />
  </div>
</template>

<script>
import { destroy } from '../../../api/api'
import draggable from 'vuedraggable'
const MenuItemEdit = () => import('../components/MenuItemEdit')
export default {
  name: 'MenuDraggableItem',
  components: {
    draggable,
    MenuItemEdit
  },
  props: {
    items: {
      type: Array,
      required: true
    },
    entities: {
      type: [Object, Array],
      default: () => {}
    }
  },
  inject: ['getMenu', 'save'],
  data() {
    return {
      visible: false,
      currentItem: {},
      siteUrl: this.$store.getters.siteUrl
    }
  },
  methods: {
    setItem(item) {
      this.visible = true
      this.currentItem = item
    },
    clearItem() {
      this.visible = false
      this.currentItem = {}
    },
    del(id) {
      destroy('menu-items', id).then((res) => {
        this.$toast.success(res.data.success)
      }).then(() => {
        this.$emit('deleted-item')
      })
    }
  }
}
</script>

<style scoped>
.flex {
    display: flex;
    justify-content: space-between;
}
.tree-list {
    margin-left: 30px;
}
.move-to {
    background-color: rgba(218, 219, 219, 0.81);
    border-radius: 0.25rem;
    border: 1px dashed #343a40;
}
.movable{
    cursor: move;
}
.clickable {
    cursor: pointer;
}
.mt-mb {
    margin-top: 15px;
    margin-bottom: 15px;
}
</style>
