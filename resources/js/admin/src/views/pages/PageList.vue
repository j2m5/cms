<template>
  <v-container>
    <v-card style="margin-bottom: 10px;">
      <v-container>
        <v-text-field v-model="query" label="Введите поисковый запрос и нажмите Enter" clearable @keyup.enter="getPages(true)" @click:clear="reset" />
      </v-container>
    </v-card>
    <v-card>
      <v-card-title class="headline">
        Страницы
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
                  Автор
                </th>
                <th class="text-left">
                  Название
                </th>
                <th class="text-left">
                  Опубликовано
                </th>
                <th class="text-left">
                  Добавлено
                </th>
                <th class="text-left">
                  Обновлено
                </th>
                <th class="text-left" />
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, key) in pages.data" :key="key">
                <td>{{ item.id }}</td>
                <td>{{ item.user.login }}</td>
                <td>
                  <router-link :to="{ name: 'pages.edit', params: { id: item.id } }">
                    {{ item.title }}
                  </router-link>
                </td>
                <td>{{ item.is_public ? 'Да' : 'Нет' }}</td>
                <td>{{ item.created_at }}</td>
                <td>{{ item.updated_at }}</td>
                <td>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn color="error" fab x-small v-bind="attrs" v-on="on" @click="del(item.id)">
                        <v-icon>mdi-delete</v-icon>
                      </v-btn>
                    </template>
                    <span>В корзину</span>
                  </v-tooltip>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
      <v-divider />
      <v-card-actions v-if="pages.total && pages.total > pages.per_page">
        <div class="text-center w-100">
          <v-pagination
            v-model="page"
            :length="pages.last_page"
            :total-visible="11"
            circle
            @input="getPages"
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
import { index, destroy } from '../../api/api'
export default {
  name: 'PageList',
  data() {
    return {
      loading: false,
      query: '',
      page: 1,
      pages: []
    }
  },
  created() {
    this.getPages()
  },
  methods: {
    getPages(firstPage = null) {
      if (firstPage === true) this.page = 1
      this.loading = true
      index('pages', { params: { page: this.page, query: this.query }}).then((res) => {
        this.pages = res.data.pages || []
      }).finally(() => {
        this.loading = false
      })
    },
    reset() {
      this.query = ''
      this.page = 1
      this.getPages()
    },
    del(id) {
      this.$confirm('Вы уверены что хотите удалить страницу?').then((e) => {
        if (e) {
          destroy('pages', id).then((res) => {
            this.$toast.success(res.data.success)
            this.getPages()
          }).catch(() => {
            this.$toast.warning('Произошла ошибка')
          })
        }
      })
    }
  }
}
</script>

<style scoped>
.w-100 {
    width: 100%;
}
</style>
