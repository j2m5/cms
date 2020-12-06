<template>
  <v-container>
    <v-card style="margin-bottom: 10px;">
      <v-container>
        <v-text-field v-model="query" label="Введите поисковый запрос и нажмите Enter" clearable @keyup.enter="getPosts" @click:clear="reset" />
      </v-container>
    </v-card>
    <v-card>
      <v-card-title class="headline">
        Записи
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
                  Раздел
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
              <tr v-for="(post, key) in posts.data" :key="key">
                <td>{{ post.id }}</td>
                <td>{{ post.category.title }}</td>
                <td>{{ post.user.login }}</td>
                <td>
                  <router-link :to="{ name: 'posts.edit', params: { id: post.id } }">
                    {{ post.title }}
                  </router-link>
                </td>
                <td>{{ post.is_public ? 'Да' : 'Нет' }}</td>
                <td>{{ post.created_at }}</td>
                <td>{{ post.updated_at }}</td>
                <td>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn color="error" fab x-small v-bind="attrs" v-on="on" @click="del(post.id)">
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
      <v-card-actions v-if="posts.total && posts.total > posts.per_page">
        <div class="text-center w-100">
          <v-pagination
            v-model="page"
            :length="posts.last_page"
            :total-visible="11"
            circle
            @input="getPosts"
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
  name: 'PostList',
  data() {
    return {
      loading: false,
      query: '',
      page: 1,
      posts: []
    }
  },
  created() {
    this.getPosts()
  },
  methods: {
    getPosts() {
      this.loading = true
      index('posts', { params: { page: this.page, query: this.query }}).then((res) => {
        this.posts = res.data.posts || []
      }).finally(() => {
        this.loading = false
      })
    },
    reset() {
      this.query = ''
      this.page = 1
      this.getPosts()
    },
    del(id) {
      this.$confirm('Вы уверены что хотите удалить запись? (также будут удалены все связанные комментарии)').then((e) => {
        if (e) {
          destroy('posts', id).then((res) => {
            this.$toast.success(res.data.success)
            this.getPosts()
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
