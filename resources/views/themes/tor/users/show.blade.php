@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ $user->login }}</title>
    <meta name="description" content="Профиль пользователя {{ $user->login }}">
    <meta name="keywords" content="настройки профиля, профиль, настройки">
@endsection

@section('content')

<div class='blocks' style='position:relative; left: 20px;'>
    <div class='blocks_center'>
        <div class='blocks_top'>
            <div class='blocks_bottom'>
                <div class='info_pers'>Основной персонаж</div>
                <div id='pers'>
                    <div id='pers_center'>
                        <div id='pers_top'>
                            <div id='pers_bottom'>
                                <div id='ava_pers'>
                                    @if($user->class)
                                        <img class="profile-class-img" src="/themes/tor/assets/class_icons/center/{{ Str::slug($user->class, '_') }}.jpg" alt="">
                                    @else
                                        <img src="/themes/tor/assets/design_img/ava_pers.png" alt="">
                                    @endif
                                </div>
                                <div id='pers_title'>
                                    <span>{{ $user->char ?? 'не указано' }}</span>
                                    <span href='' id="prof"></span>
                                    <span href='' id='guild'></span>
                                </div>
                                <div id='pers_opis'>
                                    <div class='opis'>
                                        <span class="nm">Сервер:</span> <span class='nam'>{{ $user->server ?? 'не указано' }}</span>
                                    </div>
                                    <div class='opis'>
                                        <span class="nm">Фракция:</span> <span class='nam'>{{ $user->side ?? 'не указано' }}</span>
                                    </div>
                                    <div class='opis'>
                                        <span class="nm">Класс:</span> <span class='nam'>{{ $user->class ?? 'не указано' }}</span>
                                    </div>
                                    <div class='opis'>
                                        <span class="nm">Специализация:</span> <span class='nam'>{{ $user->spec ?? 'не указано' }}</span>
                                    </div>
                                    <div class='opis'>
                                        <span class="nm">Гильдия:</span> <span class='nam'>{{ $user->guild ?? 'не указано' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='blocks' style='position:relative; left: 20px; overflow:hidden;'>
    <div class='blocks_center'>
        <div class='blocks_top1'>
            <div class='blocks_bottom1'>
                <div class='info_pers'>Личные данные</div>
                <div id='profile-avatar' class='block_avatar' style="margin-left:20px;">
                    <div id='name'>{{ $user->login }} <small><a href="{{ route('blog.profile.edit') }}">[Редактировать]</a></small></div>
                    <div id='avatar'>
                        <img src="{{ asset('/storage/'.$user->avatar) }}" alt="{{ $user->login }}" style="height: 200px; width: 200px;">
                        <div class='info_text'>
                            <div class='left_text'>Группа:</div>
                            <div class='right_text'>
                                <span style="color:#8579e1">{{ $user->role->role_value }}</span>
                            </div>
                        </div>
                        <div class='info_text'>
                            <div class='left_text'>Сообщений:</div>
                            <div class='right_text'>{{ count($user->comments) }}</div>
                        </div>
                        <div class='info_text'>
                            <div class='left_text'>Регистрация:</div>
                            <div class='right_text'>{{ $user->created_at }}</div>
                        </div>
                    </div>
                </div>
                <div class='account-data'>
                    <ul>
                        <li>Имя: {{ $user->name ?? 'не указано' }}</li>
                        <li>Возраст: {{ $user->age ?? 'не указано' }}</li>
                        <li>E-mail: {{ $user->email ?? 'не указано' }}</li>
                        <li>Вконтакте: {{ $user->vk ?? 'не указано' }}</li>
                        <li>Одноклассники: {{ $user->ok ?? 'не указано' }}</li>
                        <li>Twitter: {{ $user->tw ?? 'не указано' }}</li>
                        <li>Facebook: {{ $user->fb ?? 'не указано' }}</li>
                    </ul>
                </div>
                <div style='clear:both;'></div>
            </div>
        </div>
    </div>
</div>
<div class='blocks' style='position:relative; left:20px;'>
    <div class='blocks_center'>
        <div class='blocks_top1'>
            <div class='blocks_bottom2'>
                <div class='info_pers'>Недавние комментарии</div>
                <div class='comm'>
                    @if($comments)
                        @foreach($comments as $comment)
                        <div id="comment-{{ $comment->id }}" class='comm_bg'>
                            <div class='comm_ava'>
                                <img src="{{ asset('/storage/'.$comment->user->avatar) }}" alt="{{ $comment->user->name }}" style="width: 58px; height: 58px;">
                            </div>
                            <div class='comm_title'>
                                {{ $comment->user->name }}  <img src="/themes/tor/assets/design_img/red_icon.png" alt=""> <span>{{ $comment->created_at }}</span> к новости <a href="{{ route('posts.show', $comment->post->slug) }}#comment-{{ $comment->id }}">{{ $comment->post->title }}</a>
                            </div>
                            <div class='comm_text'>
                                <div class='mt-mb-10'>{{ $comment->content }}</div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <div class='str_text v-hidden'>Страницы:</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
