<template>
  <v-container>
    <v-card style="margin-bottom: 10px;">
      <v-container>
        <v-text-field v-model="query" label="Введите поисковый запрос и нажмите Enter" clearable @keyup.enter="getCategories" @click:clear="reset" />
      </v-container>
    </v-card>
    <v-card>
      <v-card-title class="headline">
        Разделы
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
                  Название
                </th>
                <th class="text-left">
                  Описание
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
              <tr v-for="(category, key) in categories.data" :key="key">
                <td>{{ category.id }}</td>
                <td>
                  <router-link :to="{ name: 'categories.edit', params: { id: category.id } }">
                    {{ category.title }}
                  </router-link>
                </td>
                <td>{{ category.description || '--' }}</td>
                <td>{{ category.created_at }}</td>
                <td>{{ category.updated_at || '--' }}</td>
                <td>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn color="error" fab x-small v-bind="attrs" v-on="on" @click="del(category.id)">
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
      <v-card-actions v-if="categories.total && categories.total > categories.per_page">
        <div class="text-center w-100">
          <v-pagination
            v-model="page"
            :length="categories.last_page"
            :total-visible="11"
            circle
            @input="getCategories"
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
  name: 'CategoryList',
  data() {
    return {
      loading: false,
      query: '',
      page: 1,
      categories: []
    }
  },
  created() {
    this.getCategories()
  },
  methods: {
    getCategories() {
      this.loading = true
      index('categories', { params: { page: this.page, query: this.query }}).then((res) => {
        this.categories = res.data.categories || []
      }).finally(() => {
        this.loading = false
      })
    },
    reset() {
      this.query = ''
      this.page = 1
      this.getCategories()
    },
    del(id) {
      this.$confirm('Вы уверены что хотите удалить раздел? (также будут удалены все связанные записи и комментарии)').then((e) => {
        if (e) {
          destroy('categories', id).then((res) => {
            this.$toast.success(res.data.success)
            this.getCategories()
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
