import Vue from 'vue'
import VueRouter from 'vue-router'
import { getRequest } from '../api/api'

Vue.use(VueRouter)

const routes = [
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: () => import('../views/dashboard'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/categories',
    name: 'categories',
    component: () => import('../views/categories/CategoryList'),
    meta: {
      breadcrumb: [
        {
          text: 'Разделы',
          to: { name: 'categories' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/categories/create',
    name: 'categories.create',
    component: () => import('../views/categories/CategoryCreate'),
    meta: {
      breadcrumb: [
        {
          text: 'Разделы',
          to: { name: 'categories' }
        },
        {
          text: 'Добавить раздел',
          to: { name: 'categories.create' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/categories/:id/edit',
    name: 'categories.edit',
    component: () => import('../views/categories/CategoryEdit'),
    meta: {
      breadcrumb: [
        {
          text: 'Разделы',
          to: { name: 'categories' }
        },
        {
          text: 'Редактировать раздел',
          to: { name: 'categories.edit' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/posts',
    name: 'posts',
    component: () => import('../views/posts/PostList'),
    meta: {
      breadcrumb: [
        {
          text: 'Записи',
          to: { name: 'posts' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/posts/create',
    name: 'posts.create',
    component: () => import('../views/posts/PostCreate'),
    meta: {
      breadcrumb: [
        {
          text: 'Записи',
          to: { name: 'posts' }
        },
        {
          text: 'Добавить запись',
          to: { name: 'posts.create' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/posts/:id/edit',
    name: 'posts.edit',
    component: () => import('../views/posts/PostEdit'),
    meta: {
      breadcrumb: [
        {
          text: 'Записи',
          to: { name: 'posts' }
        },
        {
          text: 'Редактировать запись',
          to: { name: 'posts.edit' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/tags',
    name: 'tags',
    component: () => import('../views/tags/TagList'),
    meta: {
      breadcrumb: [
        {
          text: 'Теги',
          to: { name: 'tags' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/tags/create',
    name: 'tags.create',
    component: () => import('../views/tags/TagCreate'),
    meta: {
      breadcrumb: [
        {
          text: 'Теги',
          to: { name: 'tags' }
        },
        {
          text: 'Добавить тег',
          to: { name: 'tags.create' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/tags/:id/edit',
    name: 'tags.edit',
    component: () => import('../views/tags/TagEdit'),
    meta: {
      breadcrumb: [
        {
          text: 'Теги',
          to: { name: 'tags' }
        },
        {
          text: 'Редактировать тег',
          to: { name: 'tags.edit' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/users',
    name: 'users',
    component: () => import('../views/users/UserList'),
    meta: {
      breadcrumb: [
        {
          text: 'Пользователи',
          to: { name: 'users' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/users/create',
    name: 'users.create',
    component: () => import('../views/users/UserCreate'),
    meta: {
      breadcrumb: [
        {
          text: 'Пользователи',
          to: { name: 'users' }
        },
        {
          text: 'Добавить пользователя',
          to: { name: 'users.create' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/users/:id/edit',
    name: 'users.edit',
    component: () => import('../views/users/UserEdit'),
    meta: {
      breadcrumb: [
        {
          text: 'Пользователи',
          to: { name: 'users' }
        },
        {
          text: 'Редактировать пользователя',
          to: { name: 'users.edit' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/pages',
    name: 'pages',
    component: () => import('../views/pages/PageList'),
    meta: {
      breadcrumb: [
        {
          text: 'Страницы',
          to: { name: 'pages' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/pages/create',
    name: 'pages.create',
    component: () => import('../views/pages/PageCreate'),
    meta: {
      breadcrumb: [
        {
          text: 'Страницы',
          to: { name: 'pages' }
        },
        {
          text: 'Добавить страницу',
          to: { name: 'pages.create' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/pages/:id/edit',
    name: 'pages.edit',
    component: () => import('../views/pages/PageEdit'),
    meta: {
      breadcrumb: [
        {
          text: 'Страницы',
          to: { name: 'pages' }
        },
        {
          text: 'Редактировать страницу',
          to: { name: 'pages.edit' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/comments',
    name: 'comments',
    component: () => import('../views/comments/CommentList'),
    meta: {
      breadcrumb: [
        {
          text: 'Комментарии',
          to: { name: 'comments' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/comments/:id/edit',
    name: 'comments.edit',
    component: () => import('../views/comments/CommentEdit'),
    meta: {
      breadcrumb: [
        {
          text: 'Комментарии',
          to: { name: 'comments' }
        },
        {
          text: 'Редактировать комментарий',
          to: { name: 'comments.edit' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/menus',
    name: 'menus',
    component: () => import('../views/menus/MenuList'),
    meta: {
      breadcrumb: [
        {
          text: 'Навигационные меню',
          to: { name: 'menus' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/menus/:id/edit',
    name: 'menus.edit',
    component: () => import('../views/menus/MenuEdit'),
    meta: {
      breadcrumb: [
        {
          text: 'Навигационные меню',
          to: { name: 'menus' }
        },
        {
          text: 'Редактировать меню',
          to: { name: 'menus.edit' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/tickets',
    name: 'tickets',
    component: () => import('../views/tickets/TicketList'),
    meta: {
      breadcrumb: [
        {
          text: 'Вопросы в поддержку',
          to: { name: 'tickets' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/tickets/:id/show',
    name: 'tickets.show',
    component: () => import('../views/tickets/TicketShow'),
    meta: {
      breadcrumb: [
        {
          text: 'Вопросы в поддержку',
          to: { name: 'tickets' }
        },
        {
          text: 'Чат вопроса',
          to: { name: 'tickets.show' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/trash',
    name: 'trash',
    component: () => import('../views/trash/TrashList'),
    meta: {
      breadcrumb: [
        {
          text: 'Корзина',
          to: { name: 'trash' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '/tools',
    name: 'tools',
    component: () => import('../views/tools/'),
    meta: {
      breadcrumb: [
        {
          text: 'Инструменты',
          to: { name: 'tools' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/themes',
    name: 'themes',
    component: () => import('../views/settings/ThemeList'),
    meta: {
      breadcrumb: [
        {
          text: 'Внешний вид',
          to: { name: 'themes' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/settings',
    name: 'settings',
    component: () => import('../views/settings/SettingList'),
    meta: {
      breadcrumb: [
        {
          text: 'Настройки',
          to: { name: 'settings' }
        }
      ],
      permission: 4
    }
  },
  {
    path: '/404',
    name: 'NotFound',
    component: () => import('../views/404/index'),
    meta: {
      breadcrumb: [
        {
          text: 'Страница не найдена',
          to: { name: 'NotFound' }
        }
      ],
      permission: 3
    }
  },
  {
    path: '*',
    redirect: '/404'
  }
]

routes.forEach(x => {
  if (x.meta && !x.meta.breadcrumb) {
    x.meta.breadcrumb = [{ text: 'Главная', to: { name: 'Dashboard' }, exact: true }]
  } else if (x.meta && x.meta.breadcrumb.length) {
    x.meta.breadcrumb.unshift({ text: 'Главная', to: { name: 'Dashboard' }})
    x.meta.breadcrumb.forEach(y => {
      y.exact = true
    })
  }
})

const router = new VueRouter({
  mode: 'history',
  base: '/admin',
  routes
})

router.beforeEach((to, from, next) => {
  getRequest('auth-user').then((res) => {
    if (to.meta.permission > res.data.user.role_id) next({ name: 'NotFound' })
    else next()
  })
})

export default router
