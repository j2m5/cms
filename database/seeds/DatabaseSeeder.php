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
                'icon' => 'mdi-book-open-page-variant',
                'color' => 'bg-info',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'posts',
                'name' => 'Записи',
                'icon' => 'mdi-pencil',
                'color' => 'bg-success',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'categories',
                'name' => 'Разделы',
                'icon' => 'mdi-folder',
                'color' => 'bg-warning',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'slug' => 'links',
                'name' => 'Ссылки',
                'icon' => 'mdi-link-variant',
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
        DB::table('settings')->insert($settings);
        DB::table('menu_item_types')->insert($menu_item_types);

        /**
         * Накатываем большое количество тестового контента
         */
        factory(App\Models\User::class, 10000)->create();
        //factory(App\Models\BlogCategory::class, 1000)->create();
        //factory(App\Models\BlogPost::class, 30000)->create();
        //factory(App\Models\BlogComment::class, 50000)->create();
        //factory(App\Models\Page::class, 5000)->create();
        //$this->call(BlogCategoriesTableSeeder::class);
        //factory(App\Models\BlogPost::class, 100)->create();
        //factory(App\Models\BlogComment::class, 100)->create();
        //factory(App\Models\Ticket::class, 50000)->create();
    }
}
