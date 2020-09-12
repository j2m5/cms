const items = [
  {
    path: '/dashboard',
    icon: 'mdi-home',
    label: 'Главная',
    permission: 3,
    children: []
  },
  {
    path: '/categories',
    icon: 'mdi-folder',
    label: 'Разделы',
    permission: 4,
    children: [
      {
        path: '/categories/create',
        icon: '',
        label: 'Добавить новый'
      },
      {
        path: '/categories',
        icon: '',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/posts',
    icon: 'mdi-pencil',
    label: 'Записи',
    permission: 3,
    children: [
      {
        path: '/posts/create',
        icon: '',
        label: 'Добавить новую'
      },
      {
        path: '/posts',
        icon: '',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/tags',
    icon: 'mdi-tag-multiple',
    label: 'Теги',
    permission: 3,
    children: [
      {
        path: '/tags/create',
        icon: '',
        label: 'Добавить новый'
      },
      {
        path: '/tags',
        icon: '',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/users',
    icon: 'mdi-account',
    label: 'Пользователи',
    permission: 4,
    children: [
      {
        path: '/users/create',
        icon: '',
        label: 'Добавить нового'
      },
      {
        path: '/users',
        icon: '',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/pages',
    icon: 'mdi-book-open-page-variant',
    label: 'Страницы',
    permission: 4,
    children: [
      {
        path: '/pages/create',
        icon: '',
        label: 'Добавить новую'
      },
      {
        path: '/pages',
        icon: '',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/comments',
    icon: 'mdi-chat',
    label: 'Комментарии',
    permission: 3,
    children: []
  },
  {
    path: '/menus',
    icon: 'mdi-menu',
    label: 'Меню',
    permission: 4,
    children: []
  },
  {
    path: '/tickets',
    icon: 'mdi-help-circle',
    label: 'Поддержка',
    permission: 4,
    children: []
  },
  {
    path: '/files',
    icon: 'mdi-file',
    label: 'Файлы',
    permission: 3,
    children: []
  },
  {
    path: '/trash',
    icon: 'mdi-delete',
    label: 'Корзина',
    permission: 3,
    children: []
  },
  {
    path: '/tools',
    icon: 'mdi-hammer-screwdriver',
    label: 'Инструменты',
    permission: 4,
    children: []
  },
  {
    path: '/themes',
    icon: 'mdi-brush',
    label: 'Внешний вид',
    permission: 4,
    children: []
  },
  {
    path: '/settings',
    icon: 'mdi-cog',
    label: 'Настройки',
    permission: 4,
    children: []
  }
]

export default items
