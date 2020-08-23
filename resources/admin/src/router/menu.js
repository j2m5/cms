const items = [
  {
    path: '/dashboard',
    icon: 'home',
    label: 'Главная',
    permission: 3,
    children: []
  },
  {
    path: '/categories',
    icon: 'folder',
    label: 'Разделы',
    permission: 4,
    children: [
      {
        path: '/categories/create',
        icon: 'nav-icon fas fa-plus',
        label: 'Добавить новый'
      },
      {
        path: '/categories',
        icon: 'nav-icon fas fa-file-alt',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/posts',
    icon: 'edit',
    label: 'Записи',
    permission: 3,
    children: [
      {
        path: '/posts/create',
        icon: 'nav-icon fas fa-plus',
        label: 'Добавить новую'
      },
      {
        path: '/posts',
        icon: 'nav-icon fas fa-file-alt',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/tags',
    icon: 'bookmarks',
    label: 'Теги',
    permission: 3,
    children: [
      {
        path: '/tags/create',
        icon: 'nav-icon fas fa-plus',
        label: 'Добавить новый'
      },
      {
        path: '/tags',
        icon: 'nav-icon fas fa-file-alt',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/users',
    icon: 'people_alt',
    label: 'Пользователи',
    permission: 4,
    children: [
      {
        path: '/users/create',
        icon: 'nav-icon fas fa-plus',
        label: 'Добавить нового'
      },
      {
        path: '/users',
        icon: 'nav-icon fas fa-file-alt',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/pages',
    icon: 'file_copy',
    label: 'Страницы',
    permission: 4,
    children: [
      {
        path: '/pages/create',
        icon: 'nav-icon fas fa-plus',
        label: 'Добавить новую'
      },
      {
        path: '/pages',
        icon: 'nav-icon fas fa-file-alt',
        label: 'Показать все'
      }
    ]
  },
  {
    path: '/comments',
    icon: 'mode_comment',
    label: 'Комментарии',
    permission: 3,
    children: []
  },
  {
    path: '/menus',
    icon: 'menu',
    label: 'Меню',
    permission: 4,
    children: []
  },
  {
    path: '/events',
    icon: 'timeline',
    label: 'События',
    permission: 4,
    children: []
  },
  {
    path: '/tickets',
    icon: 'help_outline',
    label: 'Поддержка',
    permission: 4,
    children: []
  },
  {
    path: '/files',
    icon: 'insert_photo',
    label: 'Файлы',
    permission: 3,
    children: []
  },
  {
    path: '/trash',
    icon: 'delete',
    label: 'Корзина',
    permission: 3,
    children: []
  },
  {
    path: '/tools',
    icon: 'handyman',
    label: 'Инструменты',
    permission: 4,
    children: []
  },
  {
    path: '/themes',
    icon: 'brush',
    label: 'Внешний вид',
    permission: 4,
    children: []
  },
  {
    path: '/settings',
    icon: 'settings',
    label: 'Настройки',
    permission: 4,
    children: []
  }
]

export default items
