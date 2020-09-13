import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

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
  },
  {
    path: '/posts',
    name: 'posts',
    component: () => import('../views/posts/PostList'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/posts/create',
    name: 'posts.create',
    component: () => import('../views/posts/PostCreate'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/posts/:id/edit',
    name: 'posts.edit',
    component: () => import('../views/posts/PostEdit'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/tags',
    name: 'tags',
    component: () => import('../views/tags/TagList'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/tags/create',
    name: 'tags.create',
    component: () => import('../views/tags/TagCreate'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/tags/:id/edit',
    name: 'tags.edit',
    component: () => import('../views/tags/TagEdit'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/users',
    name: 'users',
    component: () => import('../views/users/UserList'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/users/create',
    name: 'users.create',
    component: () => import('../views/users/UserCreate'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/users/:id/edit',
    name: 'users.edit',
    component: () => import('../views/users/UserEdit'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/pages',
    name: 'pages',
    component: () => import('../views/pages/PageList'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/pages/create',
    name: 'pages.create',
    component: () => import('../views/pages/PageCreate'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/pages/:id/edit',
    name: 'pages.edit',
    component: () => import('../views/pages/PageEdit'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/comments',
    name: 'comments',
    component: () => import('../views/comments/CommentList'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/comments/:id/edit',
    name: 'comments.edit',
    component: () => import('../views/comments/CommentEdit'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/tickets',
    name: 'tickets',
    component: () => import('../views/tickets/TicketList'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/tickets/:id/show',
    name: 'tickets.show',
    component: () => import('../views/tickets/TicketShow'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/trash',
    name: 'trash',
    component: () => import('../views/trash/TrashList'),
    meta: {
      permission: 3
    }
  },
  {
    path: '/tools',
    name: 'tools',
    component: () => import('../views/tools/'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/themes',
    name: 'themes',
    component: () => import('../views/settings/ThemeList'),
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
    component: () => import('../views/settings/SettingList'),
    meta: {
      permission: 4
    }
  },
  {
    path: '/404',
    name: 'NotFound',
    component: () => import('../views/404/index'),
    meta: {
      permission: 3
    }
  },
  {
    path: '*',
    redirect: '/404'
  }
]

const router = new VueRouter({
  mode: 'history',
  base: '/admin',
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.permission > store.getters.user.role_id) next({ name: 'NotFound' })
  else next()
})

export default router
