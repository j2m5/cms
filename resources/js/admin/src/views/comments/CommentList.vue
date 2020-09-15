<template>
  <v-container>
    <v-card>
      <v-card-title class="headline">
        Комментарии
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
                  К записи
                </th>
                <th class="text-left">
                  Автор
                </th>
                <th class="text-left">
                  Текст
                </th>
                <th class="text-left">
                  Отправлен
                </th>
                <th class="text-left">
                  Обновлен
                </th>
                <th class="text-left" />
              </tr>
            </thead>
            <tbody>
              <tr v-for="(comment, key) in comments.data" :key="key">
                <td>{{ comment.id }}</td>
                <td>{{ comment.post.title }}</td>
                <td>{{ comment.user.login }}</td>
                <td>
                  <router-link :to="{ name: 'comments.edit', params: { id: comment.id } }">
                    {{ comment.content | truncStr }}
                  </router-link>
                </td>
                <td>{{ comment.created_at }}</td>
                <td>{{ comment.updated_at }}</td>
                <td>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn color="error" fab x-small v-bind="attrs" v-on="on" @click="del(comment.id)">
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
      <v-card-actions v-if="comments.total && comments.total > comments.per_page">
        <div class="text-center w-100">
          <v-pagination
            v-model="query.page"
            :length="comments.last_page"
            :total-visible="11"
            circle
            @input="getComments"
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
import { truncStr } from '../../filters'
export default {
  name: 'CommentList',
  filters: { truncStr },
  data() {
    return {
      loading: false,
      query: {
        page: 1
      },
      comments: []
    }
  },
  created() {
    this.getComments()
  },
  methods: {
    getComments() {
      this.loading = true
      index('comments', { params: { page: this.query.page }}).then((res) => {
        this.comments = res.data.comments || []
      }).finally(() => {
        this.loading = false
      })
    },
    del(id) {
      this.$confirm('Вы уверены что хотите удалить комментарий? (также будут удалены все ответы на него)').then((e) => {
        if (e) {
          destroy('comments', id).then((res) => {
            this.$toast.success(res.data.success)
            this.getComments()
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
