<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        <div>Корзина</div>
        <v-tabs>
          <v-tab @click="changeTab('categories')">
            Разделы
          </v-tab>
          <v-tab @click="changeTab('posts')">
            Записи
          </v-tab>
          <v-tab @click="changeTab('comments')">
            Комментарии
          </v-tab>
          <v-tab @click="changeTab('pages')">
            Страницы
          </v-tab>
        </v-tabs>
      </v-card-title>
      <v-card-text>
        <v-simple-table fixed-header>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">
                  ID
                </th>
                <th class="text-left">
                  Название / Текст
                </th>
                <th class="text-left">
                  Добавлено
                </th>
                <th class="text-left">
                  Удалено
                </th>
                <th class="text-left" />
                <th class="text-left" />
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, key) in trash.data" :key="key">
                <td>{{ item.id }}</td>
                <td>
                  <span v-if="item.title">{{ item.title }}</span>
                  <span v-else-if="!item.title && item.content">{{ item.content | truncStr(30) }}</span>
                  <span v-else>--</span>
                </td>
                <td>{{ item.created_at }}</td>
                <td>{{ item.deleted_at }}</td>
                <td>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn color="success" fab x-small v-bind="attrs" v-on="on" @click="restore(type, item.id)">
                        <v-icon>mdi-delete-restore</v-icon>
                      </v-btn>
                    </template>
                    <span>Восстановить из корзины</span>
                  </v-tooltip>
                </td>
                <td>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn color="error" fab x-small v-bind="attrs" v-on="on" @click="del(type, item.id)">
                        <v-icon>mdi-delete-forever</v-icon>
                      </v-btn>
                    </template>
                    <span>Удалить навсегда</span>
                  </v-tooltip>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
      <v-divider />
      <v-card-actions v-if="trash.total && trash.total > trash.per_page">
        <div class="text-center w-100">
          <v-pagination
            v-model="query.page"
            :length="trash.last_page"
            :total-visible="11"
            circle
            @input="getData"
          />
        </div>
      </v-card-actions>
    </v-card>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64" />
    </v-overlay>
  </v-container>
</template>

<script>
import { index, restore, erase } from '../../api/api'
import { truncStr } from '../../filters'
export default {
  name: 'TrashList',
  filters: { truncStr },
  data() {
    return {
      loading: false,
      categories: [],
      posts: [],
      comments: [],
      pages: [],
      trash: [],
      type: 'categories',
      query: {
        page: 1
      }
    }
  },
  created() {
    this.getData()
  },
  methods: {
    getData() {
      this.loading = true
      index('trash', {
        params: {
          type: this.type,
          page: this.query.page
        }
      }).then((res) => {
        switch (this.type) {
          case 'categories':
            this.trash = res.data.categories
            break
          case 'posts':
            this.trash = res.data.posts
            break
          case 'comments':
            this.trash = res.data.comments
            break
          case 'pages':
            this.trash = res.data.pages
            break
          default:
            this.trash = res.data.categories
        }
      }).finally(() => {
        this.loading = false
      })
    },
    restore(type, id) {
      restore(type, id).then((res) => {
        this.$toast.success(res.data.success)
        this.getData()
      }).catch((err) => {
        this.$toast.warning(err.response.data.errors)
      })
    },
    del(type, id) {
      erase(type, id).then((res) => {
        this.$toast.success(res.data.success)
        this.getData()
      }).catch((err) => {
        this.$toast.warning(err.response.data.errors)
      })
    },
    changeTab(entity) {
      this.type = entity
      this.query.page = 1
      this.getData()
    }
  }
}
</script>

<style scoped>
.w-100 {
    width: 100%;
}
</style>
