import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter)

/* const routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('./components/Dashboard/DashboardComponent'),
    meta: {
      breadcrumb: {
        label: 'Главная'
      },
      permission: 3
    }
  },
  {
    path: '/categories',
    name: 'categories',
    component: () => import('./components/Categories/CategoryList'),
    meta: {
      breadcrumb: {
        label: 'Разделы',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '/categories/create',
    name: 'categories.create',
    component: () => import('./components/Categories/CategoryCreate'),
    meta: {
      breadcrumb: {
        label: 'Добавить раздел',
        parent: 'categories'
      },
      permission: 4
    }
  },
  {
    path: '/categories/:id/edit',
    name: 'categories.edit',
    component: () => import('./components/Categories/CategoryEdit'),
    meta: {
      breadcrumb: {
        label: 'Редактировать раздел',
        parent: 'categories'
      },
      permission: 4
    }
  },
  {
    path: '/posts',
    name: 'posts',
    component: () => import('./components/Posts/PostList'),
    meta: {
      breadcrumb: {
        label: 'Записи',
        parent: 'dashboard'
      },
      permission: 3
    }
  },
  {
    path: '/posts/create',
    name: 'posts.create',
    component: () => import('./components/Posts/PostCreate'),
    meta: {
      breadcrumb: {
        label: 'Добавить запись',
        parent: 'posts'
      },
      permission: 3
    }
  },
  {
    path: '/posts/:id/edit',
    name: 'posts.edit',
    component: () => import('./components/Posts/PostEdit'),
    meta: {
      breadcrumb: {
        label: 'Редактировать запись',
        parent: 'posts'
      },
      permission: 3
    }
  },
  {
    path: '/tags',
    name: 'tags',
    component: () => import('./components/Tags/TagList'),
    meta: {
      breadcrumb: {
        label: 'Теги',
        parent: 'dashboard'
      },
      permission: 3
    }
  },
  {
    path: '/tags/create',
    name: 'tags.create',
    component: () => import('./components/Tags/TagCreate'),
    meta: {
      breadcrumb: {
        label: 'Добавить тег',
        parent: 'tags'
      },
      permission: 3
    }
  },
  {
    path: '/tags/:id/edit',
    name: 'tags.edit',
    component: () => import('./components/Tags/TagEdit'),
    meta: {
      breadcrumb: {
        label: 'Редактировать тег',
        parent: 'tags'
      },
      permission: 3
    }
  },
  {
    path: '/users',
    name: 'users',
    component: () => import('./components/Users/UserList'),
    meta: {
      breadcrumb: {
        label: 'Пользователи',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '/users/create',
    name: 'users.create',
    component: () => import('./components/Users/UserCreate'),
    meta: {
      breadcrumb: {
        label: 'Добавить пользователя',
        parent: 'users'
      },
      permission: 4
    }
  },
  {
    path: '/users/:id/edit',
    name: 'users.edit',
    component: () => import('./components/Users/UserEdit'),
    meta: {
      breadcrumb: {
        label: 'Редактировать пользователя',
        parent: 'users'
      },
      permission: 4
    }
  },
  {
    path: '/pages',
    name: 'pages',
    component: () => import('./components/Pages/PageList'),
    meta: {
      breadcrumb: {
        label: 'Страницы',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '/pages/create',
    name: 'pages.create',
    component: () => import('./components/Pages/PageCreate'),
    meta: {
      breadcrumb: {
        label: 'Добавить страницу',
        parent: 'pages'
      },
      permission: 4
    }
  },
  {
    path: '/pages/:id/edit',
    name: 'pages.edit',
    component: () => import('./components/Pages/PageEdit'),
    meta: {
      breadcrumb: {
        label: 'Редактировать страницу',
        parent: 'pages'
      },
      permission: 4
    }
  },
  {
    path: '/menus',
    name: 'menus',
    component: () => import('./components/Menu/MenuList'),
    meta: {
      breadcrumb: {
        label: 'Меню',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '/menus/:id/edit',
    name: 'menus.edit',
    component: () => import('./components/Menu/MenuEdit'),
    meta: {
      breadcrumb: {
        label: 'Редактировать меню',
        parent: 'menus'
      },
      permission: 4
    }
  },
  {
    path: '/comments',
    name: 'comments',
    component: () => import('./components/Comments/CommentList'),
    meta: {
      breadcrumb: {
        label: 'Комментарии',
        parent: 'dashboard'
      },
      permission: 3
    }
  },
  {
    path: '/comments/:id/edit',
    name: 'comments.edit',
    component: () => import('./components/Comments/CommentEdit'),
    meta: {
      breadcrumb: {
        label: 'Редактировать комментарий',
        parent: 'comments'
      },
      permission: 3
    }
  },
  {
    path: '/events',
    name: 'events',
    component: () => import('./components/Events/EventList'),
    meta: {
      breadcrumb: {
        label: 'События',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '/tickets',
    name: 'tickets',
    component: () => import('./components/Tickets/TicketList'),
    meta: {
      breadcrumb: {
        label: 'Поддержка',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '/tickets/:id/show',
    name: 'tickets.show',
    component: () => import('./components/Tickets/TicketShow'),
    meta: {
      breadcrumb: {
        label: 'Посмотреть вопрос',
        parent: 'tickets'
      },
      permission: 4
    }
  },
  {
    path: '/files',
    name: 'files',
    component: () => import('./components/Files/FileList'),
    meta: {
      breadcrumb: {
        label: 'Файлы',
        parent: 'dashboard'
      },
      permission: 3
    }
  },
  {
    path: '/trash',
    name: 'trash',
    component: () => import('./components/Trash/TrashList'),
    meta: {
      breadcrumb: {
        label: 'Корзина',
        parent: 'dashboard'
      },
      permission: 3
    }
  },
  {
    path: '/tools',
    name: 'tools',
    component: () => import('./components/Tools/ToolList'),
    meta: {
      breadcrumb: {
        label: 'Инструменты',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '/themes',
    name: 'themes',
    component: () => import('./components/Settings/ThemeList'),
    meta: {
      breadcrumb: {
        label: 'Внешний вид',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '/settings',
    name: 'settings',
    component: () => import('./components/Settings/SettingList'),
    meta: {
      breadcrumb: {
        label: 'Настройки',
        parent: 'dashboard'
      },
      permission: 4
    }
  },
  {
    path: '*',
    name: 'NotFound',
    component: () => import('./components/404/NotFound'),
    meta: {
      breadcrumb: {
        label: 'Страница не найдена',
        parent: 'dashboard'
      },
      permission: 3
    }
  }
]*/

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
      permission: 4
    }
  },
  {
    path: '/categories/create',
    name: 'categories.create',
    component: () => import('../views/categories/CategoryCreate'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/categories/:id/edit',
    name: 'categories.edit',
    component: () => import('../views/categories/CategoryEdit'),
    meta: {
      permission: 4
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: '/admin',
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.permission > store.getters.user.role_id) next({ name: 'dashboard' })
  else next()
})

export default router
