<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_key' => 'subscriber',
                'role_value' => 'Подписчик',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_key' => 'moderator',
                'role_value' => 'Модератор',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_key' => 'editor',
                'role_value' => 'Редактор',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_key' => 'administrator',
                'role_value' => 'Администратор',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        $user = [
            'login' => 'admin',
            'name' => 'admin',
            'email' => 'roffits@gmail.com',
            'role_id' => 4,
            'password' => bcrypt('123'),
            'ip' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now()
        ];
        $ticket_categories = [
            [
                'title' => 'Вопросы',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Проблемы',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Предложения по улучшению',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Другое',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        $category = [
            'slug' => 'test',
            'title' => 'Тестовый раздел',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $post = [
            'category_id' => 1,
            'user_id' => 1,
            'title' => 'Hello world!',
            'slug' => 'hello-world',
            'excerpt' => 'Тестовая запись для ознакомления...',
            'content' => 'Тестовая запись для ознакомления... Отредактируйте ее или удалите',
            'is_public' => 1,
            'is_discuss' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $comment = [
            'post_id' => 1,
            'user_id' => 1,
            'content' => 'Тестовый комментарий',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $events = [
            [
                'model' => 'User',
                'event_type' => 'created',
                'data' => jsonEncode([
                    'user' => 'admin',
                    'target' => 'admin',
                    'add' => null,
                    'action' => 'зарегистрировался',
                    'css' => 'fas fa-user bg-success'
                ]),
                'range' => getRange(now()),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'BlogCategory',
                'event_type' => 'created',
                'data' => jsonEncode([
                    'user' => 'admin',
                    'target' => 'Тестовый раздел',
                    'add' => null,
                    'action' => 'создал раздел',
                    'css' => 'fas fa-folder-open bg-success'
                ]),
                'range' => getRange(now()),
                'created_at' => now()->addSeconds(1),
                'updated_at' => now()->addSeconds(1)
            ],
            [
                'model' => 'BlogPost',
                'event_type' => 'created',
                'data' => jsonEncode([
                    'user' => 'admin',
                    'target' => 'Hello world!',
                    'add' => 'Тестовая запись для ознакомления...',
                    'action' => 'опубликовал запись',
                    'css' => 'fas fa-pencil-alt bg-success'
                ]),
                'range' => getRange(now()),
                'created_at' => now()->addSeconds(2),
                'updated_at' => now()->addSeconds(2)
            ],
            [
                'model' => 'BlogComment',
                'event_type' => 'created',
                'data' => jsonEncode([
                    'user' => 'admin',
                    'target' => '#1 комментарий',
                    'add' => 'Тестовый комментарий',
                    'action' => 'написал комментарий',
                    'css' => 'fas fa-comments bg-success'
                ]),
                'range' => getRange(now()),
                'created_at' => now()->addSeconds(3),
                'updated_at' => now()->addSeconds(3)
            ]
        ];
        $settings = [
            [
                'name' => 'site_name',
                'value' => 'Laravel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'site_desc',
                'value' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'site_logo',
                'value' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'site_md',
                'value' => 'Laravel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'site_mk',
                'value' => 'laravel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'theme',
                'value' => 'default',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'admin_email',
                'value' => 'admin@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'count_on_page',
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'count_posts_on_page',
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        $menu_item_types = [
            [
                'slug' => 'pages',
                'name' => 'Страницы',
                'icon' => 'fas fa-copy',
                'color' => 'bg-info',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'posts',
                'name' => 'Записи',
                'icon' => 'fas fa-pencil-alt',
                'color' => 'bg-success',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'categories',
                'name' => 'Разделы',
                'icon' => 'fas fa-folder-open',
                'color' => 'bg-warning',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'links',
                'name' => 'Ссылки',
                'icon' => 'fas fa-link',
                'color' => 'bg-danger',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('roles')->insert($roles);
        DB::table('users')->insert($user);
        DB::table('ticket_categories')->insert($ticket_categories);
        DB::table('blog_categories')->insert($category);
        DB::table('blog_posts')->insert($post);
        DB::table('blog_comments')->insert($comment);
        DB::table('events')->insert($events);
        DB::table('settings')->insert($settings);
        DB::table('menu_item_types')->insert($menu_item_types);

        /**
         * Накатываем большое количество абстрактного контента
         */
        //factory(App\Models\User::class, 1000)->create();
        //factory(App\Models\BlogCategory::class, 500)->create();
        //factory(App\Models\BlogPost::class, 1000)->create();
        //factory(App\Models\BlogComment::class, 5000)->create();
        //$this->call(BlogCategoriesTableSeeder::class);
        //factory(App\Models\BlogPost::class, 100)->create();
        //factory(App\Models\BlogComment::class, 100)->create();
    }
}
