@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ $user->login }}</title>
    <meta name="description" content="Профиль пользователя {{ $user->login }}">
    <meta name="keywords" content="настройки профиля, профиль, настройки">
@endsection

@section('content')
    <div class='blocks' style='position:relative; left:20px;'>
        <div class='blocks_center'>
            <div class='blocks_top1'>
                <div class='blocks_bottom2'>
                    <div class='info_pers'>Редактировать профиль</div>
                    <div class='comm'>
                        @if(session('success'))
                            @include('themes.'.currentTheme().'.layouts.alert_success', ['message' => session('success')])
                        @endif
                        @if($errors->any())
                            @include('themes.'.currentTheme().'.layouts.alert_error', ['errors' => $errors->all()])
                        @endif
                        <form class="form-group edit" action="{{ route('profile.avatar.upload') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div>
                                <h3>Аватар</h3>
                            </div>
                            <div>
                                <img src="{{ asset('/storage/'.$user->avatar) }}" alt="{{ $user->name }}" style="height: 200px; width: 200px;">
                            </div>
                            <div>
                                <input type="file" name="avatar">
                            </div>
                            <div class="knopka" style="margin-top:15px;">
                                <input type="submit" value="Сохранить изменения">
                            </div>
                        </form>
                        <form class="form-group edit" action="{{ route('profile.update') }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div>
                                <h3>Личные данные</h3>
                            </div>
                            <div>
                                <label for="e-name">Имя (никнейм)</label>
                                <div>
                                    <input id="e-name" type="text" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div>
                                <label for="age">Возраст</label>
                                <div>
                                    <input id="age" type="text" name="age" value="{{ $user->age }}">
                                </div>
                            </div>
                            <div>
                                <label for="char">Основной персонаж</label>
                                <div>
                                    <input id="char" type="text" name="char" value="{{ $user->char }}">
                                </div>
                            </div>
                            <div>
                                <label for="e-guild">Гильдия</label>
                                <div>
                                    <input id="e-guild" type="text" name="guild" value="{{ $user->guild }}">
                                </div>
                            </div>
                            <div>
                                <label for="vk">ВКонтакте</label>
                                <div>
                                    <input id="vk" type="text" name="vk" value="{{ $user->vk }}">
                                </div>
                            </div>
                            <div>
                                <label for="ok">Одноклассники</label>
                                <div>
                                    <input id="ok" type="text" name="ok" value="{{ $user->ok }}">
                                </div>
                            </div>
                            <div>
                                <label for="tw">Twitter</label>
                                <div>
                                    <input id="tw" type="text" name="tw" value="{{ $user->tw }}">
                                </div>
                            </div>
                            <div>
                                <label for="fb">Facebook</label>
                                <div>
                                    <input id="fb" type="text" name="fb" value="{{ $user->fb }}">
                                </div>
                            </div>
                            <div>
                                <label for="server">Сервер</label>
                                <div>
                                    <select name="server" id="server">
                                        <option value="" selected>Выбрать сервер</option>
                                        <option value="Darth Malgus" @if($user->server === 'Darth Malgus') selected @endif>Darth Malgus</option>
                                        <option value="Tulak Hord" @if($user->server === 'Tulak Hord') selected @endif>Tulak Hord</option>
                                        <option value="The Leviathan" @if($user->server === 'The Leviathan') selected @endif>The Leviathan</option>
                                        <option value="Star Forge" @if($user->server === 'Star Forge') selected @endif>Star Forge</option>
                                        <option value="Satele Shan" @if($user->server === 'Satele Shan') selected @endif>Satele Shan</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="side">Фракция</label>
                                <div>
                                    <select name="side" id="side">
                                        <option value="" selected>Выбрать фракцию</option>
                                        <option value="Sith Empire" @if($user->side === 'Sith Empire') selected @endif>Sith Empire</option>
                                        <option value="Galactic Republic" @if($user->side === 'Galactic Republic') selected @endif>Galactic Republic</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="e-class">Класс</label>
                                <div>
                                    <select name="class" id="e-class">
                                        <option value="" selected>Выбрать класс</option>
                                        <optgroup label="Империя">
                                            <option value="Sith Juggernaut" @if($user->class === 'Sith Juggernaut') selected @endif>Sith Juggernaut</option>
                                            <option value="Sith Marauder" @if($user->class === 'Sith Marauder') selected @endif>Sith Marauder</option>
                                            <option value="Sith Sorcerer" @if($user->class === 'Sith Sorcerer') selected @endif>Sith Sorcerer</option>
                                            <option value="Sith Assassin" @if($user->class === 'Sith Assassin') selected @endif>Sith Assassin</option>
                                            <option value="Sniper" @if($user->class === 'Sniper') selected @endif>Sniper</option>
                                            <option value="Operative" @if($user->class === 'Operative') selected @endif>Operative</option>
                                            <option value="Mercenary" @if($user->class === 'Mercenary') selected @endif>Mercenary</option>
                                            <option value="Powertech" @if($user->class === 'Powertech') selected @endif>Powertech</option>
                                        </optgroup>
                                        <optgroup label="Республика">
                                            <option value="Jedi Guardian" @if($user->class === 'Jedi Guardian') selected @endif>Jedi Guardian</option>
                                            <option value="Jedi Sentinel" @if($user->class === 'Jedi Sentinel') selected @endif>Jedi Sentinel</option>
                                            <option value="Jedi Sage" @if($user->class === 'Jedi Sage') selected @endif>Jedi Sage</option>
                                            <option value="Jedi Shadow" @if($user->class === 'Jedi Shadow') selected @endif>Jedi Shadow</option>
                                            <option value="Gunslinger" @if($user->class === 'Gunslinger') selected @endif>Gunslinger</option>
                                            <option value="Scoundrel" @if($user->class === 'Scoundrel') selected @endif>Scoundrel</option>
                                            <option value="Commando" @if($user->class === 'Commando') selected @endif>Commando</option>
                                            <option value="Vanguard" @if($user->class === 'Vanguard') selected @endif>Vanguard</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="spec">Специализация</label>
                                <div>
                                    <select name="spec" id="spec">
                                        <option value="">Выберите специализацию</option>
                                        @include('themes.'.currentTheme().'.users.option_spec')
                                    </select>
                                </div>
                            </div>
                            <div class="knopka" style="margin-top:15px;">
                                <input type="submit" value="Сохранить изменения">
                            </div>
                        </form>
                        <form class="form-group edit" action="{{ route('profile.email.update') }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div>
                                <h3>Изменить E-mail</h3>
                            </div>
                            <div>
                                <label for="e-email">E-mail адрес</label>
                                <div>
                                    <input id="e-email" type="text" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div>
                                <label for="c-password">Введите пароль</label>
                                <div>
                                    <input id="c-password" type="password" name="password">
                                </div>
                            </div>
                            <div class="knopka" style="margin-top:15px;">
                                <input type="submit" value="Сохранить изменения">
                            </div>
                        </form>
                        <form class="form-group edit" action="{{ route('profile.password.update') }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div>
                                <h3>Изменить пароль</h3>
                            </div>
                            <div>
                                <label for="curr-password">Текущий пароль</label>
                                <div>
                                    <input id="curr-password" type="password" name="password_current">
                                </div>
                            </div>
                            <div>
                                <label for="e-password">Новый пароль</label>
                                <div>
                                    <input id="e-password" type="password" name="password">
                                </div>
                            </div>
                            <div>
                                <label for="conf-password">Подтвердите новый пароль</label>
                                <div>
                                    <input id="conf-password" type="password" name="password_confirmation">
                                </div>
                            </div>
                            <div class="knopka" style="margin-top:15px;">
                                <input type="submit" value="Сохранить изменения">
                            </div>
                        </form>
                        <div class='str_text'>
                            <a href="{{ route('blog.profile.show') }}">Назад</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
