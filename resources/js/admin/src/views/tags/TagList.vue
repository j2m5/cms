<template>
  <v-container>
    <v-card style="margin-bottom: 10px;">
      <v-container>
        <v-text-field v-model="query" label="Введите поисковый запрос и нажмите Enter" clearable @keyup.enter="getTags(true)" @click:clear="reset" />
      </v-container>
    </v-card>
    <v-card>
      <v-card-title class="headline">
        Теги
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
                  Кол-во записей
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
              <tr v-for="(tag, key) in tags.data" :key="key">
                <td>{{ tag.id }}</td>
                <td>
                  <router-link :to="{ name: 'tags.edit', params: { id: tag.id } }">
                    {{ tag.name }}
                  </router-link>
                </td>
                <td>{{ tag.posts.length }}</td>
                <td>{{ tag.created_at }}</td>
                <td>{{ tag.updated_at || '--' }}</td>
                <td>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn color="error" fab x-small v-bind="attrs" v-on="on" @click="del(tag.id)">
                        <v-icon>mdi-delete-forever</v-icon>
                      </v-btn>
                    </template>
                    <span>Удалить</span>
                  </v-tooltip>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
      <v-divider />
      <v-card-actions v-if="tags.total && tags.total > tags.per_page">
        <div class="text-center w-100">
          <v-pagination
            v-model="page"
            :length="tags.last_page"
            :total-visible="11"
            circle
            @input="getTags"
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
  name: 'TagList',
  data() {
    return {
      loading: false,
      query: '',
      page: 1,
      tags: []
    }
  },
  created() {
    this.getTags()
  },
  methods: {
    getTags(firstPage = null) {
      if (firstPage === true) this.page = 1
      this.loading = true
      index('tags', { params: { page: this.page, query: this.query }}).then((res) => {
        this.tags = res.data.tags || []
      }).finally(() => {
        this.loading = false
      })
    },
    reset() {
      this.query = ''
      this.page = 1
      this.getTags()
    },
    del(id) {
      this.$confirm('Вы уверены что хотите удалить тег?').then((e) => {
        if (e) {
          destroy('tags', id).then((res) => {
            this.$toast.success(res.data.success)
            this.getTags()
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
